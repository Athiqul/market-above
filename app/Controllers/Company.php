<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Customer;
use App\Entities\Customers;
use Exception;

class Company extends BaseController
{
    private $customerModel;
    public function __construct()
    {
        $this->customerModel= new Customer();
    }

    //Company List
    public function index()
    {
          $companyList=$this->customerModel->orderBy('id','desc')->findAll();

          return view('company/company-list',compact('companyList'));
    }
    public function create()
    {
        
        return view ('company/add-company');
    }

    public function store()
    {
        //dd($this->request->getvar());
      //validation part
      $validate = [

        "company_name" => [
            "rules" => "required",
            "errors" => [
                "required" => "Company Name Missing",              
            ],
        ],
        "user_id" => [
            "rules" => "required|is_not_unique[user_access.id]",
            "errors" => [
                "required" => "Unauthorized",
                "is_not_unique"=>'You are not Authorized'              
            ],
        ],
        "address" => [
            "rules" => "required",
            "errors" => [
                "required" => "Please Provide Address",   
            ],
        ],
        "division" => [
            "rules" => "required",
            "errors" => [
                "required" => "Please Provide division",   
            ],
        ],
        "district" => [
            "rules" => "required",
            "errors" => [
                "required" => "Please Provide district",   
            ],
        ],
        "thana" => [
            "rules" => "required",
            "errors" => [
                "required" => "Please Provide thana",   
            ],
        ],

        "address" => [
            "rules" => "required",
            "errors" => [
                "required" => "Please Provide area",   
            ],
        ],
        "mobile" => [
            "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}||[0-9]{8}$/]|is_unique[customers.mobile]",
            "errors" => [
                "required" => "Mobile Number missing",
                "regex_match" => "Provide an valid contact Number for telephone It should be 8 digits and mobile it should 11 digits (remove ++880)",
                "is_unique"=>"This mobile number already in the system"
            ],
        ],
        "email" => [
            "rules" => "valid_email|is_unique[customers.email]",
            "errors" => [
                "valid_email" => "Provide an valid email address",
                "is_unique"=>"This email already in the system"
            ],
        ],
      

       
    ];


    //check 
    if (!$this->validate($validate)) {


        //dd($this->validator->getErrors());
      
        return redirect()->back()->withInput()->with('warning',$this->validator->getErrors());
    }


    try{
         $data=$this->request->getVar();
         if($this->customerModel->save($data))
         {
            return redirect()->to('/')->with('success','Operation Success! Company Added');

         }
         return redirect()->back()->with('warning',$this->customerModel->errors())->withInput();
    }catch(Exception $err){
         return redirect()->back()->with('warning',$err->getMessage())->withInput();
    }


   }

   //Company Details Information
   public function companyInfo($id)
   {
    $info=$this->customerModel->find($id);
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }
      return view('company/company_details',compact('info'));
   }

   //edit company information

   public function editCompany($id)
   {
    $info=$this->customerModel->find($id);
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }
      return view('company/edit_company',compact('info'));
   }
   //Update Company Information
   public function updateCompany($id)
   {
    $info=$this->customerModel->find($id);
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }

    $userInput=$this->request->getVar();
    $info->fill($userInput);
    if(!$info->hasChanged())
    {
        return redirect()->back()->with('warning','Nothing to Update');
    }

    try{
        $this->customerModel->save($info);
        return redirect()->to('/company/details/'.$id)->with('success','Information Updated');
    }catch(Exception $ex){
        return redirect()->back()->with('warning',$ex->getMessage());
    }
     
   }
}
