<?php
namespace App\Services;

use App\Repositories\Contact\ContactRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Client\StoreContactRequest;

class ContactService
{
    protected $contact;
    
    // inject ContactRepositoryInterface in construct
    public function __construct(ContactRepositoryInterface $contacts)
    {
        $this->contact = $contacts;
    }

    // get contacts
    public function getContacts()
    {
        return $this->contact->getAll();
    }

    // store contacts
    public function storeContact(StoreContactRequest $request)
    {
        $attributesContact = [
            'full_name' => $request->fullName,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => config('define.disable'),
        ];

        $result = $this->contact->create($attributesContact);

        return $result;
    }

    // function accepter contact
    public function acceptContact(Request $request)
    {
        $id = $request->id;
        $checkStatus = $this->contact->find($id);

        if ($checkStatus->status == config('define.active')) {
            $attributes = [
                'status' => config('define.disable'),
            ];
        } else {
            $attributes = [
                'status' => config('define.active'),
            ];
        }
        
        $result = $this->contact->update($id, $attributes);

        return $result;
    }

    public function geContactNotActive()
    {
        return $this->contact->getContact(5);
    }
}
