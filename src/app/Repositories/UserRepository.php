<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRepository implements IUserRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }
   
    public function login($request)
    {
        $token = Auth::attempt($request);
        if (!$token) {
            return ['data' => [], 'message' => "Email or password does not exist", 'status' => false];
        }

        $user = Auth::user();
        $response = [];
        $response['token'] = $token;
        $response['user'] = $user;
        return ['data' => $response, 'message' => "User data saved successfully", 'status' => true];

    }

    public function register($request){
        $user = User::where('email', $request->input('email'))->first();
        if($user) 
        {
           return ['data' => [], 'message' => "User already exist", 'status' => false];
        }
        $userData = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
        ];
        
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        $token = Auth::login($user);
        $response = [];
        $response['token'] = $token;
        $response['user'] = $user;
        return ['data' => $response, 'message' => "User data saved successfully", 'status' => true];
    }

}
