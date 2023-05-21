<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Customer;
use App\Models\MeetingReportModel;

class UserActivity extends BaseController
{
    //Added Company List
    public function companyList()
    {
        //set Model
        $companyModel=new Customer();

        //getUser id from session
        $userId=session()->get('user')['id'];

        //Pagination Request
        $limit=$this->request->getVar('limit')??10;
        $page=$this->request->getVar('page')??1;
        $totalRecord=count( $companyModel->where('user_id',$userId)->findAll());
        
        $totalPage=ceil($totalRecord/$limit);
        $offset=($page-1)*$limit;
      
        $chunk=$companyModel->where('user_id',$userId)->orderBy('id','desc')->findAll($limit,$offset);
        $payload=(object)[
            "records"=>$chunk,
            "totalPage"=>$totalPage,
            "totalRecord"=>$totalRecord,
            "currentPage"=>$page
        ];
        return view('activity/company_list',compact('payload'));
    }

    //Attend Meeting List
    public function meetingList()
    {
              //set Model
        $meetingModel=new MeetingReportModel();

        //getUser id from session
        $userId=session()->get('user')['id'];

        //Pagination Request
        $limit=$this->request->getVar('limit')??10;
        $page=$this->request->getVar('page')??1;
        $totalRecord=count( $meetingModel->where('user_id',$userId)->findAll());
        
        $totalPage=ceil($totalRecord/$limit);
        $offset=($page-1)*$limit;
      
        $chunk=$meetingModel->where('user_id',$userId)->orderBy('id','desc')->findAll($limit,$offset);
        $payload=(object)[
            "records"=>$chunk,
            "totalPage"=>$totalPage,
            "totalRecord"=>$totalRecord,
            "currentPage"=>$page
        ];
       // dd($payload);
        return view('activity/meeting_list',compact('payload'));
    }
}
