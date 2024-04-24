<?php

namespace App\Repositories;

use App\Models\UserContact;
use App\Repositories\IUserContactsRepository;
use GuzzleHttp\Client;
use App\Events\CreateNotification;


class UserContactsRepository implements IUserContactsRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserContact::class;
    }
   
    public function create($request)
    {
        $user = UserContact::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'phoneNumber' => $request['phoneNumber'],
        ]);
        return $user;
    }

    public function getone($id){
        $user = UserContact::where('id', $id)->first();
        if(empty($user)) 
        {
           return ['data' => [], 'message' => "User not found", 'status' => false];
        }
        // return $user;
        return ['data' => $user, 'message' => "User contacts updated successfuly", 'status' => true];
    }

    public function getall() {
        $user = UserContact::orderBy('created_at', 'desc')->paginate(15);
        return $user;
    }

    public function update($request, $id) {
        $user = UserContact::where('id', $id)->first();
        if(empty($user)) 
        {
           return ['data' => [], 'message' => "User not found", 'status' => false];
        }
        UserContact::where('id', $id)->update([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'phoneNumber' => $request['phoneNumber'],
        ]);
        return ['data' => [], 'message' => "User contacts updated successfuly", 'status' => true];
        // return true;
    }

    public function destroy($id) {
        $user = UserContact::where('id', $id)->first();
        if(empty($user)) 
        {
            return ['data' => [], 'message' => "User not found", 'status' => false];
        }
        UserContact::where('id', $id)->delete();
        return ['data' => [], 'message' => "User contact deleted successfuly", 'status' => true];
        // return true;
    }

}
