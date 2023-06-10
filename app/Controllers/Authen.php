<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RecoveryModel;
use Exception;

class Authen extends BaseController
{
    public function index()
    {
        return view('Auth/login');
    }

    public function verify()
    {
        $validate = [
            
            "mobile" => [
                "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}$/]",
                "errors" => [
                    "required" => "Mobile Number missing",
                    "regex_match" => "Provide an valid Mobile Number",
                ],
            ],

            "password" => [
                "rules" => "required|min_length[6]",
                "errors" => [
                    "required" => "Password Empty",
                    "min_length[8]" => "Provide Password Correctly",
                ],
            ],

        ];


        //check 
        if (!$this->validate($validate)) {
          
            return redirect()->back()->withInput()->with('warning',$this->validator->getErrors());
        }



        //check email,password,status & role

        $model = new UserModel();

        $mobile = $this->request->getVar('mobile');
        $password = $this->request->getVar('password');

        $row = $model->where("mobile", $mobile)->first();
        // dd($row);

        if ($row) {
            //valid email which exist in database
            //now check password

            if ($row->password == md5($password)) {
                //Now check account is active or not
                if ($row->status == "1") {
                     $userInfo=new \App\Models\UserInfo();
                     $userData=$userInfo->where('user_id',$row->id)->first();
                    $data=[
                        'employ_id'=>$row->employ_id,
                        'id'=>$row->id,
                        'name'=>$row->name,
                        'user_info'=>$userData,
                    ];
                  
                  if($row->role=="1")
                  {
                    $data['role']='employ';
                     session()->set('user',$data);

                     
                    
                  }else{
                    $data['role']='admin';
                    session()->set('user',$data);
                  }
                  //activity store
                  try{
                    $activityModel=new \App\Models\EmployActivityModel();
                  $data=[
                    "user_id"=>$row->id,
                    "type"=>"0",
                  ]; 
                  $activityModel->save($data);
                  }catch(Exception $e){

                  }
                  return redirect()->to('/')->with('success',"Welcome {$row->name} !");
                   
                } else {
                    return redirect()->back()->withInput()->with('warning','Inactive Account Please Contact With Administration');
                }
            } else {
              
               return redirect()->back()->withInput()->with('warning','Invalid Mobile Or Password');
            }
        } else {

           return redirect()->back()->withInput()->with('warning','Invalid Mobile number no users found');
        }
    }

   //Forget Password
   public function forgetPassword()
   {
        return view('Auth/recover');
   }
   //Email Verify
   public function emailVerify()
   {
        $userModel= new UserModel();
        $check=$userModel->where('email',$this->request->getVar('email'))->first();
        if($check==null)
        {
          return redirect()->back()->withInput()->with('warning','Invalid email please provide correct  email!');
        }

        //Creating otp
        // $combination=['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','O','X','L','M','N','O','R','Q','T','U','V','S','X','Y','Z'];
         $otp=rand(000000,999999);
         //Sent email
         
   }
   //OTP verification
   public function otpVerification()
   {

   }
   //Take New password
   public function newPassword()
   {

   }
    public function destroy ()
    {
        session()->remove('user');
        session()->destroy();
        return redirect()->to('/login');
    }
    
}
