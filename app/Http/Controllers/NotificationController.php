<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['read']]);
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit');

    	$notf = Notification::where('user_id', 1)->orWhereNull('user_id')->orderBy('created_at', 'desc')->skip(0)->take($limit)->get();

    	return response()->json($notf);
    }

    public function read($id)
    {
    	Notification::find($id)->update(['is_read' => 1]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
