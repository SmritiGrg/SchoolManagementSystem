<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginChoice()
    {
        return view('EduFlow.login');
    }

    public function showLoginForm($role)
    {
        if (!in_array($role, ['teacher', 'student'])) {
            abort(404);
        }

        return view('EduFlow.login-form', compact('role'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:teacher,student'
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = $request->role;

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            $userName = Auth::user()->name;

            flash()->success("Welcome back, {$userName}!");

            return redirect()->route($role . '.dashboard');
        }

        return redirect()
            ->to('/loginForm/' . $request->role)
            ->with('login_error', 'The provided credentials do not match our records.')
            ->withInput($request->only('email'));
    }

    public function showAdminLogin()
    {
        return view('EduFlow.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $userName = Auth::user()->name;
            flash()->success("Welcome back, Administrator {$userName}!");

            return redirect()->route('admin.dashboard');
        }

        // flash()->addError('Invalid admin credentials. Please try again.');

        // return back()->onlyInput('email');


        return back()
            ->with('login_error', 'The provided credentials do not match our records.')
            ->withInput($request->only('email'));
    }

    public function teacherDashboard()
    {
        return view('teacher.dashboard');
    }

    public function studentDashboard()
    {
        return view('student.dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $userName = Auth::user()->name;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->addInfo("Goodbye, {$userName}! You have been logged out successfully.");

        return redirect('/');
    }
}
