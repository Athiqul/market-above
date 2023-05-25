<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AssignTaskModel;
use Exception;

class AssignTask extends BaseController
{
    private $taskModel;
    public function __construct()
    {
        $this->taskModel=new AssignTaskModel();
    }

    //All latest task list 
    public function index()
    {
        //
    }

    //create new task for team members
    public function create()
    {
           return view('assign/add_task');
    }

    //store task record
    public function store()
    {

    }
    //view task 
    public function show()
    {

    }
    //edit task
    public function edit()
    {

    }

    //update task function
    public function update()
    {

    }
    //task report by search
    public function search()
    {

    }
}
