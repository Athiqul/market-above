<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use \App\Models\UserModel;
 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Authen extends ResourceController
{
    // User password and mobile number verify
     //Authentication Process
     public function authUser()
     {
         # code...
         //validation process
         $validate = [
            
             "mobile" => [
                 "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}$/]",
                 "errors" => [
                     "required" => "Mobile Number missing",
                     "regex_match" => "Provide an valid Mobile Number",
                 ],
             ],
 
             "password" => [
                 "rules" => "required|min_length[8]",
                 "errors" => [
                     "required" => "Password Empty",
                     "min_length[8]" => "Provide Password Correctly",
                 ],
             ],
 
         ];
 
 
         //check 
         if (!$this->validate($validate)) {
           
             return $this->setResponse(0,true,$this->validator->getErrors());
         }
 

 
         //check email,password,status & role
 
         $model = new UserModel();
 
         $mobile = $this->request->getVar('mobile');
         $password = $this->request->getVar('password');
 
         $row = $model->where('mobile', $mobile)->first();
         // dd($row);
 
         if ($row) {
             //valid email which exist in database
             //now check password
 
             if ($row->password == md5($password)) {
                 //Now check account is active or not
                 if ($row->status == "1") {
                   
                    $iat=time();
                    $exp=$iat+86400;
                    $userinfo=$row;
                    $payload=[
                      'iat'=>$iat,
                      'exp'=>$exp,
                      'user_inof'=>$userinfo,
                    ];
                    $token=JWT::encode($payload,getenv('API_KEY'),'HS256');
                   if($row->role=="1")
                   {
                    return $this->setResponse('emp',false,$token);
                   }
                    
                   return $this->setResponse('admin',false,$token);
                    
                 } else {
                     return $this->setResponse(0,true,"Inactive Account Please Contact With Administration");
                 }
             } else {
                return $this->setResponse(0,true,"Invalid Mobile Or Password");
             }
         } else {
 
            return $this->setResponse(0,true,"Invalid Mobile number no users found");
         }
     }


     private function setResponse($code,$error,$payload){
        $res = [
            'code'=>$code, //1 means validate problem
            "errors" => $error,
            "payload" => $payload,
        ];

        $this->response->setStatusCode(200);
        $this->response->setContentType('application/json');
        return $this->response->setJSON($res);
     }
}
