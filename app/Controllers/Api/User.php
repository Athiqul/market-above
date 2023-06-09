<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\UserInfo;
use App\Models\UserModel;




class User extends ResourceController
{
    //user information model
    private $userInfoModel,$authenModel;

    // initialize model via construction
    public function __construct()
    {
        $this->userInfoModel=new UserInfo();
        $this->authenModel=new UserModel();
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


    //user search by
    public function search()
    {
        $limit=$this->request->getVar('limit')??10;
        $page=$this->request->getVar('page')??1;
        $search=esc($this->request->getVar('search'));
       // dd($search);
        if(strlen($search)<3)
        {
            return $this->setResponse('0',true,"Please write more");
        }
        $builder=$this->authenModel;
        $builder->select('user_access.name,user_access.id');
       
        $builder->like('user_access.name',$search,'both');
        $builder->orLike('user_access.employ_id',$search,'both');
        $builder->orLike('user_access.mobile',$search,'both');
        $builder->orLike('user_access.email',$search,'both');
        $builder->where('user_access.status','1');
        $builder->orderBy('user_access.id','desc');
        $builder->limit($limit);
        $chunk=$builder->get()->getResult();
//         echo ($builder->getLastQuery()); // Print the last executed SQL query
// echo "<pre>";
// print_r($builder->getError()); // Print any database errors
// echo "</pre>";
        if($chunk==null)
        {
            return $this->setResponse('0',true,"No record found");
        }
       return $this->setResponse('1',false,$chunk);

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
                    //for task activity record
                    try {
                        $activityModel = new \App\Models\EmployActivityModel();
                        $data = [
                            "user_id" => $this->request->getVar('user_id'),
                            "type" => "6",
                        ];
                        $activityModel->save($data);
                    } catch (Exception $e) {
                    }
                    return $this->setResponse('1', false, "User Information Recorded Successfully");
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

                     //for task activity record
                     try {
                        $activityModel = new \App\Models\EmployActivityModel();
                        $data = [
                            "user_id" => $this->request->getVar('user_id'),
                            "type" => "6",
                        ];
                        $activityModel->save($data);
                    } catch (Exception $e) {
                    }
    
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
