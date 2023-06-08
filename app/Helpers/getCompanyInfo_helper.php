<?php
if(!function_exists('companyInfo'))
{
    function companyInfo($id)
    {
        $companyModel=new \App\Models\Customer();
        return $companyModel->find($id);
    }

    function meetingReport($id)
    {
        $meeting= new \App\Models\MeetingReportModel();
        return $meeting->find($id);
    }
}

?>