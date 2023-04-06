<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Thana extends ResourceController
{
    private $thana;
    public function __construct()
    {
       $this->thana=new \App\Models\Thana();
    }
  
   
     //division wise districts
     public function thanaUnderDis($dis_id=null)
     {
         
         $data=$this->thana->where('dis_id',$dis_id)->findAll();
         $status=true;
         if($data==null)
         {
           $data="No record found";
           $status=false;
         }
         $payload=[
            "success"=>$status, 
            "msg"=>$data,
         ];
         $this->response->setContentType('application/json');
         $this->response->setStatusCode(200);
         return $this->response->setJSON($payload);
   
     }

     public function createThana(){
        //validation
        $validate=[
         "dis_id"=>[
            'rules'=>'required|is_not_unique[districts.dis_id]',
            'errors'=>[
               'required'=>'No district provided',
               'is_not_unique'=>'Valid district needed'
            ],
         ],
         'en_name'=>[
            "rules"=>"required|alpha_space"
         ],
         'bn_name'=>[
           "rules"=>"required|regex_match[/\p{Bengali}/u]"
         ]
        ];


        if(!$this->validate($validate))
        {

         $payload=[
            "success"=>false, 
            "msg"=>$this->validator->getErrors(),
         ];

         $this->response->setContentType('application/json');
         $this->response->setStatusCode(200);
         return $this->response->setJSON($payload);
        }

        if($this->thana->insert($this->request->getVar())){
         $payload=[
            "success"=>true, 
            "msg"=>"Data inserted",
         ];

         $this->response->setContentType('application/json');
         $this->response->setStatusCode(200);
         return $this->response->setJSON($payload);
        } else{
         $payload=[
            "success"=>false, 
            "msg"=>$this->thana->errors(),
         ];

         $this->response->setContentType('application/json');
         $this->response->setStatusCode(200);
         return $this->response->setJSON($payload);
        }
     }
}
