<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use illuminate\Support\Facades\Validator;
// use Validator;

class AuthController extends Controller {

// Register....................................................................................

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'no_hp' => 'required|string',
            'no_dana' => 'required|string',
            'foto_profil' => 'nullable|image|file|max:3048', // Max size 3MB
            'alamat' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        // Upload foto profil jika ada
        $foto_profil_path = null;
        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $fileName = time() . '_' . $foto_profil->getClientOriginalName();
            $foto_profil_path = $foto_profil->store('profil_photos', 'public');
        }

        // Buat user baru dengan data yang diberikan
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'no_hp' => $data['no_hp'],
            'no_dana' => $data['no_dana'],
            'foto_profil' => $foto_profil_path,
            'alamat' => $data['alamat'],
        ]);

        return response()->json($user, 201);
    }


// LOGIN ..........................................................................

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Pengecekan apakah email terdaftar
    $user = User::where('email', $credentials['email'])->first();
    if (!$user) {
        return response()->json(['error' => 'Email belum terdaftar'], 401);
    }

    // Pengecekan apakah password sesuai
    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Password yang dimasukkan salah'], 401);
    }

    // Generate token
    $token = JWTAuth::attempt($credentials);
    if (!$token) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
}

// EDIT PROFILE ................................................................


    public function editProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'no_hp' => 'nullable|string',
            'no_dana' => 'nullable|string',
            'foto_profil' => 'nullable|image|file|max:3048', // Max size 3MB
            'alamat' => 'nullable|string',
            'poin' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();

        // Upload foto profil jika ada
        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $foto_profil_path = $foto_profil->store('profil_photos', 'public');
            $data['foto_profil'] = $foto_profil_path;
        }

        // Hash password jika ada
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        // // Update informasi profil pengguna
        // $user->update($data);

        return response()->json(['message' => 'Profile successfully updated \n', $user], 200);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => $this -> getUserInfo(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

// LOGOUT .........................................................................

    public function logout() {
        $token = JWTAuth::getToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 400);
        }

        try {
            JWTAuth::invalidate($token);
            return response()->json(['message' => 'User logged out successfully'], 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token not provided'], 400);
        }
    }

    public function getUserInfo() {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
