<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Library;
use App\Model\Type;
use App\Http\Resources\Library as LibraryResource;
use Image;

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

    public function list($type)
    {
        $data = Library::with('type', 'images')->whereHas('type', function($code) use($type) {
            $code->where('name', $type);
        })->orderBy('name')->get();

        return LibraryResource::collection($data);
    }

    public function detail($id)
    {
    	$data = Library::with('type', 'images')->find($id);

    	return response()->json($data);
    }

    public function image($img)
    {
    	return response()->file(public_path('img/library/').$img);
    }

    public function create()
    {
    	$data['type'] = Type::pluck('name', 'id');
    	$data['route'] = route('libraries.store');
    	$data['method'] = 'post';
    	return view('library.form', $data);
    }

    public function edit($id)
    {
    	$data['type'] = Type::pluck('name', 'id');
    	$data['model'] = Library::find($id);
    	$data['route'] = route('library.update');
    	$data['method'] = 'put';
    	return view('library.form', $data);
    }

    public function show($id)
    {
    	$data['model'] = Library::find($id);
    	return view('library.detail', $data);
    }

    public function store(Request $request)
    {
    	$images = $request->file('images');
    	$path = public_path('img/library/');

    	$lib = Library::create($request->all());

    	for ($i=0; $i < count($images); $i++) { 
    		$ext = $images[$i]->getClientOriginalExtension();
    		$oriName = 'original-'.time().$i.'.'.$ext;
    		$thumbName = 'thumbnail-'.time().$i.'.'.$ext;

			$images[$i]->move($path, $oriName);

			Image::make($path.$oriName)->widen(300, function ($constraint) {
			    $constraint->upsize();
			})->save($path.$thumbName);

			$lib->images()->create([
				'original' => $oriName,
				'thumbnail' => $thumbName,
			]);
    	}

    	return redirect('libraries');
    }
}
