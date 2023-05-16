<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

use App\Models\ServicesModel;

use Exception;

class Services extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

     private $serviceModel;
    public function __construct()
    {
        $this->serviceModel=new ServicesModel();
    }
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

        $totalRecord=count($this->serviceModel->orderBy('id','desc')->findAll());
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
        $serviceList=$this->serviceModel->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "services"=>$serviceList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
        ];
        return $this->setResponse('1',false,$payload);
    }

    //show only active 
    public function activeService()
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

        $totalRecord=count($this->serviceModel->where('status','1')->orderBy('id','desc')->findAll());
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
        $serviceList=$this->serviceModel->where('status','1')->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "services"=>$serviceList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
        ];
        return $this->setResponse('1',false,$payload);
    }

    //Meeting Selected Services
    public function meetingService()
    {

    }

    //inactive services
    public function deactiveService()
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

        $totalRecord=count($this->serviceModel->where('status','0')->orderBy('id','desc')->findAll());
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
        $serviceList=$this->serviceModel->where('status','0')->orderBy('id','desc')->findAll($limit,$offset);
        $payload=[
            "services"=>$serviceList,
            "totalPage"=>ceil($totalRecord/$limit),
            "currentPage"=>$page,
        ];
        return $this->setResponse('1',false,$payload);
    }
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data=$this->serviceModel->find($id);
        if($data==null)
        {
            return $this->setResponse('0',true,'No Services Record found');
        }
        return $this->setResponse('1',false,$data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //validation
        $validiation=[
            'service_name'=>"required",
        ];
        if(!$this->validate($validiation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }
        $data=$this->serviceModel->find($id);
        if($data==null)
        {
            return $this->setResponse('0',true,'No Services Record found');
        }
        $data->fill((array)$this->request->getVar());
        if(!$data->hasChanged())
        {
            return $this->setResponse('0',false,'Nothing Updated!');
        }
        try{
            $this->serviceModel->save($data);
            return $this->setResponse('1',false,"Successfully Updated");
        }catch(Exception $ex){
            return $this->setResponse('0',true,$ex->getMessage());
        }
       

    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data=$this->serviceModel->find($id);
        if($data==null)
        {
            return $this->setResponse('0',true,'No Services Record found');
        }

        try{
            $this->serviceModel->delete($id);
            return $this->setResponse('1',false,'Successfully Deleted Service Or Product Item!');
        }catch(Exception $ex)
        {
            return $this->setResponse('0',true,$ex->getMessage());
        }
    }

    //For Searching Data
    public function searchRecord()
    {
        $validiation=[
            "search"=>"required"
        ];
        if(!$this->validate($validiation))
        {
            return $this->setResponse('0',true,$this->validator->getErrors());
        }

        $search=$this->request->getVar('search');
        $data=$this->serviceModel->orderBy('id','desc')->like('service_name',$search,'both')->findAll(10);
        if($data==null)
        {
            return $this->setResponse('0',true,"No record found!");
        }
        $payload=[
            "services"=>$data,
            "total"=>count($data)
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
