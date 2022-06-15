<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('auth.index', [
            'title' => 'Users',
            'users' => User::all()
            // 'users' => User::whereIsActive(0)->get()
            
        ]);
    }

    public function showFormLogin()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $rules = $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required'
        ],
        [
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username harus lebih dari 3 karakter',
            'username.max' => 'Username harus kurang dari 255 karakter',
            'password.required' => 'Password harus diisi!'
        ]);

        $user = User::whereUsername($request->username)->first();
        if($user){
            if(!$user->is_active){
                return back()->with('loginError', 'Akun belum aktif, admin akan segera mengaktifkan akun');
            }
        }else{
            return back()->with('loginError', 'Login Gagal!');
        }


        if(Auth::attempt($rules)) {
            $request->session()->regenerate();
            if($user) {
                if($user->is_admin) {
                    return redirect('/admin');
                } else {
                    return redirect()->intended('/dashboard');
                }
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function showFormRegister()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $rules = $request->validate([
            'nama' => 'required|max:255',
            'npm' => 'required|max:10|unique:users',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ],
        [
            'nama.required' => 'Nama harus diisi!',
            'nama.max' => 'Nama harus kurang dari 255 karakter',
            'npm.required' => 'NPM harus diisi!',
            'npm.max' => 'NPM harus kurang dari 10 karakter',
            'npm.unique' => 'NPM sudah terdaftar',
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username harus lebih dari 3 karakter',
            'username.max' => 'Username harus kurang dari 255 karakter',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email harus sesuai format',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password harus lebih dari 5 karakter',
            'password.max' => 'Password harus kurang dari 255 karakter'
        ]);

        $rules['password'] = Hash::make($rules['password']);

        User::create($rules);

        return redirect('/login')->with('success', 'Registrasi Berhasil! akun akan segera diaktifkan');
    }

    public function action(Request $request, User $user)
    {
        $info = "";
        if($request->is_accept == 1){
            $info = "diaktifkan";
            $user->is_active = 1;
            $user->save();
        }else if($request->is_accept == 0){
            $info = "dinonaktifkan";
            $user->is_active = 0;
            $user->save();
        }
        return redirect('/users')->with('success', "User berhasil $info");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
