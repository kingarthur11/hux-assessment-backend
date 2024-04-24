<?php

namespace App\Http\Controllers\API;

use App\Models\UserContact;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\IUserContactsRepository;

class UserContactController extends AppBaseController
{
    private $iUserContactsRepo;
    public function __construct(IUserContactsRepository $iUserContactsRepository)
    {
        $this->iUserContactsRepo = $iUserContactsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->iUserContactsRepo->getall();
        return $this->sendResponse($response, 'User contacts retrieved successfuly');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = [
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'phoneNumber' => $request->input('phoneNumber'),
        ];
        $response = $this->iUserContactsRepo->create($userData);
        if ($response['status']) {
            return $this->sendResponse($response['data'], 'User contact created successfuly');
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
        // return $this->sendResponse($user, 'User contact created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->iUserContactsRepo->getone($id);
        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['message']);
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function edit(UserContact $userContact)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->iUserContactsRepo->update($request, $id);
        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['message']);
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
        // return $this->sendResponse($user, 'User contacts updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->iUserContactsRepo->destroy($id);
        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['message']);
        } else {
            return $this->sendError($response['message'], $response['data']);
        }
        // if ($response) {
        //     return $this->sendResponse($response, 'User contacts deleted successfuly');
        // } else {
        //     return $this->sendError($response['message'], $response['data']);
        // }
    }
}
