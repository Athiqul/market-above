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
            "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}$/]|is_unique[customers.mobile]",
            "errors" => [
                "required" => "Mobile Number missing",
                "regex_match" => "Provide an valid Mobile Number",
                "is_unique"=>"This mobile number already in the sy"
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
}
