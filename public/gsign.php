<?php
session_start();

require_once "../googlelogin/vendor/autoload.php";
require_once "../includes/init.php";
$customer = new Customer();

$clientId = "159448910259-lgjd52krml824n3q8esk1gmtqrcfkn92.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUrl = "http://localhost/sem-V/public/gsign.php";

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
        if($customer->selected($email) > 0){
            echo "<p style='color:red;'>Email already has account. <a href='login.php'>Login</a></p>";
            die;
        }else{
            $name = $google_info->name;
            $password = "qwertyuiop";
            if(isset($_SESSION['gmailcontact'])){
                $contact = $_SESSION['gmailcontact'];
    
                $customer->addGmail($name, $contact, $email, $password);
                header("location:login.php");
            }    
        }
        
    }else{
            echo "<p style='color:red;'>Token error. <a href='login.php'>Login</a></p>";
        die;
    }    
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['gmailsign'])){
        $contact = clean($_POST['contactgmail']);
        if(empty($contact) || !is_numeric($contact)){
            header("location:signup.php?err=Contact not valid");
            die;
        }
        $_SESSION['gmailcontact'] = $contact;
        header("Location: ".$client->createAuthUrl());    
        die;    
    }
}

