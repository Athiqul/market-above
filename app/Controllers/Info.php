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
          //validation
          //store 
          //notification
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

    }
}
