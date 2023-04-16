<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\UserInfo;
use App\Models\UserModel;




class User extends ResourceController
{
    //user information model
    private $userInfoModel;

    // initialize model via construction
    public function __construct()
    {
        $this->userInfoModel=new UserInfo();
    }

    // provide identical user information
    public function profileInfo($id)
    {
          $info=$this->userInfoModel->where('user_id',$id)->first();
          if($info==null)
          {
            return $this->setResponse('0',true,'No Information found');
          }
          return $this->setResponse('1',false,$info);
    }

    //Request handle for update
    public function updateInfo($id)
    {

        $validation=[
            'nid'=>[
                'rules'=>'regex_match[^[0-9]{10,17}$]',
                'errors'=>[
                    'regex_match'=>'Provide a valid NID number'
                ]
            ],
            'user_id'=>[
                'rules'=>'required|is_not_unique[user_access.id]',
                'errors'=>[
                    'is_not_unique'=>'Unauthorized User',
                    'required'=>'Unauthorized User'
                ]
            ]
        ];

        if(!$this->validate($validation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }

        $profile=new UserInfo();
        $profileInfo=$profile->where('user_id',$id)->first();
        $data=$this->request->getVar();
        $data=(array)$data;
       
        //return $this->setResponse('0',true,var_dump($data));
        if($profileInfo==null)
        {
            
            try{
               if ($profile->save($data))
               {
                return $this->setResponse('1',false,"User Information Recorded Successfully");
               }else{
                return $this->setResponse('0',true,$profile->errors());
               }

                
                
            }catch(Exception $ex){
                    return $this->setResponse('0',true,$ex->getMessage());
            }
        } else{
           // print_r($profileInfo);
            
           // dd($data);
            $profileInfo->fill($data);
             if(!$profileInfo->hasChanged())
             {
                return $this->setResponse('0',true,"Nothing Updated");
             }
             else{

                try{
                    $profile->save($profileInfo);
    
                    return $this->setResponse('1',false,"User Information updated Successfully");
                    
                }catch(Exception $ex){
                        return $this->setResponse('0',true,$ex->getMessage());
                }

             } 
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
