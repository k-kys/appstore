<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function changePassword()
    {
        return view('user.change-password');
    }

    public function postChangePassword(Request $request)
    {
        # code...
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile', compact('user'));
    }

    public function postProfile(Request $request, $id)
    {
        // Up anh avatar
        $filename = $_FILES['avatar']['name'];
        // $extension = $request->file('avatar')->extension();
        $id = $request->user()->id;
        $date = date("Ymd");
        $newName = $id . "-" . $date . "-{$filename}";
        $path = $request->file('avatar')->storeAs('avatar', $newName);


        // update bang du lieu
        $data = $request->all();
        DB::table('users')->where('id', $id)->update([
            'name' => $data['name'],
            // 'email' => $data['email'],
            'avatar' => $path,
        ]);

        return redirect()->route('profile', compact('id'))->with('alert-success', 'Bạn đã cập nhật thành công.');
    }
}
