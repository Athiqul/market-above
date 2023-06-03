<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\Contacts As contactModel;

class Contacts extends BaseController
{
    public function index()
    {
        return view('contacts/index');
    }
}
