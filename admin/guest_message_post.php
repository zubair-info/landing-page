<?php
    session_start();
    require_once('../config.php');

    // if(!isset($_SESSION['user_status'])){
    //     header('location: ../login.php');        
    // }
    //  echo 'ok';
    // print_r($_POST);

    $gusest_name=filter_var($_POST['gusest_name'],FILTER_SANITIZE_STRING); 
    // $gusest_name=$_POST['gusest_name']; 
    // $guest_email=$_POST['guest_email'];
     
    $guest_email=filter_var($_POST['guest_email'],FILTER_SANITIZE_EMAIL);
    $email_lower=strtolower($guest_email);
    $guest_email=filter_var($guest_email,FILTER_VALIDATE_EMAIL); 
    // $guest_subject=$_POST['guest_subject'];
    $guest_subject=filter_var($_POST['guest_subject'],FILTER_SANITIZE_STRING);
    $guest_mesage=filter_var($_POST['guest_mesage'],FILTER_SANITIZE_STRING);  
    // $guest_mesage=$_POST['guest_mesage'];

    // $insert_query="INSERT INTO guest_messages (gusest_name,guest_email,guest_subject,guest_mesage) VALUES ('$gusest_name','$guest_email','$guest_subject','$guest_mesage')";
    // mysqli_query($db_conect,$insert_query); 
    // header('location: ../index.php');

    if(empty($gusest_name)){

        // $_SESSION['gusest_name']='User Name Requried';
        // header('location: ../index.php');

    }elseif(empty($guest_email)){
        // $_SESSION['guest_email']='Email Requried';
        // header('location: ../index.php');
 
    }elseif(empty($guest_subject)){
        // $_SESSION['guest_subject']='Subject Is Requried';
        // header('location: ../index.php');
        
    }elseif(empty($guest_mesage)){
        // $_SESSION['guest_mesage']='Message Requried';
        // header('location: ../index.php');
        
    }else{

        $insert_query="INSERT INTO guest_messages (gusest_name,guest_email,guest_subject,guest_mesage) VALUES ('$gusest_name','$valid_email','$guest_subject','$guest_mesage')";
       
        mysqli_query($db_conect,$insert_query); 
        header('location: ../index.php');
    }






?>