<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

use App\Models\AssignTaskModel;
use App\Models\EmployActivityModel;
use App\Models\UserModel;

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


    //Admin Notification Latest 20 user activity
    public function userActivityNotice()
    {
        $activityModel = new EmployActivityModel();
        $userModel= new UserModel();
        $userInfo=$userModel->findAll();
        $adminIds=[];
        foreach($userInfo as $item)
        {
         if($item->role=='0')
         {
            $adminIds[]=$item->id;
         }
        }
        //dd($adminIds);
        //$adminId = session()->get('user')['id'];
        $notice = $activityModel->whereNotIn('user_id',$adminIds)->orderBy('id', 'desc')->findAll(20);
        if ($notice == null) {
            return $this->setResponse('0', true, 'No new Notification!');
        }
        $type = [
            "Logged In",
            "Added Company Info",
            "Added Meeting Record",
            "Assign Task Updated",
            "Password Changed",
            "Image Updated",
            "Profile Information Updated"
        ];
        $message = [
            "User Has been successfully logged in",
            "Company information added or updated to view please click on it",
            "Meeting information added or updated to view please click on it",
            "Task may be compeleted or keep it in pending again please click on it to view",
            "Successfully changed password user can login with new password",
            "Image updated successfully It appears on user avatars",
            "User Profile information has been successfully updated",
        ];

        $payload=[];
        foreach($notice as $item)
        {
            $payload[]=[
                "title"=>$type[$item->type],
                "message"=>$message[$item->type],
                "userName"=>$userModel->userName($item->user_id),
                'activity'=>$item,
            ];
        }

        return $this->setResponse('0',false,$payload);
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
