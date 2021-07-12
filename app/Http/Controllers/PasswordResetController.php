<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $this->validate($request, $rules);
        $user = User::where('email', $request->email)->get();
        if (sizeof($user) == 0) {
            return response()->json([
                'message' => 'No existe este correo'
            ], 400);
        }

        $token = (string) Str::uuid();
        $password = PasswordReset::where('email', $request->email)->get();
        if (sizeof($password) > 0) {
            $passwordReset = $password[0];
            $passwordReset->token = $token;
            $passwordReset->save();
            return $this->successResponse($passwordReset);
        }


        $fields['token'] = $token;
        $fields['email'] = $request->email;

        $passwordReset = PasswordReset::create($fields);

        return $this->successResponse($passwordReset);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'password' => 'required',
            'token' => 'required',
        ];
        $this->validate($request, $rules);

        $passwordReset = PasswordReset::where('token', $request->token)->get();
        if (sizeof($passwordReset) == 0) {
            return response()->json([
                'message' => 'Token no relacionado'
            ], 400);
        }

        $user = User::where('email', $passwordReset[0]->email)->get()[0];
        $user->password = bcrypt($request->password);
        $user->save();
        /* $passwordReset = PasswordReset::where('token', $request->token)->first();
        $passwordReset->delete(); */

        return $this->successResponse('Cambio exitoso');
    }
}
