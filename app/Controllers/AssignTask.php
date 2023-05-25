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
         //Validation process
          $validation=[
            "to_id"=>[
                "rules"=>"required|is_not_unique['user_access.id]",
                "errors"=>[
                    "required"=>"Please Select Agent to transfer task",
                    "is_not_unique"=>"This agent does not exist in system",
                ]
                ],
            "msg"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Please give instructions for agent task",
                ]
            ]
          ];

          if(!$this->validate($validation))
          {
            return redirect()->back()->with('warning',$this->validator->getErrors())->withInput();
          }
         //Store process
          $input=$this->request->getVar();
          
         //Return Response
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
