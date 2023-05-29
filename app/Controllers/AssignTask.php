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
        $data=$this->taskModel->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('assign/index',['data'=>$data,'pager'=>$pager]);
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
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Please Select Agent to transfer task",
                   
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
          //dd($input);
          unset($input['agent_name']);
          //dd($input);
          try{
            $this->taskModel->save($input);
            return redirect()->back()->with('success','Task Added to the '.$this->request->getVar('agent_name'));
          }catch(Exception $e){
            return redirect()->back()->with('warning',$e->getMessage())->withInput();
          }
         //Return Response
    }
    //view task 
    public function show()
    {
         
    }
    //edit task
    public function edit($id)
    {
        $task=$this->taskModel->find($id);
        if($task==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('assign/edit_task',['task'=>$task]);
    }

    //update task function
    public function update($id)
    {
        $task=$this->taskModel->find($id);
        if($task==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

          //Validation process
          $validation=[
            "to_id"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Please Select Agent to transfer task",
                   
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
           //dd($input);
           unset($input['agent_name']);

        $task->fill($input);
        if(!$task->hasChanged())
        {
            return redirect()->back()->with('info','Nothing updated');
        }

        try{
           $this->taskModel->save($task);
           return redirect()->back()->with('success','Successfully Task updated!');
        }catch(Exception $e){
            return redirect()->back()->with('warning',$e->getMessage());
        }


    }
    //task report by search
   
    public function allReport()
    {
        $data=$this->taskModel->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('assign/report',['data'=>$data,'pager'=>$pager]);  
    }
    //pending Report
    public function pendingReport()
    {
        $data=$this->taskModel->where('complete','0')->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('assign/report',['data'=>$data,'pager'=>$pager]); 
    }

    //completed Report
    public function completeReport()
    {
        $data=$this->taskModel->where('complete','1')->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('assign/report',['data'=>$data,'pager'=>$pager]); 
    }
    //Search Report
    public function search()
    {
          $search=$this->request->getVar('search');
          if(strlen($search)<3)
          {
            return redirect()->back()->with('warning','Not enough letters write more!');
          }

          
    }
}
