<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\UserInfo;
use Exception;

use function PHPUnit\Framework\throwException;

class Team extends BaseController
{

    private $authModel,$infoModel;
    public function __construct()
    {
        $this->authModel=new UserModel();
        $this->infoModel=new UserInfo();
    }
    //All team member  list
    public function index()
    {
        $list=$this->authModel->paginate(10);
        $pager=$this->authModel->pager;
        return view('team/index',compact('list','pager'));
    }

    //Create team member
    public function create()
    {
         return view('team/create');
    }
    //Store team member data
    public function store()
    {
         //validation
         $validation=[
            "mobile" => [
                "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}||[0-9]{8}$/]|is_unique[user_access.mobile]",
                "errors" => [
                    "required" => "Mobile Number missing",
                    "regex_match" => "Provide an valid contact Number for telephone It should be 8 digits and mobile it should 11 digits (remove ++880)",
                    "is_unique" => "This mobile number already in the system"
                ],
            ],
            "email" => [
                "rules" => "required|valid_email|is_unique[user_access.email]",
                "errors" => [
                    "valid_email" => "Provide an valid email address",
                    "is_unique" => "This email already in the system"
                ],
            ],
            "employ_id" => [
                "rules" => "required|is_unique[user_access.employ_id]",
                "errors" => [
                    "is_unique" => "This email already in the system",
                    "required"=>"Please Provide employ Id",
                ],
            ],

            "name" => [
                "rules" => "required",
                "errors" => [
                    
                    "required"=>"Please Provide name of this new user",
                ],
            ],

            "password" => [
                "rules" => "required|min_length[6]|matches[confirm_password]",
                "errors" => [
                    
                    "required"=>"Please Provide password of this new user",
                    "min_length"=>"Password Should be at least 6 characters"
                ],
            ],
            "confirm_password" => [
                "rules" => "required|min_length[6]",
                "errors" => [
                    
                    "required"=>"Please Provide password of this new user",
                    "min_length"=>"Password Should be at least 6 characters"
                ],
            ],


         ];

         if(!$this->validate($validation))
         {
            return redirect()->back()->withInput()->with('warning', $this->validator->getErrors());
         }
         //Store
         try{
            $data=[
                "employ_id"=>esc($this->request->getVar('employ_id')),
                "name"=>esc($this->request->getVar('name')),
                "mobile"=>$this->request->getVar('mobile'),
                "email"=>$this->request->getVar('email'),
                "password"=>md5(esc($this->request->getVar('password'))),
            ];
          $this->authModel->save($data);
            
                return redirect()->back()->with('success','User Account Created Successfully');
            
          
         }catch(Exception $ex){
              return redirect()->back()->with('warning',$ex->getMessage());
         }
         //notification
    }

    //update team member info
    public function update()
    {

    }

    //Status Update
    public function status($id)
    {
       $checkUser= $this->authModel->find($id);
       if($checkUser==null)
       {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
       } 

       $checkUser->status=='1'?$checkUser->status='0':$checkUser->status=1;
       try{
        $this->authModel->save($checkUser);
        return redirect()->back()->with('success','Status Updated');
       }catch(Exception $ex){
         return redirect()->back()->with('warning',$ex->getMessage());
       }
      
    }

    //show profile
    public function userProfile($id)
    {

       // dd($id);
        $basicInfo=$this->authModel->find($id);
        if($basicInfo==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $profileInfo=$this->infoModel->where('user_id',$id)->first();
        $data=[
           'basic'=>$basicInfo,
           'info'=>$profileInfo,
        ];


        return view('team/user_profile',compact('data'));
    }
}
