<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobAuthController extends Controller
{
    protected $authService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function detail()
    {
        return $this->authService->detail();
    }

    public function update(Request $request)
    {
        return $this->authService->update($request);
    }

    /**post
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules = [
            "username" => "required|string",
            "password" => "required|string",
        ];

        $messages = [
            "username.required" => "Username harus diisi",
            "password.required" => "Password harus diisi",
        ];

        $validate = Validator::make($request->all(), $rules, $messages);
        if ($validate->fails()) {
            return response()->json([
                "status" => "error",
                "message" => $validate->errors()->first(),
            ], 400);
        }

        $credentials = request(['username', 'password']);

        if (!$token = auth()->guard("api")->attempt($credentials)) {
            return response()->json([
                "status" => "error",
                "message" => "Username / Password salah"
            ], 400);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'data' => auth()->user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status" => "success",
            "message" => "Successfully logged out"
        ], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth('api')->factory()->getTTL() * 60 // 12 jam
        ]);
    }
}
