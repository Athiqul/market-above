<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ServicesModel;
use App\Models\MeetingReportModel;
use App\Models\InterestServicesModel;
use Exception;
use PHPUnit\Framework\Constraint\Exception as ConstraintException;

class Meeting extends BaseController
{
     private $meetingModel;
     private $interestModel;
     public function __construct()
     {
        $this->meetingModel= new MeetingReportModel();
        $this->interestModel=new InterestServicesModel();
     }
    // All Meeting Report with Pagination
    public function index()
    {
        return view('meeting/meeting_list');
    }

    //Meeting Record Create view
    public function create()
    {
         
         return view('meeting/create');
    }

    //Meeting Record Store into database
    public function store()
    {
         //dd(count($this->request->getVar('services')));
         $validation=[
            "company_id"=>[
                "rules"=>"required|is_not_unique[customers.id]",
                "errors"=>[
                    "required"=>"Please Select Company!",
                    "is_not_unique"=>"Invalid Company Selected",
                ]
                ],
                "contact_person"=>[
                    "rules"=>"required",
                    "errors"=>[
                        "required"=>"Please Write Contacted Person Name!",
                    ]
                    ],
                    "desg"=>[
                        "rules"=>"required",
                        "errors"=>[
                            "required"=>"Please provide Contacted Person Designation",
                        ]
                        ],
                        "mobile"=>[
                            "rules"=>"required|regex_match[017+[0-9]{8}|018+[0-9]{8}|013+[0-9]{8}|014+[0-9]{8}|019+[0-9]{8}|015+[0-9]{8}|016+[0-9]{8}]",
                            "errors"=>[
                                "regex_match"=>"Please provide valid mobile number",
                            ]
                            ],
                            
                                "summary"=>[
                                    "rules"=>"required|min_length[10]",
                                    "errors"=>[
                                        "min_length"=>"Please Provide more information on Summary!",
                                        "required"=>"Please Write Meeting Summary!"
                                    ]
                                    ],
                                    "user_id"=>[
                                        "rules"=>"required|is_not_unique[user_access.id]",
                                        "errors"=>[
                                            "is_not_unique"=>"There is a problem please logout and try again",
                                            "required"=>"There is a problem please logout and try again",
                                        ]
                                        ],

         ];

         if(!$this->validate($validation))
         {
            return redirect()->back()->with('warning',$this->validator->getErrors())->withInput();
         }

         //save data into meeting
         $data=[
            "company_id"=>$this->request->getVar("company_id"),
            "contact_person"=>esc($this->request->getVar("contact_person")),
            "desg"=>esc($this->request->getVar("desg")),
            "mobile"=>$this->request->getVar("mobile"),
            "email"=>$this->request->getVar("email"),
            "summary"=>$this->request->getVar("summary"),
            "user_id"=>$this->request->getVar("user_id"),                       
         ];
        //Transaction begin
        $db = \Config\Database::connect();
        $db->transBegin();
        try {

            $this->meetingModel->insert($data);
            $meetingId = $this->meetingModel->getInsertID();

            if (count($this->request->getVar('services')) > 0) {
                $services = $this->request->getVar('services');
                foreach ($services as $item) {
                    $check=new ServicesModel();
                    if($check->find($item)==null)
                    {
                      break;
                    }
                    
                    $serviceData = [
                        "meeting_id" => $meetingId,
                        "company_id" => $this->request->getVar("company_id"),
                        "services_id" => $item,
                    ];
                    $this->interestModel->insert($serviceData);
                }
            }
            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('warning', 'Meeting Report Add Failed!');
            }
            $db->transCommit();
            return redirect()->back()->withInput()->with('success', 'Meeting Report Successfully Added!');
        } catch (Exception $ex) {
            $db->transRollback();

            return redirect()->back()->withInput()->with('warning', $ex->getMessage());
        }
    }

    //Meeting Record identical show
    public function show($id)
    {

    }

    //Meeeting Record edit render view
    public function edit($id)
    {

    }

    //Meeting Record update
    public function update($id)
    {

    }
}
