<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\User;
use App\Models\UserToken;
use App\services\GoogleService;
use App\services\UserService;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GoogleController extends Controller
{
    // public function googleRedirect()
    // {
    //     try {
    //         return Socialite::driver('google')->redirect();
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 400);
    //     }
    // }


    // public function googleCallback()
    // {
    //     try {
    //         $user = Socialite::driver('google')->user();

    //         if (CustomerLogin::where('email', $user->getEmail())->exists()) {
    //             if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1234'])) {
    //                 if (CustomerLogin::where('email', $user->getEmail())->where('status', 'ON')) {
    //                     return response()->json(['message' => 'Login Successful'], 200);
    //                 }
    //             }
    //         } else {
    //             CustomerLogin::insert([
    //                 'name' => $user->getName(),
    //                 'email' => $user->getEmail(),
    //                 'password' => bcrypt('1234'),
    //             ]);

    //             return response()->json(['message' => 'We have sent you a notification!Please check this for login'], 200);
    //             // if (Auth::attempt(['email' => $user->getEmail(), 'password' => '1234'])) {
    //             // }
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 400);
    //     }
    // }


    public function googleLogin(Request $request)
    {
        try {
            $service = new GoogleService();
            $token = $service->setEmail($request->email)
                ->login();

            return response()->json(['message' => 'User Added Successfully', 'token'    => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    public function loginToken(Request $request)
    {
        try {


            if (UserToken::where('token', $request->token)->exists()) {
                $userId = UserToken::where('token', $request->token)->first()->user_id;
                $user = User::where('id', $userId)->first();

                if ($user->status == 'OFF') {
                    return response()->json(['message'  => 'Please Wait for approve', 'status'  => 'off']);
                } else {
                    return response()->json(['profile_type' => $user->profile_type, 'status'    => 'on']);
                }
            } else {
                return response()->json(['message'  => 'Invalid Token', 'status' => 'invalid']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }



    public function profileUpdate(Request $request)
    {


        $service = new UserService();
        $result = $service->setName($request->name)
            ->setPhone($request->phone)
            ->setTelegramNumber($request->telegramNumber)
            ->profile($request->token);

        return response()->json(['message'  => $result], 200);
    }




    public function profileData($token)
    {
        try {
            if (UserToken::where('token', $token)->exists()) {
                $service = new UserService();
                $result = $service->profileData($token);

                return response()->json($result, 200);
            } else {
                return response()->json(['message' => 'Invalid Token'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    public function deleteUser($token)
    {
        try {
            $service = new UserService();
            $service->deleteUser($token);

            return response()->json(['message' => 'User Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
