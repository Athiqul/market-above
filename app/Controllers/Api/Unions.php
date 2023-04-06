<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Unions extends ResourceController
{
    private $unions;
    public function __construct()
    {
       $this->unions=new \App\Models\Unions();
    }
  
   
     //division wise districts
     public function unionUnderThana($thana_id=null)
     {
         
         $data=$this->unions->where('thana_id',$thana_id)->findAll();
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

     public function createUnionWard(){
      //validation
      $validate=[
       "thana_id"=>[
          'rules'=>'required|is_not_unique[thana.thana_id]',
          'errors'=>[
             'required'=>'No Thana provided',
             'is_not_unique'=>'Valid thana needed'
          ],
       ],
       'en_name'=>[
          "rules"=>"required|alpha_numeric_space"
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

      if($this->unions->insert($this->request->getVar())){
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
          "msg"=>$this->unions->errors(),
       ];

       $this->response->setContentType('application/json');
       $this->response->setStatusCode(200);
       return $this->response->setJSON($payload);
      }
   }
}
