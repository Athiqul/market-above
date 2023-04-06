<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Divisions extends ResourceController
{
    private $div;
    public function __construct()
    {
       $this->div=new \App\Models\Divisions();
    }
  
    //all divisions
    public function index()
    {
        
        $data=$this->div->findAll();
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
