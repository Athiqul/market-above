<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\Info as InfoModel;
use CodeIgniter\CodeIgniter;

class Info extends BaseController
{
    //constructor
    private $model;
    public function __construct()
    {
        $this->model=new InfoModel();
    }
    //Show All documents
    public function index()
    {
        $docs=$this->model->paginate(20);
        $pager=$this->model->pager;
        return view('info/index',compact('docs','pager'));
    }
    //Create Documents
    public function create()
    {
        return view('info/create');
    }
    public function store()
    {
            //validation
            $validation=[
                   "title"=>[
                    "rules"=>"required|min_length[3]",
                    "errors"=>[
                        "required"=>"Document Title needed!",
                        "min_length"=>"To short title!",
                    ]
                   ],
                   "type"=>[
                    "rules"=>"required",
                    "errors"=>[
                        "required"=>"Please select the type of the document"
                    ],
                   ],
                  
            ];
            
        if(!$this->validate($validation))
        {
            return redirect()->back()->withInput()->with('warning',$this->validator->getErrors());
        }
        $file=$this->request->getFile('doc_link');
        
        if($file->isValid()==true)
        {
            //Image validation
            $getSize=$file->getSizeByUnit('mb');
            if($getSize>=30)
            {
                return redirect()->back()
                ->with('warning','Document is too large Its bigger than 1 mega byte');
            }
            $getMime=$file->getMimeType();
            $allowedTypes=['application/pdf'];
            if(!in_array($getMime,$allowedTypes))
            {
                  return redirect()->back()
                  ->with('warning','Document Format Invalid only PDF will Accept');
            }

            //save document
            $doc_link=uniqid().$file->getName();
            $path="uploads/company-info/";
            !is_dir($path)&&mkdir($path,0777,true);
             if (!$file->move(WRITEPATH.$path,$doc_link))
             {
                 return redirect()->back()->with('warning','Document upload failed');  
             }

         //store    
          $data=[
            "title"=>$this->request->getVar("title"),
            "type"=>$this->request->getVar('type'),
            "doc_link"=>$doc_link
          ];
           
           try{
            if($this->model->save($data))
            {
                return redirect()->to('/company-info')->with('success','Successfully Added Document!');
            }else{
                return redirect()->back()->with('warning',$this->model->errors())->withInput();
            }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$this->model->errors())->withInput();
        }
          

        } 
        
    }
    //Update documents
    public function show($id)
    {
        $doc=$this->model->find($id);
        if($doc==null)
        {
            Throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('info/update',compact('doc'));    
    }

    
    public function update($id){
        $doc=$this->model->find($id);
        if($doc==null)
        {
            Throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

          //validation
          $validation=[
            "title"=>[
             "rules"=>"required|min_length[3]",
             "errors"=>[
                 "required"=>"Document Title needed!",
                 "min_length"=>"To short title!",
             ]
            ],
            "type"=>[
             "rules"=>"required",
             "errors"=>[
                 "required"=>"Please select the type of the document"
             ],
            ],
           
     ];

     if(!$this->validate($validation))
     {
         return redirect()->back()->withInput()->with('warning',$this->validator->getErrors());
     }


       $file=$this->request->getFile('doc_link');
        $doc_link=null;
        if($file->isValid()==true)
        {
            //Image validation
            $getSize=$file->getSizeByUnit('mb');
            if($getSize>=30)
            {
                return redirect()->back()
                ->with('warning','Document is too large Its bigger than 1 mega byte')->withInput();
            }
            $getMime=$file->getMimeType();
            $allowedTypes=['application/pdf'];
            if(!in_array($getMime,$allowedTypes))
            {
                  return redirect()->back()
                  ->with('warning','Document Format Invalid only PDF will Accept')->withInput();
            }

            //save document
            $doc_link=uniqid().$file->getName();
            $path="uploads/company-info/";
            !is_dir($path)&&mkdir($path,0777,true);
             if (!$file->move(WRITEPATH.$path,$doc_link))
             {
                 return redirect()->back()->with('warning','Document upload failed')->withInput();  
             }

             //Remove Previous file
             $doc->doc_link!=null && file_exists($path.$doc->doc_link) && unlink($path.$doc->doc_link);
            }    

         //store    
          
            $doc->title=$this->request->getVar("title");
            $doc->type=$this->request->getVar('type');
            $doc->doc_link=$doc_link??$doc->doc_link;

          if(!$doc->hasChanged())
          {
              return redirect()->back()->with('info','Nothing updated!');
          } 
           
           try{
            if($this->model->save($doc))
            {
                return redirect()->to('/company-info')->with('success','Successfully updated The Document!');
            }else{
                return redirect()->back()->with('warning',$this->model->errors())->withInput();
            }
        }catch(Exception $ex){
            return redirect()->back()->with('warning',$this->model->errors())->withInput();
        }
          

        } 

    
    //Delete Document
    public function deleteDoc($id)
    {
        $doc=$this->model->find($id);
        if($doc==null)
        {
            Throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    //Document show
    public function showDoc($docName)
    {
        $path=WRITEPATH.'uploads/company-info/'.$docName;
       
        // dd(file_exists($path));
         
         if (file_exists($path)) {
          $this->response->setHeader('Content-Type', 'application/pdf');
          $this->response->setHeader('Content-Disposition', 'inline; filename="'.$docName.'"');
          $this->response->setHeader('Cache-Control', 'public, max-age=0, must-revalidate');
          $this->response->setBody(file_get_contents($path));
          return $this->response->send();
      } else {
          throw new \CodeIgniter\Exceptions\PageNotFoundException();
      }
    }
}
