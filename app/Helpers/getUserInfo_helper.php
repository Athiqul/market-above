<?php
if(!function_exists('getUsername'))
{
    function getUsername($id)
    {
        $userModel=new \App\Models\UserModel();
        return $userModel->find($id);
    }
}

?>