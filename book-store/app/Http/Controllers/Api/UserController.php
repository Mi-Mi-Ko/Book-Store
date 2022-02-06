<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;

class UserController extends Controller
{
    public $user;
    
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    
    public function login(Request $request)
    {
        Log::info('UserController Login....');
        $token = $this->user->login($request);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => "User logged in successfully",
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/api/users",
     *     summary="ユーザー情報取得",
     *     description="ユーザー情報を取得します。",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request error",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized error"
     *     ),
     * )
     */
    public function index()
    {
        log::info('getAllUsers.........');
        $users = $this->user->getAllUsers();
        return response()->json([
            "success" => true,
            "message" => "User are fetched.",
            "data" => $users
        ]);
    }

    /**
     * @SWG\Post(
     *     path="/api/register",
     *     summary="ユーザー情報登録",
     *     description="ユーザー情報を登録します。",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         in="body",
     *         name="User",
     *         description="List of user object",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="name", type="string", description="ユーザー名"),
     *             @SWG\Property(property="mail", type="string", description="メールアドレス"),
     *             @SWG\Property(property="password", type="string", description="パスワード"),
     *             @SWG\Property(property="dob", type="string", format="date", description="生年月日"),
     *             @SWG\Property(property="address", type="string", description="住所"),
     *             @SWG\Property(property="gender", type="integer", description="性別"),
     *             @SWG\Property(property="phone", type="string", description="電話番号"),
     *             @SWG\Property(property="avatar_url", type="string", description="画像"),
     *             @SWG\Property(property="user_type", type="integer", description="ユーザータイプ"),
     *             @SWG\Property(property="auth_status", type="integer", description="ユーザー権限"),
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request error",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized error"
     *     ),
     * )
     */
    public function register(Request $request)
    {
        Log::info('UserController Register....');
        $input = $request->except(['_token','_method']);
        $token = $this->user->register($input);

        return response()->json([
            'message' => "User registered successfully",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        Log::info('UserController Logout....');
        $this->user->logout($request);
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function edit($id)
    {
        log::info('getUserById.........');
        $user = $this->user->getUserById($id);
        return response()->json([
            "success" => true,
            "message" => "User is fetched.",
            "data" => $user
        ]);
    }

    public function update(Request $request, $id = null)
    {   
        $input = $request->except(['_token','_method']);

        if(!is_null($id)) 
        {
            log::info('Update User.........');
            $this->user->update($id, $input);
        }
        return redirect()->route('user.list');
    }
}