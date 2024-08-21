<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(StoreAdminRequest $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];

        $data  = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isExist = Admin::where('username', $data['username'])->first();

        if ($isExist) return redirect()->back()->with('error', 'Username already exists');
        
        
        $admin = Admin::create($data);

        return redirect()->route('login')->with('success', 'Admin created successfully');
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
        
        $data  = $request->only('username', 'password');
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::guard('admin')->attempt($data, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('username', $data['username']);
        }
        
        return back()->with('status', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
