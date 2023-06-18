<?php

namespace App\Controllers;
use App\Models\Customer;
use App\Models\MeetingReportModel;
use App\Models\InterestServicesModel;
use App\Models\AssignTaskModel;
class Home extends BaseController
{
    public function index()
    {
        //get session
        $role=session()->get('user')['role'];
        if($role=='admin')
        {

            //count Company added
        $company= new Customer();
        $totalCompany=count($company->findAll());  
        //Meeting Done
        $meeting= new MeetingReportModel();
        $totalMeeting=count($meeting->findAll()); 
        //total number of interest on service and products
        $interest= new InterestServicesModel();
        $interestItems=$interest->orderBy('id','desc')->findAll(20);
        $totalInterest=count($interest->findAll()); 
        //Task Pending
        $task=new AssignTaskModel();
        $pendingTask=count( $task->where('complete','0')->findAll());
        //Client Interest

        } else{
            $getUserId=session()->get('user')['id'];
            $company= new Customer();
            $totalCompany=count($company->where('user_id',$getUserId)->findAll());  
            //Meeting Done
            $meeting= new MeetingReportModel();
            $totalMeeting=count($meeting->where('user_id',$getUserId)->findAll()); 
            //total number of interest on service and products
            $interest= new InterestServicesModel();
            $interestItems=$interest->orderBy('id','desc')->findAll(20);
            
            $totalInterest='**'; 
            //Task Pending
            $task=new AssignTaskModel();
            $pendingTask=count( $task->where('complete','0')->where('to_id',$getUserId)->findAll());
        }
        
        return view('home/index',compact('totalCompany','totalMeeting','totalInterest','pendingTask','interestItems'));
    }
}
