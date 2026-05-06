<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StudentController extends Controller
{
    public function profile()
    {
        $student = Auth::user()->studentProfile()->with(['class', 'attendances', 'results'])->first();

        if (!$student) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Student profile not found.');
        }

        return view('student.profile', compact('student'));
    }

    public function editProfile()
    {
        $student = Auth::user()->studentProfile()->with('class')->first();

        if (!$student) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Student profile not found.');
        }

        return view('student.profile-edit', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $user    = Auth::user();
        $student = $user->studentProfile;

        if (!$student) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Student profile not found.');
        }

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'phone'         => 'nullable|string|max:20',
            'password'      => ['nullable', 'confirmed', Password::min(8)],
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'address'       => 'nullable|string|max:500',
            'parent_name'   => 'nullable|string|max:255',
            'parent_phone'  => 'nullable|string|max:20',
        ]);

        // Update user account fields
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update student profile fields
        $student->update([
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'address'       => $request->address,
            'parent_name'   => $request->parent_name,
            'parent_phone'  => $request->parent_phone,
        ]);

        return redirect()->route('student.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
