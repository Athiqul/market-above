<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\Contacts;

class Contact extends ResourceController
{
    private $contactModel;
    public function __construct()
    {
        $this->contactModel=new Contacts();
        
    }


    //Contact List
    public function index()
    {
        $limit=10;
        $page=1;
        if($this->request->getVar('limit'))
        {
            $limit=$this->request->getVar('limit');
        }

        if($this->request->getVar('page'))
        {
            $page=$this->request->getVar('page');
        }

        $totalRecord=count($this->contactModel->orderBy('id','desc')->findAll());
        if($totalRecord==0)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $totalPage=ceil($totalRecord/$limit);
        if($totalPage<$page)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $offset=($page-1)*$limit;
        $contactList=$this->contactModel->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "contact"=>$contactList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
            "totalRecord"=>$totalRecord,
        ];
        return $this->setResponse('1',false,$payload);
    }

   
    public function show($id = null)
    {
        $data=$this->contactModel->find($id);
        if($data==null)
        {
            return $this->setResponse('0',true,'No Emergency Contact Record found');
        }
        return $this->setResponse('1',false,$data);
    }

    //Create contact
    public function create()
    {
        //validation
        $validation=[
            "name"=>[
                "rules"=>"required|min_length[3]|max_length[255]",
                "errors"=>[
                    "required"=>"Name field is required !",
                    "min_length"=>"Name should be at least 3 characters or more",
                    "max_length"=>"Name is too long!",
                ]
            ],
            "designation"=>[

                "rules"=>"required|min_length[3]|max_length[255]",
                "errors"=>[
                    "required"=>"Designation field is required !",
                    "min_length"=>"Designation should be at least 3 characters or more",
                    "max_length"=>"Designation is too long!",
                ]
            ],
            "contact"=>[
                "rules"=>"required|regex_match[017+[0-9]{8}|018+[0-9]{8}|013+[0-9]{8}|014+[0-9]{8}|019+[0-9]{8}|015+[0-9]{8}|016+[0-9]{8}]|is_unique[contacts.contact]",
                "errors"=>[
                    "required"=>"Contact Number is required!",
                    "regex_match"=>"Please provide Bangladeshi 11 Digits Mobile number",
                    "is_unique"=>"This number belongs to enother contact!",
                ]
            ],
        ];

        if(!$this->validate($validation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }

        //Store data 
        $data=$this->request->getVar();
        try{
             $this->contactModel->save($data);
            return $this->setResponse('1',false,'Successfully '.$this->request->getVar('name'). ' added in Emergency Contact List!');
        }catch(Exception $ex){
                  return $this->setResponse('0',true,$ex->getMessage());
        }

    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $validiation=[
            "name"=>[
                "rules"=>"required|min_length[3]|max_length[255]",
                "errors"=>[
                    "required"=>"Name field is required !",
                    "min_length"=>"Name should be at least 3 characters or more",
                    "max_length"=>"Name is too long!",
                ]
            ],
            "designation"=>[

                "rules"=>"required|min_length[3]|max_length[255]",
                "errors"=>[
                    "required"=>"Designation field is required !",
                    "min_length"=>"Designation should be at least 3 characters or more",
                    "max_length"=>"Designation is too long!",
                ]
            ],
            "contact"=>[
                "rules"=>"required|regex_match[017+[0-9]{8}|018+[0-9]{8}|013+[0-9]{8}|014+[0-9]{8}|019+[0-9]{8}|015+[0-9]{8}|016+[0-9]{8}]",
                "errors"=>[
                    "required"=>"Contact Number is required!",
                    "regex_match"=>"Please provide Bangladeshi 11 Digits Mobile number",
                    
                ]
            ],
        ];
        if(!$this->validate($validiation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }

        $data=$this->contactModel->find($id);
        if($data==null)
        {
            return $this->setResponse('0',true,'No Services Record found');
        }

        if($data->contact!=$this->request->getVar('contact')&& $this->contactModel->where('contact',$this->request->getVar('contact'))->first())
        {
            return $this->setResponse('0',true,'The contact number already exist with another emergency contact');
        }
        $data->fill((array)$this->request->getVar());
        if(!$data->hasChanged())
        {
            return $this->setResponse('0',false,'Nothing Updated!');
        }
        try{
            $this->contactModel->save($data);
            return $this->setResponse('1',false,"Successfully Updated");
        }catch(Exception $ex){
            return $this->setResponse('0',true,$ex->getMessage());
        }
    }

   
    public function delete($id = null)
    {
        $item=$this->contactModel->find($id);
        if($item==null)
        {
            return $this->setResponse('0',true,'Request Denied invalid data');
        }
        $this->contactModel->delete($id);
        return $this->setResponse('1',false,$item->name.' is successfully deleted from the emergency contact list!');
    }
//search
    public function search()
    {
        $validiation=[
           "search"=>[
            "rules"=>"required",
             "errors"=>[
                "required"=>"No Search keyword"
             ]
           ]
        ];
        if(!$this->validate($validiation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }

        $search=$this->request->getVar('search');
        //dd($search);
        $data=$this->contactModel->orderBy('id','desc')->like('name',$search,'both')->findAll(10);
        if($data==null)
        {
            return $this->setResponse('0',true,"No record found!");
        }
        $payload=[
            "contact"=>$data,
            "total"=>count($data)
        ];
        return $this->setResponse('1',false,$payload);
    }
   

    //Active Contact

    public function active()
    {
        $limit=20;
        $page=1;
        if($this->request->getVar('limit'))
        {
            $limit=$this->request->getVar('limit');
        }

        if($this->request->getVar('page'))
        {
            $page=$this->request->getVar('page');
        }

        $totalRecord=count($this->contactModel->where('status','1')->orderBy('id','desc')->findAll());
        if($totalRecord==0)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $totalPage=ceil($totalRecord/$limit);
        if($totalPage<$page)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $offset=($page-1)*$limit;
        $contactList=$this->contactModel->where('status','1')->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "contact"=>$contactList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
        ];
        return $this->setResponse('1',false,$payload);
    }

    //inactive contact
    public function inActive()
    {
        $limit=20;
        $page=1;
        if($this->request->getVar('limit'))
        {
            $limit=$this->request->getVar('limit');
        }

        if($this->request->getVar('page'))
        {
            $page=$this->request->getVar('page');
        }

        $totalRecord=count($this->contactModel->where('status','0')->orderBy('id','desc')->findAll());
        if($totalRecord==0)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $totalPage=ceil($totalRecord/$limit);
        if($totalPage<$page)
        {
            return $this->setResponse('0',true,'No record found');
        }

        $offset=($page-1)*$limit;
        $contactList=$this->contactModel->where('status','0')->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "contact"=>$contactList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
        ];
        return $this->setResponse('1',false,$payload);
    }

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
