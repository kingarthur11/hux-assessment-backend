<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Http\Controllers\API\UserContactController;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\UserContactsRepository;
use App\Http\Requests\StoreUser;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;
use App\Models\UserContact;


class UserUnitTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testUnitCreateUserContact()
    {
        $contact = [
            'fname' => 'Patton',
            'lname' => 'England',
            'phoneNumber' => '+1 (840) 546-2739',
        ];
      
        $userContactsRepository = new UserContactsRepository(new UserContact);
        $response = $userContactsRepository->create($contact);
      
        $this->assertInstanceOf(UserContact::class, $response);
        $this->assertEquals($contact['fname'], $response->fname);
        $this->assertEquals($contact['lname'], $response->lname);
        $this->assertEquals($contact['phoneNumber'], $response->phoneNumber);
    }

    public function testUnitShowUserContact()
    {
        $contact = [
            'fname' => 'Patton',
            'lname' => 'England',
            'phoneNumber' => '+1 (840) 546-2739',
        ];
      
        $userContactsRepository = new UserContactsRepository(new UserContact);
        $response = $userContactsRepository->create($contact);
        // dd($response);
        $userContactsRepository = new UserContactsRepository(new UserContact);
        $found = $userContactsRepository->getone($response->id);

        $newResponse = json_decode($response, true);
        $newFound = json_decode($response, true);
        $this->assertEquals($newFound['fname'], $newResponse['fname']);
        $this->assertEquals($newFound['lname'], $newResponse['lname']);
        $this->assertEquals($newFound['phoneNumber'], $newResponse['phoneNumber']);
    }
    
    public function testUnitUpdateUserContact()
    {
        $originalContact = [
            'fname' => 'PattonNic',
            'lname' => 'EnglandGyn',
            'phoneNumber' => '+1 (841) 544-2739',
        ];
    
        $userContactsRepository = new UserContactsRepository(new UserContact);
        $response = $userContactsRepository->create($originalContact);
    
        $updatedContactData = [
            'fname' => 'Patton',
            'lname' => 'England',
            'phoneNumber' => '+1 (840) 546-2739',
        ];
        
        $update = $userContactsRepository->update($updatedContactData, $response->id);
    
        $updatedContact = UserContact::find($response->id);
    
        $this->assertNotNull($updatedContact);
        $this->assertTrue($update['status']);
        $this->assertEquals($updatedContactData['fname'], $updatedContact->fname);
        $this->assertEquals($updatedContactData['lname'], $updatedContact->lname);
        $this->assertEquals($updatedContactData['phoneNumber'], $updatedContact->phoneNumber);
    }
    
    public function testUnitDeleteUserContact()
    {
        $originalContact = [
            'fname' => 'PattonNic',
            'lname' => 'EnglandGyn',
            'phoneNumber' => '+1 (841) 544-2739',
        ];
    
        $userContactsRepository = new UserContactsRepository(new UserContact);
        $response = $userContactsRepository->create($originalContact);
      
        $carouselRepo = new UserContactsRepository($response);
        $delete = $carouselRepo->destroy($response->id);
        
        $this->assertTrue($delete['status']);
    }
}
