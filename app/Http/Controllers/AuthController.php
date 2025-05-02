<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // ✅ Register a new user
    public function register(Request $request)
    {
        // Validate incoming request
        $fields = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // Ensure password confirmation is included
        ]);

        // Create a new user
        $user = User::create([
            'name'     => $fields['name'],
            'email'    => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // Create a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respond with the user and the token
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    // ✅ Login a user
    public function login(Request $request)
    {
        // Validate incoming request
        $fields = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Find the user by email
        $user = User::where('email', $fields['email'])->first();

        // If the user doesn't exist or password doesn't match
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create a personal access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respond with the user and the token
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 200);
    }

    // ✅ Logout (revoke current token)
    public function logout(Request $request)
    {
        // Delete the current access token
        $request->user()->currentAccessToken()->delete();

        // Respond with success message
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    // ✅ Get current authenticated user info
    public function user_info(Request $request)
    {
        // Return the authenticated user's details
        return response()->json($request->user());
    }
    // ✅ Update user profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'bio' => 'nullable|string',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'profile_picture' => 'nullable|url',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user
        ]);
    }
}
