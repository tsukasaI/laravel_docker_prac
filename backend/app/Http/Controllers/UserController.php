<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * userのログイン、ログアウト、登録をするクラス
 */
class UserController extends Controller
{
    /**
     * 登録
     *
     * @param Request $request
     * @return JsonResponse
     **/
    public function create(Request $request): JsonResponse
    {
        $data = $request->data;
        $check = User::where('email', $data['email'])->first();
        if ($check) {
            return response()->json([
                'status' => 'ng',
                'message' => 'this email already used'
            ]);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'user created successfully',
            'data' => [
                'token' => Auth::loginUsingId($user->id)->createToken('create'),
            ],
        ]);
    }

    /**
     * ログイン
     *
     * @param Request $request
     * @return JsonResponse
     **/
    public function login(Request $request): JsonResponse
    {
        $data = $request->data;

        $user = User::where('email', $data['email'])->first();

        if (is_null($user)) {
            return response()->json([
                'status' => 'ng',
                'message' => 'no user found',
            ]);
        }

        if ($user && Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status' => 'ok',
                'message' => 'logged in successfully',
                'data' => [
                    'token' => Auth::loginUsingId($user->id)->createToken('login'),
                ],
            ]);
        } else {
            return response()->json([
                'status' => 'ng',
                'message' => 'wrong password',
            ]);
        }
    }

    /**
     * userの情報を返す関数
     *
     * @param Request $request
     * @return JsonResponse
     **/
    public function get(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'data' => $request->user(),
        ]);
    }

    /**
     * logout
     *
     * @param Request $request
     * @return JsonResponse
     **/
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'logged out successfully',
        ]);
    }

    /**
     * authError
     *
     * @return JsonResponse
     **/
    public function authError(): JsonResponse
    {
        return response()->json([
            'status' => 'ng',
            'message' => 'bad request'
        ]);
    }

}
