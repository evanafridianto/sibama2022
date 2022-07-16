<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function edit($username)
    {
        if ($username == Auth::user()->username) {
            $title =  'Edit Profil';
            $user = User::where('username', $username)->first();
            return view('pages.user.form', compact(['title', 'user']));
        }
        return abort(404);
    }

    public function store(Request $request)
    {
        $id = empty($request->id) ? '' : $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email:rfc,dns|unique:users,email,' . $id,
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $id,
            'password' => $request->has('new-password') == false ? '' : 'required|min:6|max:255', Rules\Password::defaults(),
            'confirm_password' => $request->has('new-password') == false ? '' : 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (!empty($request->id)) {
                DB::beginTransaction();
                try {
                    $user =  User::find($request->id);
                    $user->name  = $request->name;
                    $user->email  = $request->email;
                    $user->username  = $request->username;
                    if ($request->has('new-password')) {
                        $user->password = Hash::make($request->password);
                    }
                    $user->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("profile.edit", $request->username)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }
}