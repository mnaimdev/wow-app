<?php

namespace App\services;

use App\Models\User;
use App\Models\UserBackup;
use App\Models\UserToken;

class UserService
{

    private $status, $phone, $name, $telegramNumber;


    public function setStatus($value)
    {
        $this->status = $value;
        return $this;
    }

    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    public function setPhone($value)
    {
        $this->phone = $value;
        return $this;
    }


    public function setTelegramNumber($value)
    {
        $this->telegramNumber = $value;
        return $this;
    }



    public function user()
    {
        return User::where('user_type', 'User')->get();
    }


    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = $this->status;
        $user->update();
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);

        // insert this user to another table
        $backupUser = new UserBackup();
        $backupUser->name = $user->name;
        $backupUser->email = $user->email;
        $backupUser->password = $user->password;
        $backupUser->phone = $user->phone;
        $backupUser->telegram_number = $user->telegram_number;
        $backupUser->save();


        $user->delete();
    }


    public function profile($token)
    {
        if (UserToken::where('token', $token)->exists()) {
            $userId = UserToken::where('token', $token)->first()->user_id;
            $user = User::where('id', $userId)->first();

            $user->name = $this->name;
            $user->phone = $this->phone;
            $user->telegram_number = $this->telegramNumber;
            $user->profile_type = 'Yes';
            $user->update();

            return $user->email;
        } else {
            return 'Invalid Token';
        }
    }


    public function deleteUser($token)
    {
        if (UserToken::where('token', $token)->exists()) {
            $userToken = UserToken::where('token', $token)->first();
            $user = User::where('id', $userToken->user_id)->first();

            // insert this user to another table
            $backupUser = new UserBackup();
            $backupUser->name = $user->name;
            $backupUser->email = $user->email;
            $backupUser->password = $user->password;
            $backupUser->phone = $user->phone;
            $backupUser->telegram_number = $user->telegram_number;
            $backupUser->save();


            // delete user token data
            UserToken::where('user_id', $user->id)->delete();

            // user delete
            $user->delete();
        } else {
            throw new \Exception();
        }
    }


    public function profileData($token)
    {
        $userToken = UserToken::where('token', $token)->first();
        $user = User::where('id', $userToken->user_id)->first();
        return $user;
    }
}
