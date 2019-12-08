<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Library;
use App\Model\Type;
use App\Model\Image;
use App\Model\Notification;
use App\Http\Resources\Library as LibraryResource;
use Image as ImageIntervention;
use OneSignal;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');

        $data['model'] = Library::with('type');

        if (!is_null($type)) {
            $data['model'] = $data['model']->whereHas('type', function($code) use($type) {
                $code->where('name', $type);
            });
        }

    	$data['model'] = $data['model']->orderBy('created_at', 'desc')->get();
        $data['type'] = $type;

    	return view('library.index', $data);
    }

    public function list(Request $request, $type)
    {
        $data = Library::with('type', 'images')->whereHas('type', function($code) use($type) {
            $code->where('name', $type);
        })->orderBy('name');

        if ($s = $request->get('s')) {
            $data = $data->where('name', 'like', '%'.$s.'%')->orWhere('name_en', 'like', '%'.$s.'%');
        }

        $data = $data->get();

        return LibraryResource::collection($data);
    }

    public function detail($id)
    {
    	$data = Library::with('type', 'images')->find($id);

    	return response()->json($data);
    }

    public function image($img)
    {
        $file = public_path('img/library/').$img;
        if (file_exists($file)) {
            return response()->file($file);
        } else {
            return response()->file('img/default.png');
        }
    }

    public function create()
    {
    	$data['type'] = Type::pluck('name', 'id');
    	$data['route'] = route('libraries.store');
    	return view('library.form', $data);
    }

    public function edit($id)
    {
    	$data['type'] = Type::pluck('name', 'id');
    	$data['model'] = Library::find($id);
    	$data['route'] = route('libraries.update', $id);
    	return view('library.form', $data);
    }

    public function store(Request $request)
    {
        $lib = Library::create($request->all());

        if ($images = $request->file('images')) {
            $this->inputImage($images, $lib);
        }

        $title = "Data baru tipe {$lib->type->name} telah ditambahkan ke library!";
        $body = "Data baru telah ditambahkan ke library dengan detail: \n
                nama: {$lib->name} 
                tipe: {$lib->type->name} 
                waktu: {$lib->created_at}";

        $engtype = [
            'hama' => 'pest',
            'penyakit' => 'disease',
            'abiotik' => 'abiotic',
        ];
        $type = $engtype[$lib->type->name];

        $title_en = "New data of type {$type} has been added to the library!";
        $body_en = "New data has been added to the library with details: \n
                nama: {$lib->name_en} 
                tipe: {$type} 
                waktu: {$lib->created_at}";

        $users = User::pluck('id');
        foreach ($users as $user_id) {
            $notf = Notification::create([
                'user_id'   => $user_id,
                'title'     => $title,
                'body'      => $body,
                'title_en'  => $title_en,
                'body_en'   => $body_en,
                'type'      => 'library',
                'target'    => $lib->id,
            ]);
        }

        OneSignal::sendNotificationToAll(
            $title,
            null,
            ['target' => $lib->id, 'type' => 'library']
        );

    	return redirect('libraries');
    }

    public function update(Request $request, $id)
    {
        $lib = Library::find($id);
        $lib->update($request->all());

        if ($r = substr($request->deleted_image, 1)) {
            $i = strpos($r, ',') ? explode(',', $r) : array('0' => $r);
            foreach ($i as $img_id) {
                $this->deleteImage($img_id);
            }
        }

        if ($images = $request->file('images')) {
            $this->inputImage($images, $lib);
        }

        $title = "Terdapat update data tipe {$lib->type->name} pada library!";
        $body = "Terdapat update data pada library pada data: \n
                nama: {$lib->name} \n
                tipe: {$lib->type->name} \n
                waktu: {$lib->updated_at}";

        $engtype = [
            'hama' => 'pest',
            'penyakit' => 'disease',
            'abiotik' => 'abiotic',
        ];
        $type = $engtype[$lib->type->name];

        $title_en = "There is an update to the data of type {$type} has been added to the library!";
        $body_en = "The data has been updated with details: \n
                nama: {$lib->name_en} 
                tipe: {$type} 
                waktu: {$lib->updated_at}";

        $users = User::pluck('id');
        foreach ($users as $user_id) {
            $notf = Notification::create([
                'user_id'   => $user_id,
                'title'     => $title,
                'body'      => $body,
                'title_en'  => $title_en,
                'body_en'   => $body_en,
                'type'      => 'library',
                'target'    => $id,
            ]);
        }

        OneSignal::sendNotificationToAll(
            $title,
            null,
            ['target' => $id, 'type' => 'library']
        );

        return redirect('libraries');
    }

    public function destroy($id)
    {
        $lib = Library::find($id);

        foreach ($lib->images()->get() as $img) {
            $this->deleteImage($img->id);
        }

        $lib->delete();

        return redirect('libraries');
    }

    public function inputImage($images, $lib)
    {
        $path = public_path('img/library/');

        for ($i=0; $i < count($images); $i++) { 
            $ext = $images[$i]->getClientOriginalExtension();
            $oriName = 'original-'.time().$i.'.'.$ext;
            $thumbName = 'thumbnail-'.time().$i.'.'.$ext;

            $images[$i]->move($path, $oriName);

            ImageIntervention::make($path.$oriName)->widen(300, function ($constraint) {
                $constraint->upsize();
            })->save($path.$thumbName);

            $lib->images()->create([
                'original' => $oriName,
                'thumbnail' => $thumbName,
            ]);
        }
    }

    public function deleteImage($id)
    {
        $img = Image::find($id);

        if (file_exists(public_path('img/library/'.$img->original))) {
            unlink(public_path('img/library/'.$img->original));
        }
        if (file_exists(public_path('img/library/'.$img->thumbnail))) {
            unlink(public_path('img/library/'.$img->thumbnail));
        }

        $img->delete();
    }
}
