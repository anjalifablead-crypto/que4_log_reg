<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function registration()
    {
        return view('registration');
    }
    public function profile() 
    {
        return view('profile');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uname'   => 'required|string|max:100',
            'age'     => 'required|integer|min:18',
            'mail'    => 'required|email|unique:users,email',
            'gender'  => 'required',
            'hobby'   => 'nullable|array',
            'hobby.*' => 'string',
            'city'    => 'required|string|max:100',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pass'    => 'required|min:6',
            'rpass'   => 'required|same:pass'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        $user = User::create([
            'uname'   => $request->uname,
            'age'     => $request->age,
            'email'    => $request->mail,
            'gender'  => $request->gender,
            'hobby'   => $request->hobby ? implode(',', $request->hobby) : null,
            'city'    => $request->city,
            'image'   => $imageName,
            'password'    => Hash::make($request->pass), // Always bcrypt
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'success'  => true,
            'message'  => 'User created successfully!',
            'data'     => $user,
            'token'    => $token,
            'redirect' => url('/')
        ]);
    }

     public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user  = Auth::user();
            $token = $user->createToken('LaravelPassportToken')->accessToken;

            // dd($token);

            return response()->json([
                'success' => true,
                'token'   => $token,
                'user'    => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }
    public function profile1(Request $request)
    {
        // $user = Auth::guard('api')->user();
        $user = $request->user(); 
        return response()->json([
            'success' => true,
            'user'    => $user
        ]);
        
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    
}
