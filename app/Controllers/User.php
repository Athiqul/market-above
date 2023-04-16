<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserInfo;
use Exception;
use function PHPUnit\Framework\fileExists;
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
        

        // dd($data);
         return view('profile/my-profile',['data'=>$data]);  


    }
   //render upload image page
    public function profileImage($id)
    {
           //get existing image
           $getImage=$this->userInfoModel->where('user_id',$id)->first();
           return view('profile/image-update',['image'=>$getImage,'user_id'=>$id]);
    }

    //store upload image file
    public function storeImage($id){
        
            $file=$this->request->getFile('image');
            if($file->isValid()==true)
            {
                //Image validation
                $getSize=$file->getSizeByUnit('mb');
                if($getSize>=1)
                {
                    return redirect()->back()
                    ->with('warning','Image is too large Its bigger than 1 mega byte');
                }
                $getMime=$file->getMimeType();
                $allowedTypes=['image/png','image/jpeg'];
                if(!in_array($getMime,$allowedTypes))
                {
                      return redirect()->back()
                      ->with('warning','Image Format Invalid only PNG and JPEG will Accept');
                }

                //work with exist image
                $userImage=$this->userInfoModel->where('user_id',$id)->first();
                if($userImage!=null && $userImage->image_link!=null)
                {
                    //previous image find out
                   
                
                  $path=WRITEPATH.'uploads/profile-image/'.$userImage->image_link;
                  if(fileExists($path)==true)
                  {
                   try{unlink($path);}catch(Exception $ex){
                    return redirect()->back()
                    ->with('warning',$ex->getMessage());
                   }
                  }
                } 

                //save image
                $image_link=uniqid().$file->getName();
                $path=$file->store('profile-image',$image_link);
                $path=WRITEPATH.'uploads/'.$path;
                service('image')->withFile($path)
                ->fit(400,300,'center')
                ->save($path);

                //if userinfo not assign yet
                if($userImage==null)
                {
                    $data=[
                        "user_id"=>$id,
                        "image_link"=>$image_link,
                    ];
                    try{
                        if($this->userInfoModel->save($data))
                        {
                            return redirect()->to('/user/my-profile')->with('success','Profile Picture Uploaded Successfully!');
                        }else{
                            return redirect()->back()->with('warning',$this->userInfoModel->errors());
                        }
                    }catch(Exception $ex){
                        return redirect()->back()->with('warning',$this->userInfoModel->errors());
                    }
                    
                }
                
                //For assign info profile
               $userImage->image_link=$image_link;

               
               try{
                if($this->userInfoModel->save($userImage))
                {
                    return redirect()->to('/user/my-profile')->with('success','Profile Picture Updated Successfully!');
                }else{
                    return redirect()->back()->with('warning',$this->userInfoModel->errors());
                }
            }catch(Exception $ex){
                return redirect()->back()->with('warning',$this->userInfoModel->errors());
            }
              

            } 
        
    }

    // Image show
    public function image($image_link)
    {
        
        
        if($image_link!=="")
    {
        $path= WRITEPATH.'uploads/profile-image/'.$image_link;
        $finfo=new \finfo(FILEINFO_MIME);
        $type=$finfo->file($path);
        header("Content-Type:$type");
        header('Content-Length:'.filesize($path));

        readfile($path);
        exit;
    }
    if($image_link=="")
    {
        $path= WRITEPATH.'uploads/profile-image/default.jpg';
        $finfo=new \finfo(FILEINFO_MIME);
        $type=$finfo->file($path);
        header("Content-Type:$type");
        header('Content-Length:'.filesize($path));

        readfile($path);
        exit;
    }
}
}
