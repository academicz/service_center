<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLoginPage()
    {
        return view('Admin.login');
    }

    public function getShopLogin()
    {
        return view('Shop.login');
    }

    public function getUserLogin()
    {
        return view('User.login');
    }

    public function postAdminLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => Constants::$ADMIN_USER])) {
            return redirect()->back()->with(['error' => 'Login Failed']);
        }
        return redirect()->route('adminHome');
    }

    public function postUserLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => Constants::$CUSTOMER_USER])) {
            return redirect()->back()->with(['error' => 'Login Failed']);
        }
        return redirect()->route('home');
    }

    public function postServiceCenterLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => Constants::$SERVICE_CENTER_USER])) {
            return redirect()->back()->with(['error' => 'Login Failed']);
        }
        return redirect()->route('shopHome');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function shopLogout()
    {
        Auth::logout();
        return redirect()->route('getShopLogin');
    }
}
