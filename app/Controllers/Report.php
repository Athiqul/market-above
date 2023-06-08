<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\Customer;
use App\Models\MeetingReportModel;
use App\Models\EmployActivityModel;
class Report extends BaseController
{
    //Company all List Report
    public function companyList()
    {
        $model=new Customer();
        $items= $model->findAll();
        return view('report/company_report',compact('items')); 
    }
    //Company Report with date
    //All Meeting List
    public function meetingList()
    {
        $model=new MeetingReportModel();
        $items= $model->findAll();
        return view('report/meeting_report',compact('items')); 
    }
    //Date wise Meeting List
    public function index()
    {
        
    }
}
