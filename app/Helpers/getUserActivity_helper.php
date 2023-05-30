<?php
if(!function_exists('getActivity'))
{
    function getActivity($id)
    {
        $activityModel=new \App\Models\EmployActivityModel();
        return $activityModel->where('user_id',$id)->orderBy('id','desc')->findAll(10);
    }
}


?>