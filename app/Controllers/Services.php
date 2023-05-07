<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use Exception;

class Services extends BaseController
{
   private $serviceModel;

    public function __construct()
    {
        $this->serviceModel=new ServicesModel();
    }

    //All Services/ Product List
    public function index()
    {
        
        return view('services/index');
    }

    //Create Service
    public function create()
    {
       // dd($this->request->getVar());
      $validation=[

        'service_name'=>[
            "rules"=>"required|max_length[255]"
        ]
      ];

      if(!$this->validate($validation))
      {
        return redirect()->back()->withInput()->with('warning',$this->validator->getErrors());
      }

    $data=$this->request->getVar();
    try{
       if($this->serviceModel->insert($data))
       {
          return redirect()->back()->with('success','Service Added');          
       }
       else{
        return redirect()->back()->with('warning',$this->serviceModel->errors())->withInput();
       }   
    }catch(Exception $ex)
    {
        return redirect()->back()->with('warning',$ex->getMessage())->withInput();
    }

    }
    //Status Change Service
    //update Service
    //Delete service

}
