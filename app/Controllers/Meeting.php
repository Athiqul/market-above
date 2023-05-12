<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use Exception;

class Meeting extends BaseController
{

    // All Meeting Report with Pagination
    public function index()
    {
        
    }

    //Meeting Record Create view
    public function create()
    {
         
         return view('meeting/create');
    }

    //Meeting Record Store into database
    public function store()
    {
         //dd($this->request->getVar());
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
         try{

         }catch(Exception $ex){

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
