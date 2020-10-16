<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->get('email');
            $password = $request->get('password');
            // $user = User::where('email', $email)->first();
            // if (!$user || !Hash::check($password, $user->password)) {
            //     return redirect()->back()->;
            // }
            // Auth::login($user);
            // return redirect()->route('index');

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('app.index')->with('alert-success', 'Bạn đã đăng nhập thành công.');
            }
            $errors = new MessageBag(['password' => ['Email hoặc mật khẩu không đúng.']]);
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Name không được để trống',
            'email.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Nếu validate thành công thì thêm mới thông tin vào bảng users
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('login');
    }

    public function logout(Type $var = null)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
