<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MeetingReportModel;
use App\Models\ServicesModel;
use App\Models\InterestServicesModel;
use App\Models\Customer;

class Meeting extends ResourceController
{
    private $meeting,$services,$company,$interest;
    public function __construct()
    {
        $this->meeting=new MeetingReportModel();
        $this->services=new ServicesModel();
        $this->company=new Customer();
        $this->interest=new InterestServicesModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    //Get All Meeting Data
    public function index()
    {
        $limit=$this->request->getVar('limit')??10;
        $page=$this->request->getVar('page')??1;
        $totalRecord=count($this->meeting->findAll());
        if($totalRecord<1)
        {
            return $this->setResponse('0',true,'No meeting report found');
        }
        $totalPage=ceil($totalRecord/$limit);
        $offset=($page-1)*$limit;
        $builder=$this->meeting;
        $builder->select('meeting_report.id as reportId,meeting_report.contact_person, meeting_report.desg, meeting_report.mobile, meeting_report.created_at,customers.company_name,customers.id as company_id,user_access.id as userId, user_access.name as username');
        $builder->join('customers','meeting_report.company_id=customers.id');
        $builder->join('user_access','meeting_report.user_id=user_access.id');
        $builder->orderBy('meeting_report.id','desc');
        $builder->limit($limit,$offset);
        $chunk=$builder->get()->getResult();
        if($chunk==null)
        {
            return $this->setResponse('0',true,'No meeting report found');
        }
        $payload=[
            "records"=>$chunk,
            "totalPage"=>$totalPage,
            "totalRecord"=>$totalRecord,
            "currentPage"=>$page
        ];
        return $this->setResponse('1',false,$payload);

    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */

    //Show Search Data
    public function search()
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
