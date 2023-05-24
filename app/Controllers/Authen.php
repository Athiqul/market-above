<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


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


    public function destroy ()
    {
        session()->remove('user');
        session()->destroy();
        return redirect()->to('/login');
    }
    
}
