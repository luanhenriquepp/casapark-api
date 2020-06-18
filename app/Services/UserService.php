<?php

namespace App\Services;

use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class UserService
{

    protected $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return JsonResponse
     */
    public function login(){

        if(!Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return response()->json([
                'success' => false,
                'message'=> 'Não autorizado!'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token =  $user->createToken('MyApp')-> accessToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'user_id' => Auth::user()->getAuthIdentifier()
        ], Response::HTTP_OK);
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $user = $this->user->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $user->save();

        $token =  $user->createToken('MyApp')->accessToken;
        return response()->json([
            'data' => $user,
            'token' => $token,
            'success' => true
        ], Response::HTTP_OK);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

}
