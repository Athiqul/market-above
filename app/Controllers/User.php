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
                            $userInfo=[
                                "user_info"=>(object)[
                                    "image_link"=>$image_link,
                                ],
                            ];
                            
                            session()->push('user',$userInfo);
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
                    
                        session()->get('user')['user_info']->image_link=$image_link;
                    

                  
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

    //password change render view
    public function passwordChange()
    {
        return view('profile/password-change');
    }

    //password validation and store
    public function storePassword()
    {
        //validation
        $validation=[
            "old_pass"=>[
                "rules"=>"required"
            ],
            "new_pass"=>[
                "rules"=>'required|min_length[8]',
                "errors"=>[
                    "min_length"=>"Password Should Be Minimum 8 Characters"
                ]
                ],
            "con_pass"=>[
                "rules"=>'required|min_length[8]|matches[new_pass]',
                "errors"=>[
                    "min_length"=>"Password Should Be Minimum 8 Characters",
                    "matches"=>"Confirm password should match with new password field"
                ]
            ]    
        ];
        if(!$this->validate($validation))
        {
            return redirect()->back()->with('warning',$this->validator->getErrors());
        }
        $user_id=session()->get('user')['id'];
        $userData=$this->userModel->find($user_id);
        if($userData==null)
        {
            return redirect()->to('logout');
        }
        $oldPass=$this->request->getVar('old_pass');
        if(md5($oldPass)!==$userData->password)
        {
          return redirect()->back()->with('warning','Your Current password is wrong');
        } 

        $userData->password=md5($this->request->getVar('new_pass'));
        try{

            if($this->userModel->save($userData))
       {
          return redirect()->to('logout')->with('success','Your password Updated Please Log in first');
       }else{
        return redirect()->back()->with('warning',$this->userModel->errors());
       }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$ex->getMessage());
        }
      

    }

    //Resume upload
    public function profileResume()
    {
        return view('profile/resume-upload');
    }
    public function storeResume()
    {
        $id=session()->get('user')['id'];

        $file=$this->request->getFile('resume_link');
        
        if($file->isValid()==true)
        {
            //Image validation
            $getSize=$file->getSizeByUnit('mb');
            if($getSize>=1)
            {
                return redirect()->back()
                ->with('warning','Resume is too large Its bigger than 1 mega byte');
            }
            $getMime=$file->getMimeType();
            $allowedTypes=['application/pdf'];
            if(!in_array($getMime,$allowedTypes))
            {
                  return redirect()->back()
                  ->with('warning','Resume Format Invalid only PDF will Accept');
            }

            //work with exist resume
            $userData=$this->userInfoModel->where('user_id',$id)->first();
            if($userData!=null && $userData->resumi_link!=null)
            {
                //previous image find out
               
            
              $path=WRITEPATH.'uploads/employ-resume/'.$userData->resume_link;
              if(fileExists($path)==true)
              {
               try{unlink($path);}catch(Exception $ex){
                return redirect()->back()
                ->with('warning',$ex->getMessage());
               }
              }
            } 

            //save image
            $resume_link=uniqid().$file->getName();
            $path="uploads/employ-resume/";
             if (!$file->move(WRITEPATH.$path,$resume_link))
             {
                 return redirect()->back()->with('warning','Resume upload failed');  
             }

            //if userinfo not assign yet
            if($userData==null)
            {
                $data=[
                    "user_id"=>$id,
                    "resume_link"=>$resume_link,
                ];
                try{
                    if($this->userInfoModel->save($data))
                    {
                        return redirect()->to('/user/my-profile')->with('success','Resume Uploaded Successfully!');
                    }else{
                        return redirect()->back()->with('warning',$this->userInfoModel->errors());
                    }
                }catch(Exception $ex){
                    return redirect()->back()->with('warning',$this->userInfoModel->errors());
                }
                
            }
            
            //For assign info profile
           $userData->resume_link=$resume_link;

           
           try{
            if($this->userInfoModel->save($userData))
            {
                return redirect()->to('/user/my-profile')->with('success','Resume Updated Successfully!');
            }else{
                return redirect()->back()->with('warning',$this->userInfoModel->errors());
            }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$this->userInfoModel->errors());
        }
          

        } 
    }

    // View pdf file 

    public function showResume($fileName)
    {
       $path=WRITEPATH.'uploads/employ-resume/'.$fileName;
       
      // dd(file_exists($path));
       
       if (file_exists($path)) {
        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->response->setHeader('Content-Disposition', 'inline; filename="'.$fileName.'"');
        $this->response->setHeader('Cache-Control', 'public, max-age=0, must-revalidate');
        $this->response->setBody(file_get_contents($path));
        return $this->response->send();
    } else {
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
    }
}
