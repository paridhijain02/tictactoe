<?php
require_once('model/login_model.php');
class Controller
{
    public $model;
    public function __construct()
    {
        $this->models=new User();

    }
    public function invoke()
    {
       $result= $this->models->getlogin();
       if($result == 'login'){
           include 'view/loggedin.html';
       }
       else{
        include 'view/login.html';
       }
    }
    public function logout()
    {
       $result= $this->models->getlogout();
       if($result == 'logout'){
           include 'view/login.html';
       }
       else{
        include 'view/loggedin.html';
        //include 'view/login.html';
    }
    }
}
?>