<?php
namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService {

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($request)
    {

        $credentials = $request->all();

        $token = JWTAuth::attempt($credentials);

        if (!$token) {
            return $this->sendError('Unauthorized',  __('admin.message.error'),JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);

    }

    /**
     * Register user account.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request){

        $validation = $request->all();

        $unique_email = User::where('email',$request->email)->first();

        if ($unique_email) {
            # code...
            return response()->json([
                'message' => "Email already exists !"
            ], 400);
        }
        if ($request->password != $request->confirm_password) {
            # code...
            return response()->json([
                'message' => "Password don't match !"
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' =>$request->phone,
            'role' =>"User",
        ]);

        $token = JWTAuth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::user();
        return $this->sendResponse( [
            'user' => new UserResource($user),
        ], __('admin.message.success'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return $this->sendResponse( 'Successfully logged out', __('admin.message.success'));
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
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
        $user = Auth::user();
        return $this->sendResponse( [
            'access_token' => $token,
            'user' => new UserResource($user),
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * env('JWT_TTL')
        ], __('admin.message.success'));
    }
}
