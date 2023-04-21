<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Meeting extends BaseController
{

    // All Meeting Report with Pagination
    public function index()
    {
        
    }

    //Meeting Record Create view
    public function create()
    {
         return view('meeting/create');
    }

    //Meeting Record Store into database
    public function store()
    {

    }

    //Meeting Record identical show
    public function show($id)
    {

    }

    //Meeeting Record edit render view
    public function edit($id)
    {

    }

    //Meeting Record update
    public function update($id)
    {

    }
}
