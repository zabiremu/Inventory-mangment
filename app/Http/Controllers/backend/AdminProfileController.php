<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //DISPLAY ADMIN PROFILE VIEW
    public function index()
    {
        $userId = Auth::user()->id;
        $userData = User::find($userId);
        return view('admin.profile.index', compact('userData'));
    }

    // STORE ADMIN DATA 
    public function store(Request $request, $id)
    {
        $updataData = User::find($id);
        $updataData->name = $request->name;
        $updataData->email = $request->email;
        $updataData->userName = $request->userName;
        if ($request->file('image')) {
            if ($updataData->image != null) {
                $path = unlink(public_path($updataData->image));
            }
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $saveImage = $image->move(public_path('uploads/images'), $imageName);
            $saveUrl = 'uploads/images/' . $imageName;
            $updataData->image = $saveUrl;
            $updataData->save();
            $notification = array(
                'message' => "Admin profile successfully updated",
                'alert-type' => 'success',
            );
            return redirect()
                ->route('admin.profile')
                ->with($notification);
        }
        $updataData->save();
        $notification = array(
            'message' => "Admin profile successfully updated",
            'alert-type' => 'success',
        );
        return redirect()
            ->route('admin.profile')
            ->with($notification);
    }

    // DISPLAY ADMIN PASSWORD VIEW 
    public function password()
    {
        $userId = Auth::user()->id;
        $userData = User::find($userId);
        return view('admin.profile.password', compact('userData'));
    }

    // UPDATE ADMIN PASSWORD
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ],
            [
                'password_confirmation' => 'New Password must be match with confirm password',
            ]
        );

        $oldPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $oldPassword)) {
            $id = Auth::user()->id;
            $user = User::find($id);

            $user->password = bcrypt($request->password);
            $user->save();

            $notification = array(
                'message' => "Admin password successfully updated",
                'alert-type' => 'success',
            );
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = array(
                'message' => "Old Password is not match",
                'alert-type' => 'error',
            );
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
