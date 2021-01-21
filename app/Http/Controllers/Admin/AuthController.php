<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Blog\Admin\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // 查看 config/auth.php 的 guards 设置项，我 auth 中配置的 driver->jwt 为 admin
    protected $guard = 'admin';

    /**
     * Create a new AuthController instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('refresh', [
            'except' => [
                'login',
                'register',
            ],
        ]);
    }

    public function register(Request $request)
    {

        $rules = [
            'username' => ['required'],
            'email' => ['required', Rule::unique('admin', 'email')],
            'password' => [
                'required',
                'min:6',
                'max:255',
            ],
        ];

        $payload = $request->only('username', 'email', 'password');
        $validator = Validator::make($payload, $rules);

        // 验证格式
        if ($validator->fails()) {
            return $this->response->array(['error' => $validator->errors()]);
        }

        // 创建用户
        $result = Admin::create([
            'username' => $payload['username'],
            'email' => $payload['email'],
            'password' => bcrypt($payload['password']),
        ]);

        if (!$result) {
            return $this->response->array(['error' => '创建用户失败']);
        }

        return $this->response->array(['success' => '创建用户成功']);
    }

    /**
     * Get a JWT token via given credentials.
     * @param \Illuminate\Http\Request $request
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
    public function getAdminWithMe()
    {
        return $this->response->array($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     * @return JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return $this->response->array(['message' => '退出成功']);
    }

    /**
     * Refresh a token.
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     * @param string $token
     * @return JsonResponse
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
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard($this->guard);
    }

    public function test(){
        echo "test!!";
    }

}
