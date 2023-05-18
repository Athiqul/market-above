<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Customer;
use App\Models\InterestServicesModel;
use Exception;
class Company extends ResourceController
{
  private $companyModel;
public function __construct()
{
    $this->companyModel= new Customer();
}
   public function create(){
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

        "area" => [
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
            "rules" => "required|valid_email|is_unique[customers.email]",
            "errors" => [
                "required" => "Email Missing",
                "valid_email" => "Provide an valid email address",
                "is_unique"=>"This email already in the system"
            ],
        ],
       
    ];


    //check 
    if (!$this->validate($validate)) {
      
        return $this->setResponse(0,true,$this->validator->getErrors());
    }
    $data=$this->request->getVar();
    try{
        if($this->companyModel->save($data))
        {
            return $this->setResponse(200,false,"Congratulations {$this->request->getVar('company_name')} added successfully");
        }   
    }catch(Exception $error){
            return $this->setResponse(1,true,$error->getMessage());
    }
   }


   //show all company
   public function companyList()
   {
     
      $search=$this->request->getVar('search');
      //create query builder
      $builder=$this->companyModel;
      $builder->select('id,company_name');
      $builder->orderBy('id','desc');
      $builder->like('company_name',$search,'both');
      $payload= $builder->get()->getResult();
      if($payload==null)
      {
        return $this->setResponse('0',true,'No record found');
      }
      return $this->setResponse('1',false,$payload);
   }

 
 //Show company interest services
 


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
