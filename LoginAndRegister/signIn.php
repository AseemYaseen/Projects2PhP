<!-- <!DOCTYPE html>
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
    $_SESSION['Validate'] = false;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $p=crud::connection()->prepare('SELECT * FROM userstable WHERE email=:ea and password=:ps');

    $p->bindValue(':ea',$email);
    $p->bindValue(':ps',$password);
    $p->execute();
    $d = $p->fetchAll(PDO::FETCH_ASSOC);
    
    if($p->rowCount()>0){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['Validate'] = true;
        header('location:home1.php');
    }
}

?>
<div class="form">
        <div class="title">
            <p>Sign up form</p>
        </div>
        <form action="" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Sign IN" name="signUP_button">
        </form>
    </div>

</body>
</html> -->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">

    <title>log in</title>
    <style>
        .container{
            width: 30%;
            height: 40vh;
            margin:  auto ;
            transform: translateY(200px);

            
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    require('./connection.php');

    if(isset($_POST['submit'])){

        $email=$_POST['email'];
        $password=$_POST['password'];
        // $nowTimeStamp = date("Y-m-d H:i:s");
        $error="";
        $db = crud::connect()->prepare("SELECT * FROM users WHERE email=:email and password = :password ");
        $db->bindValue(':email' , $email);
        $db->bindValue(':password' , $password);
        $db->execute();
        $d= $db->fetch(PDO::FETCH_ASSOC);
        if(!empty($_POST['email'])&&!empty($_POST['password'])){
            if($d){
                $_SESSION['name']=$d["full_name"];
                $_SESSION['email']=$d["email"];
                $_SESSION['pass']=$d["password"];
                $_SESSION['role']=$d["role"];
                $_SESSION['id']=$d["id"];
                $_SESSION['validate']=true;
                header("location:./users.php");

                 //add date last log in use now() function
                $sql="UPDATE  users SET  last_login =now() WHERE id=". $_SESSION['id'];
                $db = crud::connect()->prepare( $sql);
                $db->execute();
            }
         
            else{
                $error= "not match";
                
            }  
           
        } else{
            $error= "error";  
        }   
          
    }
    

    ?>

<div class="container">

<h3>LOGIN </h3>
<form action="" method="post" enctype="multipart/form-data" id="form">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="password">
    <?php 
    if( !empty ($error) ){
        echo "<p>$error</p>";
    }
    ?>
    <input type="submit" name="submit" value="login">
    <p id="para">Don't have an account?<a href="./register.php" >Sign up</a></p>

</form>
    </div>
</body>
</html>