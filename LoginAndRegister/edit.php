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

    if(!empty($_POST['name'] && !empty($_POST['lastName'] && !empty($_POST['email'] ) && !empty($_POST['phone'] ) && !empty($_POST['birthday'] ) && !empty($_POST['confPassword'] ) ))){
        if($password == $confPassword){
        $p = crud::connection()->prepare('UPDATE userstable SET name=:fn, lastName=:ln,email=:em ,phone=:ph, birthday=:bi, password=:ps)');
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
        <input type="submit" value="Edit" name="signUP_button">
        </form>
    </div>

</body>
</html>
