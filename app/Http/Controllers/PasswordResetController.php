<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $objDemo = new \stdClass();
        $objDemo->token = $token;
 
        Mail::to($request->email)->send(new ResetPassword($objDemo));

        return $this->successResponse('Email enviado');
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
