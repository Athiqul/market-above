<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

use App\Models\ServicesModel;

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

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
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
