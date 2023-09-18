<?php

namespace App\Http\Controllers;

use App\services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        try {
            $service = new UserService();
            $users = $service->user();

            return view('admin.user.user', [
                'users' => $users,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message'  => $e->getMessage()], 400);
        }
    }


    public function userApprove(Request $request)
    {
        try {
            $service = new UserService();
            $service->setStatus($request->status)
                ->approve($request->id);

            return back()->with('status', 'Status Updated Successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function userDelete($id)
    {
        try {
            $service = new UserService();
            $service->delete($id);

            return back()->with('delete', 'User Deleted Successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
