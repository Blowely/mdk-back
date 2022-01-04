<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class UsersController
{
    public static $authorizedUser = '';
    public function reg(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'login' => 'required',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => [
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }

        DB::table('users')->insert([
            'login' => $data['login'],
            'password' => md5($data['password']),
        ]);

        return response()->json([
            'login' => $data['login'],
            'password' => $data['password']
        ],201);
    }

    public function auth(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'login' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => [
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }



        $foundRes = DB::table('users')->where('login', $data['login'])->first();
        if ($foundRes) {
            if (md5($data['password']) == $foundRes->password) {
                UsersController::$authorizedUser = $foundRes->login;
                return response()->json([
                    'data' => [
                        'who' => $foundRes->login,
                        'token' => Str::random(80)
                    ]
                ], 200);
            }
        }

        return response()->json([
            'error' => [
                'code' => 401,
                'message' => 'Unauthorized',
                'errors' => [
                    'login' => ['login or password incorrect']
                    ]
            ]
        ],401);
    }

    public function test(Request $request): \Illuminate\Http\JsonResponse
    {
        $date_1 = "2030-10-21";
// вторая дата, с которой будет сравнение
        $date_2 = "2014-10-21";
        $date_3 = "2010-10-21";
// вторая дата, с которой будет сравнение
        $date_4 = "2014-10-21";

// перевод дат в формат timestamp
        $date_timestamp_1 = strtotime($date_1);
        $date_timestamp_2 = strtotime($date_2);
        $date_timestamp_3 = strtotime($date_3);
        $date_timestamp_4 = strtotime($date_4);


        $diff = $date_timestamp_4 - $date_timestamp_3;
        $years16 = $date_timestamp_1 - $date_timestamp_2;

        if($diff >= $years16){
            echo 'ok';
        } else {
            echo 'no';
        }



        return response()->json([
            'res' => '$res'
        ],200);
    }
}

