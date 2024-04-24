<?php

namespace App\Http\Controllers\API;

use App\Repositories\IUserRepository;
use App\Http\Requests\StoreUser;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CreateUserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends AppBaseController
{
    private $iUserRepository;
    public function __construct(IUserRepository $iUserRepository)
    {
        $this->iUserRepository = $iUserRepository;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUser $request)
    {
        $response = $this->iUserRepository->register($request);
        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['message']);
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $response = $this->iUserRepository->login($credentials);
        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['message']);
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
    }
}
