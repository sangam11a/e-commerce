<?php 
session_start();
if(isset($_SESSION['customer'])){
    header("location:index.php");
    die;
}
require_once "../googlelogin/vendor/autoload.php";
require_once "../includes/init.php";

$customer = new Customer();

$clientId = "159448910259-lgjd52krml824n3q8esk1gmtqrcfkn92.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUrl = "http://localhost/sem-V/public/glogin.php";

//Client request
$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope('profile');
$client->addScope('email');

    if(isset($_GET['code'])){
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if(!isset($token['error'])){
            $client->setAccessToken($token);
            
            //User profile
            $gauth = new Google_Service_Oauth2($client);
            $google_info = $gauth->userinfo->get();
            $email = $google_info->email;
            $name = $google_info->name;
            if($customer->selected($email) > 0){
               if($customer->selected($email)['login_type'] === "gmail"){
                    if($customer->selected($email)['name'] === $name){
                        $_SESSION['customer'] = $customer->selected($email)['email'];
                        $_SESSION['customer_id'] = $customer->selected($email)['cus_id'];
                        echo "<script>window.location.replace('index.php')</script>";
                        die;
                    }else{
                        echo "<p style='color:red;'>Authorization failed. <a href='login.php'>Login</a></p>";
                        die;                        
                    }
               } else{
                echo "<p style='color:red;'>Email supports custom login. <a href='login.php'>Login</a></p>";
                die;
               }
            }else{
                echo "<p style='color:red;'>No such user. <a href='signup.php'>Signup</a></p>";
                die;
            }
        }else{
                echo "<p style='color:red;'>Token error. <a href='login.php'>Login</a></p>";
            die;
        }    
    }
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['glogin'])){
        header("Location: ".$client->createAuthUrl());    
        die;
    }
}
