<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Company extends BaseController
{
    public function create()
    {
        if($this->request->getPost())
        {
              dd($this->request->getVar());
        }
        return view ('company/add-company');
    }
}
