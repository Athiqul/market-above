<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\Customer;
use App\Entities\Customers;
use Exception;

class Company extends BaseController
{
    private $customerModel;
    public function __construct()
    {
        $this->customerModel= new Customer();
    }

    //Company List
    public function index()
    {
        $limit=$this->request->getVar('limit')??10;
        $page=$this->request->getVar('page')??1;
        $totalRecord=count($this->customerModel->findAll());
        
        $totalPage=ceil($totalRecord/$limit);
        $offset=($page-1)*$limit;
        $chunk=$this->customerModel->orderBy('id','desc')->findAll($limit,$offset);
       // dd($chunk);
        $payload=(object)[
            "records"=>$chunk,
            "totalPage"=>$totalPage,
            "totalRecord"=>$totalRecord,
            "currentPage"=>$page
        ];
         // dd($payload);
         $search='';
          return view('company/company-list',compact('payload','search'));
    }
    public function create()
    {
        
        return view ('company/add-company');
    }

    public function store()
    {
        //dd($this->request->getvar());
        //validation part
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
                    "is_not_unique" => 'You are not Authorized'
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

            "address" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Please Provide area",
                ],
            ],
            "mobile" => [
                "rules" => "required|regex_match[/^(?:\+?88)?01[3-9]\d{8}||[0-9]{8}$/]|is_unique[customers.mobile]",
                "errors" => [
                    "required" => "Mobile Number missing",
                    "regex_match" => "Provide an valid contact Number for telephone It should be 8 digits and mobile it should 11 digits (remove ++880)",
                    "is_unique" => "This mobile number already in the system"
                ],
            ],
            "email" => [
                "rules" => "valid_email|is_unique[customers.email]",
                "errors" => [
                    "valid_email" => "Provide an valid email address",
                    "is_unique" => "This email already in the system"
                ],
            ],



        ];


        //check 
        if (!$this->validate($validate)) {


            //dd($this->validator->getErrors());

            return redirect()->back()->withInput()->with('warning', $this->validator->getErrors());
        }


        try {
            $data = $this->request->getVar();
            if ($this->customerModel->save($data)) {
                return redirect()->to('/company/list')->with('success', 'Operation Success! Company Added');
            }
            return redirect()->back()->with('warning', $this->customerModel->errors())->withInput();
        } catch (Exception $err) {
            return redirect()->back()->with('warning', $err->getMessage())->withInput();
        }
    }

   //Company Details Information
   public function companyInfo($id)
   {
    $info=$this->customerModel->find($id);
     $interest= new \App\Models\InterestServicesModel();
    // $sub= $interest->select('services.name')->join('services','interest_services.services_id');
    // $builder=$interest;
    // $builder->select('interest_services.id')->fromSubquery($sub,'service_name');
    // $builder->where('company_id',$id);\
     $getInterestItem=$interest->select('services_id')->distinct()->where('company_id',$id)->orderBy('id','desc')->findAll();
     $serviceNames=[];
     $serviceModel= new \App\Models\ServicesModel();
     foreach($getInterestItem as $item)
     {
            $serviceNames[]=$serviceModel->where('id',$item->services_id)->first();
     }

    $meetingModel=new \App\Models\MeetingReportModel(); 
    $payload=$meetingModel->where('company_id',$id)->paginate(10);
    $pager=$meetingModel->pager;
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }
      return view('company/company_details',compact('info','serviceNames','payload','pager'));
   }

   //edit company information

   public function editCompany($id)
   {
    $info=$this->customerModel->find($id);
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }
      return view('company/edit_company',compact('info'));
   }
   //Update Company Information
   public function updateCompany($id)
   {
    $info=$this->customerModel->find($id);
    if($info==null)
    {
        return redirect()->back()->with('warning','Invalid Request This company doest not exist in the system');
    }

    $userInput=$this->request->getVar();
    $info->fill($userInput);
    if(!$info->hasChanged())
    {
        return redirect()->back()->with('warning','Nothing to Update');
    }

    try{
        $this->customerModel->save($info);
        return redirect()->to('/company/details/'.$id)->with('success','Information Updated');
    }catch(Exception $ex){
        return redirect()->back()->with('warning',$ex->getMessage());
    }
     
   }
   //Company Search
   public function search()
   {
       $search=esc($this->request->getVar('search'));
       $limit=$this->request->getVar('limit')??10;
       $page=$this->request->getVar('page')??1;
       $totalRecord=count($this->customerModel->orderBy('id','desc')->like('company_name',$search,'both')->orLike('mobile',$search,'both')->orLike('email',$search,'both')->findAll());
       
       $totalPage=ceil($totalRecord/$limit);
       $offset=($page-1)*$limit;
       $chunk=$this->customerModel->orderBy('id','desc')->like('company_name',$search,'both')->orLike('mobile',$search,'both')->orLike('email',$search,'both')->findAll($limit,$offset);
     
       
       $payload=[
           "records"=>$chunk,
           "totalPage"=>$totalPage,
           "totalRecord"=>$totalRecord,
           "currentPage"=>$page
       ];

       return view('company/company-list',['payload'=>(object)$payload,'search'=>$search]);
   }

}
