<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AuthenController extends Controller
{
    //Registration
    public function registration()
    {
        return view('auth.register');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email:users',
            'password' => 'required|min:8|max:12'
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();

        if ($result) {
            return back()->with('success', 'You have registered successfully.');
        } else {
            return back()->with('fail', 'Something wrong!');
        }
    }
    ////Login
    public function login()
    {
        return view('auth.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email:users',
            'password' => 'required|min:8|max:12'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password not match!');
            }
        } else {
            return back()->with('fail', 'This email is not register.');
        }
    }
    //// Dashboard
    public function dashboard()
    {
        // return "Welcome to your dashabord.";
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('pages.dashboard', compact('data'));
    }
    ///Logout
    public function logout()
    {
        if (Session::has('loginId')) {
        Session::pull('loginId');
        return redirect('login');
    }
    return redirect('login'); 
    }

    public function profile()
    {
            $data = array();
            if (Session::has('loginId')) {
                $data = User::where('id', '=', Session::get('loginId'))->first();
            }
            return view('profile.index', compact('data'));
    }
    public function postProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('id', '=', Session::get('loginId'))->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $result = $user->save();

            if ($result) {
                return redirect()->back()->with('success', 'Profile updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }
    public function getPassword(){
        $data = array();
            if (Session::has('loginId')) {
                $data = User::where('id', '=', Session::get('loginId'))->first();
            }
        return view('profile.password',compact('data'));
    }
    public function postPassword(Request $request) {
         $request->validate([
            'newpassword' => 'required|min:6|max:30|confirmed'
        ]);

        $user = User::where('id', '=', Session::get('loginId'))->first();
        if ($user) {
            $user->password = Hash::make($request->newpassword); // Hash the new password
            $user->save();

            return redirect()->back()->with('success', 'Password has been changed successfully');
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }


        
    }

}