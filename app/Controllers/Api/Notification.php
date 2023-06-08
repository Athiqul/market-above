<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

use App\Models\AssignTaskModel;
use Exception;

class Notification extends ResourceController
{
     //admin Notification
     //User Notification
     public function userNotify($id)
     {
         $taskModel=new AssignTaskModel();
         $noti=$taskModel->where('noti','0')->where('to_id',$id)->where('end_date>',date('Y-m-d'))->where('complete','0')->orderBy('id','desc')->findAll();
         if($noti==null)
         {
            return $this->setResponse('0',true,'No new Nofications');
         }

         return $this->setResponse('1',false,$noti);
         
     }
     //Make Notify Seen
     public function markasRead($id)
     {
        $taskModel=new AssignTaskModel();
        try{
            $taskModel->where('id',$id)->where('noti','0')->update($id,[
                'noti'=>'1',
            ]);
            return $this->setResponse('1',false,'Mark as Read');
        }catch(Exception $e){
            return $this->setResponse('0',true,$e->getMessage());
        }
     }

     //Sent Message
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
