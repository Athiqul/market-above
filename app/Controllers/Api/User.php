<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\UserInfo;
use App\Models\UserModel;



class User extends ResourceController
{
   
    public function updateInfo()
    {
        $id=session()->get('user')['id'];
        $profile=new UserInfo();
        $profileInfo=$profile->where('user_id',$id)->first();
        if($profileInfo==null)
        {
            $data=$this->request->getVar();
            try{
                $profile->save($data);

                return $this->setResponse('1',false,"User Information Recorded Successfully");
                
            }catch(Exception $ex){
                    return $this->setResponse('0',true,$ex->getMessage());
            }
        } else{
            $userInput=$this->request->getPost();
            $profileInfo->fill($userInput);
             if($profileInfo->hasChanged())
             {
                return $this->setResponse('1',false,"Nothing Updated");
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
