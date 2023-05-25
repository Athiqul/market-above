<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\UserInfo;
use Exception;
use function PHPUnit\Framework\fileExists;

class Team extends BaseController
{

    private $authModel,$infoModel;
    public function __construct()
    {
        $this->authModel=new UserModel();
        $this->infoModel=new UserInfo();
    }
    //All team member  list
    public function index()
    {
        $list=$this->authModel->paginate(10);
        $pager=$this->authModel->pager;
        return view('team/index',compact('list','pager'));
    }

    //Create team member
    public function create()
    {
         return view('team/create');
    }
    //Store team member data
    public function store()
    {
         //validation
         $validation=[
            "mobile" => [
                "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}||[0-9]{8}$/]|is_unique[user_access.mobile]",
                "errors" => [
                    "required" => "Mobile Number missing",
                    "regex_match" => "Provide an valid contact Number for telephone It should be 8 digits and mobile it should 11 digits (remove ++880)",
                    "is_unique" => "This mobile number already in the system"
                ],
            ],
            "email" => [
                "rules" => "required|valid_email|is_unique[user_access.email]",
                "errors" => [
                    "valid_email" => "Provide an valid email address",
                    "is_unique" => "This email already in the system"
                ],
            ],
            "employ_id" => [
                "rules" => "required|is_unique[user_access.employ_id]",
                "errors" => [
                    "is_unique" => "This email already in the system",
                    "required"=>"Please Provide employ Id",
                ],
            ],

            "name" => [
                "rules" => "required",
                "errors" => [
                    
                    "required"=>"Please Provide name of this new user",
                ],
            ],

            "password" => [
                "rules" => "required|min_length[6]|matches[confirm_password]",
                "errors" => [
                    
                    "required"=>"Please Provide password of this new user",
                    "min_length"=>"Password Should be at least 6 characters"
                ],
            ],
            "confirm_password" => [
                "rules" => "required|min_length[6]",
                "errors" => [
                    
                    "required"=>"Please Provide password of this new user",
                    "min_length"=>"Password Should be at least 6 characters"
                ],
            ],


         ];

         if(!$this->validate($validation))
         {
            return redirect()->back()->withInput()->with('warning', $this->validator->getErrors());
         }
         //Store
         try{
            $data=[
                "employ_id"=>esc($this->request->getVar('employ_id')),
                "name"=>esc($this->request->getVar('name')),
                "mobile"=>$this->request->getVar('mobile'),
                "email"=>$this->request->getVar('email'),
                "password"=>md5(esc($this->request->getVar('password'))),
            ];
          $this->authModel->save($data);
            
                return redirect()->to('/team-management/user-info/'.$this->authModel->getInsertID())->with('success','User Account Created Successfully');
            
          
         }catch(Exception $ex){
              return redirect()->back()->with('warning',$ex->getMessage());
         }
         //notification
    }

    //update team member info
    public function update()
    {

    }

    //Status Update
    public function status($id)
    {
       $checkUser= $this->authModel->find($id);
       if($checkUser==null)
       {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
       } 

       $checkUser->status=='1'?$checkUser->status='0':$checkUser->status=1;
       try{
        $this->authModel->save($checkUser);
        return redirect()->back()->with('success','Status Updated');
       }catch(Exception $ex){
         return redirect()->back()->with('warning',$ex->getMessage());
       }
      
    }

    //show profile
    public function userProfile($id)
    {

       // dd($id);
        $basicInfo=$this->authModel->find($id);
        if($basicInfo==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $profileInfo=$this->infoModel->where('user_id',$id)->first();
        $data=[
           'basic'=>$basicInfo,
           'info'=>$profileInfo,
        ];


        return view('team/user_profile',compact('data'));
    }

    //Team info update
     //store upload image file
     public function imageUpdate($id)
     {
        // dd($id);
        $basicInfo=$this->authModel->find($id);
        if($basicInfo==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('team/image-update',['user'=>$basicInfo]);
        
     }

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
            $userImage=$this->infoModel->where('user_id',$id)->first();
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
                    if($this->infoModel->save($data))
                    {
                        
                        return redirect()->to('/team-management/user-info/'.$id)->with('success','Profile Picture Uploaded Successfully!');
                    }else{
                        return redirect()->back()->with('warning',$this->infoModel->errors());
                    }
                }catch(Exception $ex){
                    return redirect()->back()->with('warning',$this->infoModel->errors());
                }
                
            }
            
            //For assign info profile
           $userImage->image_link=$image_link;

           
           try{
            if($this->infoModel->save($userImage))
            {
                
                    session()->get('user')['user_info']->image_link=$image_link;
                

              
                return redirect()->to('/team-management/user-info/'.$id)->with('success','Profile Picture Updated Successfully!');
            }else{
                return redirect()->back()->with('warning',$this->infoModel->errors());
            }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$this->infoModel->errors());
        }
          

        } 
    
}

    //Resume upload
    public function profileResume($user_id)
    {
        $basicInfo=$this->authModel->find($user_id);
        if($basicInfo==null)
        {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('team/resume-upload',['user'=>$basicInfo]);
    }


    public function storeResume($user_id)
    {
        $id=$user_id;

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
            $userData=$this->infoModel->where('user_id',$id)->first();
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
                    if($this->infoModel->save($data))
                    {
                        return redirect()->to('/team-management/user-info/'.$user_id)->with('success','Resume Uploaded Successfully!');
                    }else{
                        return redirect()->back()->with('warning',$this->infoModel->errors());
                    }
                }catch(Exception $ex){
                    return redirect()->back()->with('warning',$this->infoModel->errors());
                }
                
            }
            
            //For assign info profile
           $userData->resume_link=$resume_link;

           
           try{
            if($this->infoModel->save($userData))
            {
                return redirect()->to('/team-management/user-info/'.$user_id)->with('success','Resume Updated Successfully!');
            }else{
                return redirect()->back()->with('warning',$this->infoModel->errors());
            }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$this->infoModel->errors());
        }
          

        } 
    }
}
