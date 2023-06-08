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
        return view('home/index',compact('totalCompany','totalMeeting','totalInterest','pendingTask','interestItems'));
    }
}
