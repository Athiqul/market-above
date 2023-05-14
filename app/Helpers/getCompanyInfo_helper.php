<?php
if(!function_exists('companyInfo'))
{
    function companyInfo($id)
    {
        $companyModel=new \App\Models\Customer();
        return $companyModel->find($id);
    }
}

?>