<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=180,min_height=180,max_width=2048,max_height=2048|max:2048',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        try {

            if (request()->hasfile('avatar')) {
                $avatarName = time() . $request['name'][0] . '.' . request()->avatar->getClientOriginalExtension();
                request()->avatar->move(public_path('avatars'), $avatarName);
            }

            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => \Illuminate\Support\Facades\Hash::make($request['password']),
                'avatar' => $avatarName ?? NULL,
                'bio' => '',
                'role' => 'user',
            ]);

            // Generate a JWT token for the registered user
            $token = $this->guard()->attempt(['email' => $request->email, 'password' => $request->password]);

            return $this->respondWithToken($token);
            
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Error creating user']);
        }
    }


    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(\Illuminate\Http\Request $request)
    {
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $loginField => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Invalid Login Details'], 401);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user(), 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}