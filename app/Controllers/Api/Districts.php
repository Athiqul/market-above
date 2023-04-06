<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Districts extends ResourceController
{
    private $dis;
    public function __construct()
    {
       $this->dis=new \App\Models\Districts();
    }
  
    //all districts
    public function index()
    {
        
        $data=$this->dis->findAll();
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
     //division wise districts
     public function disUnderDiv($div_id=null)
     {
         
         $data=$this->dis->where('div_id',$div_id)->findAll();
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
}
