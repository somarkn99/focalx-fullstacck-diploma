<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        // foreach ($users as $key => $user) {
        //     Log::debug($user->full_name);
        // }
        // return response()->json([
        //     'id' => $user->id,
        //     'first_name' => $user->first_name,
        //     'last_name' => $user->last_name,
        //     'email' => $user->email,
        //     'full_name' => $user->full_name,
        // ]);
        dd($request);
        return view('User',['users'=>$users]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user);
    }
}
