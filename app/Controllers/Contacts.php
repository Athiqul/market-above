<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\Contacts As contactModel;

class Contacts extends BaseController
{

    //For managing contact
    public function index()
    {
        return view('contacts/index');
    }

    //View for emergency contact
    public function emergency()
    {
        $contactList=new contactModel();
        $items=$contactList->where('status','1')->findAll();
        return view('contacts/emergency',compact('items'));
    }
}
