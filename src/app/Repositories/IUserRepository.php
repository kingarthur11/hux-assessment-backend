<?php

namespace App\Repositories;

interface IUserRepository
{
    // public function createUser($user);
    public function register($userData);
    public function login($userData);
}
