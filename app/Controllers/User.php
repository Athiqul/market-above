<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserInfo;

class User extends BaseController
{
    private $userModel;
    private $userInfoModel;
    public function __construct()
    {
        $this->userModel=new UserModel();
        $this->userInfoModel=new UserInfo();
    }
    //all user profile for admin
    public function index()
    {
        //
    }
    //invidual profile for show admin
    // user information update by admin
    //user profile show for login user 
    public function myProfile()
    {
         $id=session()->get('user')['id'];
         //check exist or not 
          //get user authen info 
         // get user profile info
         $basicInfo=$this->userModel->find($id);
         $profileInfo=$this->userInfoModel->where('user_id',$id)->first();
         $data=[
            'basic'=>$basicInfo,
            'info'=>$profileInfo,
         ];
        

         dd($data);
         return view('profile/my-profile');  


    }
}
