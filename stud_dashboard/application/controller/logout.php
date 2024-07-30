<?php
    //session_start();
    class Logout extends Controller
    { 

        public function index()
        {
            $login_model = $this->loadModel('LoginModel');
            $login_model->updateLogin(0,$_SESSION['logged_id']['email']);
            
            unset($_SESSION['logged_id']);
            unset($_SESSION['stud_pic']);
            session_destroy();

            //redirect to home
            header("location: https://mtss.schooldriveng.com/index.php/student/dashboard");


        }


    }
