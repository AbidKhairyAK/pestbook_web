<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Consultation;
use App\Model\Type;
use App\Http\Resources\Consultation as ConsultationResource;
use Image as ImageIntervention;
use Illuminate\Support\Facades\Storage;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');

        $data['model'] = Consultation::with('type');

        if (!is_null($type)) {
            $data['model'] = $data['model']->whereHas('type', function($code) use($type) {
                $code->where('name', $type);
            });
        }

    	$data['model'] = $data['model']->orderBy('created_at', 'desc')->get();
        $data['type'] = $type;

    	return view('consultation.index', $data);
    }

    public function list()
    {
        $data = Consultation::select('id', 'title', 'status')->orderBy('created_at', 'desc')->get();

        return ConsultationResource::collection($data);
    }

    public function detail($id)
    {
    	$data = Consultation::with('type')->find($id);

    	return response()->json($data);
    }

    public function image($img)
    {
        $file = public_path('img/consultation/').$img;
        if (file_exists($file)) {
            return response()->file($file);
        } else {
            return response()->file('img/default.png');
        }
    }

    public function create()
    {
    	return redirect()->back();
    }

    public function edit($id)
    {
    	$data['model'] = Consultation::find($id);
    	$data['route'] = route('consultations.update', $id);
    	return view('consultation.form', $data);
    }

    public function store(Request $request)
    {
        $img = $request->image;
        $imgOri = 'original-'.time().'.'.str_replace('image/', '', $img['type']);
        $imgThumb = 'thumbnail-'.time().'.'.str_replace('image/', '', $img['type']);

        Storage::disk('public_img')->put('consultation/'.$imgOri, base64_decode($img['data']));

        $path = public_path('img/consultation/');
        ImageIntervention::make($path.$oriName)->widen(300, function ($constraint) {
            $constraint->upsize();
        })->save($path.$thumbName);

        Consultation::create([
            'title' => $request->title,
            'type_id' => $request->type_id,
            'user_id' => 1,
            'indication' => $request->indication,
            'original' => $imgOri,
            'thumbnail' => $imgThumb,
        ]);
        
        return response()->json([
            'message' => 'success',
        ]);
    }

    public function update(Request $request, $id)
    {
        $lib = Consultation::find($id);
        $lib->update(['status' => 1, 'answer' => $request->answer]);

        return redirect('consultations');
    }

    public function destroy($id)
    {
        $cons = Consultation::find($id);

        if (file_exists(public_path('img/consultation/'.$cons->original))) {
            unlink(public_path('img/consultation/'.$cons->original));
        }
        if (file_exists(public_path('img/consultation/'.$cons->thumbnail))) {
            unlink(public_path('img/consultation/'.$cons->thumbnail));
        }

        $cons->delete();

        return redirect('consultations');
    }
}
