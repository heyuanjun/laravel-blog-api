<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Dingo\Api\Contract\Http\Validator;
use Blog\Admin\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //如果不熟悉成员变量设置，使用的时候请使用助手函数，例如：$token = auth('api')->tokenById($uid);
    protected $guard = 'admin';

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('refresh', ['except' => ['login','register']]);
    }

    public function register(Request $request)
    {

        $rules = [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:6', 'max:16'],
        ];

        $payload = $request->only('name', 'email', 'password');
        $validator = Validator::make($payload, $rules);

        // 验证格式
        if ($validator->fails()) {
            return $this->response->array(['error' => $validator->errors()]);
        }

        // 创建用户
        $result = Admin::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => bcrypt($payload['password']),
        ]);

        if ($result) {
            return $this->response->array(['success' => '创建用户成功']);
        } else {
            return $this->response->array(['error' => '创建用户失败']);
        }

    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $pwd = bcrypt($credentials['password']);

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return $this->response->errorUnauthorized('登录失败');
    }

    /**
     * Get the authenticated User
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        //return response()->json($this->guard()->user());
        return $this->response->array($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        //return response()->json(['message' => 'Successfully logged out']);
        return $this->response->array(['message' => '退出成功']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
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
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard($this->guard);
    }
}
