<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signUp.css">
    <title>Document</title>
</head>
<body>

<?php
require('./connection.php');

if(isset($_POST["signUP_button"])){
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $password = $_POST['password'];
    $confPassword = $_POST['confPassword'];

//////////////////////////////////////
 // check birthday date
 $date=date_create($_POST['birthday']); // burthday date
 $nowdate=date_create("now");  // now date
 $diff= date_diff( $date,  $nowdate); // difference between burthday date and now date = (The person's age an object)
 // print_r( $diff);
 $age=$diff->y; // age user / The person's age in years
 // echo $age;
 
$one=0;
$two=0;
$three=0;
$four=0;
$five=0;
$six=0;
$error_name="";
$error_email="";
$error_number="";
$error_password="";
$error_repassword="";
$error_age="";
if(preg_match("/^[A-Z a-z]+$/",$_POST['name'])&&!empty($_POST['name'])){
    $name = $_POST['name'];
    $one=1;

} else {
    $error_name= 'Your first name should contain just alphabets'."<br>";
}

if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&!empty($_POST['email'])){
$email = $_POST['email'];
$two=1;
} else {
    $error_email= 'Your email is invalid'."<br>";
}
if(preg_match("/^[0-9\-\+]{14}$/",$_POST['phone'])&&!empty($_POST['phone'])){
    $phone = $_POST['phone'];
    $five=1;

} else {
    $error_number= 'phone number Should be 14 digits'."<br>";
}
if(preg_match(("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/"), $_POST['password'])&&!empty($_POST['password'])){
$password = $_POST['password']; 
$three=1;
} else {

$error_password ='Your password is week'."<br>";
}
if(  $password ==  $confPassword ){
    $four=1;

}else{
    $error_repassword= 'Your password is not match'."<br>";

}
if( $age >= 16 ){
    $six=1;

}else{
    $error_age= 'Sorry your age is under the minimum.'."<br>";

}

/////////////////////////////////////
if( $one==1 && $two==1 && $three==1 &&  $four==1 &&  $five==1 &&  $six==1){
        if($password == $confPassword){
        $p = crud::connection()->prepare('INSERT INTO userstable(firstName,lastName,email,phoneNumber,date,password) VALUE (:fn,:ln,:em,:ph,:bi,:ps)');
        $p->bindValue(':fn',$name);
        $p->bindValue(':ln',$lastName);
        $p->bindValue(':em',$email);
        $p->bindValue(':ph',$phone);
        $p->bindValue(':bi',$birthday);
        $p->bindValue(':ps',$password);

        $p->execute();
        }
    }
}
?>
<div class="form">
        <div class="title">
            <p>Sign up form</p>
        </div>
        <form action="" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="lastName" placeholder="Last Name">
        <input type="text" name="email" placeholder="Email">
        <input type="number" name="phone" placeholder="Phone Number">
        <input type="Date" name="birthday">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confPassword" placeholder="Confirm Password">
        <input type="submit" value="Sign UP" name="signUP_button">
        </form>
    </div>

</body>
</html>

<!-- 
<div class="container">

<h3>CREATE ACCOUNT</h3>
<form action="" method="post" enctype="multipart/form-data" id="form">
    <input type="text" name="name" placeholder="first name">
    <?php 
    if( !empty ($error_name) ){
        echo "<p>$error_name</p>";
    }
    ?>
    <input type="email" name="email" placeholder="Email">
    <?php 
    if( !empty($error_email) ){
        echo "<p>$error_email</p>";
    }
    ?>
    <input type="number" name="number" placeholder="Phone number">
    <?php 
    if(  !empty($error_number)){
        echo "<p>$error_number</p>";
    }
    ?>
    <input type="password" name="password" placeholder="password">
    <?php 
    if(  !empty($error_password)){
        echo "<p>$error_password</p>";
    }
    ?>
    <input type="password" name="re-password" placeholder="confirm password">
    <?php 
    if(  !empty($error_repassword)){
        echo "<p>$error_repassword</p>";
    }
    ?>
    <input type="date" name="date">
    <?php 
    if(  !empty($error_age)){
        echo "<p>$error_age</p>";
    }
    ?>
    <input type="submit" name="submit" value="register">
</form>
    </div>
</body>
</html> -->