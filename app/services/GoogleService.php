<?php

namespace App\services;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Hash;

class GoogleService
{
    private $email, $userToken;


    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }


    public function setToken($value)
    {
        $this->userToken = $value;
        return $this;
    }


    public function login()
    {
        $token = rand(111111, 99999999);

        if (User::where('email', $this->email)->exists()) {
            $user = User::where('email', $this->email)->first();
            $userId = $user->id;

            UserToken::where('user_id', $userId)->delete();

            $userToken = new UserToken();
            $userToken->user_id = $user->id;
            $userToken->token = $token;
            $userToken->save();

            return $token;
        } else {

            $user = new User();
            $user->email = $this->email;
            $user->password = Hash::make(1234);
            $user->user_type = 'User';
            $user->save();

            $userToken = new UserToken();
            $userToken->user_id = $user->id;
            $userToken->token = $token;
            $userToken->save();

            return $token;
        }
    }


    // public function loginProcess()
    // {

    //     if (UserToken::where('token', $this->userToken)->exists()) {
    //         $userId = UserToken::where('token', $this->userToken)->first()->user_id;
    //         $user = User::where('id', $userId)->first();

    //         if ($user->status == 'OFF') {
    //             return 'Please Wait...';
    //         } else {
    //             return $user->profile_type;
    //         }
    //     } else {
    //         return 'Invalid Token';
    //     }
    // }
}
