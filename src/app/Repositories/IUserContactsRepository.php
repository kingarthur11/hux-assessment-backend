<?php

namespace App\Repositories;

interface IUserContactsRepository
{
    // public function createUser($user);
    public function create($userData);
    public function getone($id);
    public function getall();
    public function update($userData, $id);
    public function destroy($id);
}