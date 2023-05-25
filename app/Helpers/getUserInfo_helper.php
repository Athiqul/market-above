<?php
if(!function_exists('getUsername'))
{
    function getUsername($id)
    {
        $userModel=new \App\Models\UserModel();
        return $userModel->find($id);
    }
}
if(!function_exists('userImage'))
{
    function userImage($id)
    {
        $userModel=new \App\Models\UserInfo();
        return ($userModel->where('user_id',$id)->first()->image_link)??null;
    }
}

?>