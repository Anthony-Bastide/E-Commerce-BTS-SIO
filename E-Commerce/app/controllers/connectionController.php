<?php
namespace App\controllers;

use App\Models\User;

class connectionController extends Controller{

    public function login()
    {
        $user = new User($this->getDB());
        $user = $user->findByColumn($_POST['email'], 'email');

        if(password_verify($_POST['password'],$user->password) ){      
           if($user->role == true)
           {
                $_SESSION['auth'] = $user->role;
                $_SESSION['user_id'] = $user->id;
                if($user->role == 1){
                    $_SESSION['is_admin'] = true;

                return $this->view("homepage.index");
                }
            return $this->view("homepage.index");

           }
        } else {
            header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
            echo "<script>alert('Le mot de passe ou l'identifiant est incorrect');</script>";
        }
    }

    public function create()
    {
        return $this->display("auth.create");
    }
    

    // public function logout()
    // {
    //         session_destroy();
    //         return header('location: /mvc/');
    // }

    public function logout()
    {
        session_destroy();
        return header('location: /e-commerce-BTS-SIO/E-Commerce/homepage');
    }

}