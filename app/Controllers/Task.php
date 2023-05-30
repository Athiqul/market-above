<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\AssignTaskModel;

class Task extends BaseController
{
     private $taskModel;
     public function __construct()
     {
        $this->taskModel=new AssignTaskModel();
     }
    //Show Schedule task of user
    public function index()
    {
        //get current user id
        $userId=session()->get('user')['id'];
        //current date
        $currDate= Date('Y-m-d');
        $task=$this->taskModel->where('end_date >=',$currDate)->where('to_id',$userId)->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('task/index',['task'=>$task,'pager'=>$pager]);
    }

    //Show Complete task of user

    public function complete()
    {
        $userId=session()->get('user')['id'];
        $task=$this->taskModel->where('complete','1')->where('to_id',$userId)->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('task/index',['task'=>$task,'pager'=>$pager]);
    }

    //Show incomplete task
    public function pending()
    {
        $userId=session()->get('user')['id'];
        $task=$this->taskModel->where('complete','0')->where('to_id',$userId)->where('end_date<=',date('Y-m-d'))->orderBy('id','desc')->paginate(10);
        $pager=$this->taskModel->pager;
        return view('task/index',['task'=>$task,'pager'=>$pager]);
    }

    //Make it complete
     public function makeComplete($taskId)
     {
        $userId=session()->get('user')['id'];
        //check
        $task= $this->taskModel->where('id',$taskId)->where('to_id',$userId)->where('end_date>=',date('Y-m-d'))->first();
        if($task==null)
        {
            return redirect()->back()->with('warning','Task deadline over, can not change it');
        }
        try{
          $task->complete=='0'?$task->complete='1': $task->complete='0';
         
          $this->taskModel->save($task);
          return redirect()->back()->with('success','Task status updated Successfully!');
        }catch(Exception $e)
        {
               return redirect()->back()->with('warning',$e->getMessage());
        }
     }
    //make it pending
}
