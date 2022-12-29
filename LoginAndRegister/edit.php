<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Edit data</title>
</head>
<body>

<?php require('./connection.php');?>
<?php ?>
<?php
$id=$_GET['id'];

// get data from DB use id
$db = crud::connection()->prepare("SELECT * FROM userstable WHERE id= $id"); 
$db->execute();
$data= $db->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $name=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    $number=$_POST['phoneNumber'];
    $password=$_POST['password'];
    $repassword=$_POST['re-password'];

$one=0;
$two=0;
$three=0;
$four=0;
$five=0;
if(preg_match("/^[A-Z a-z]+$/",$_POST['firstName'])&&!empty($_POST['firstName'])){
    $name = $_POST['firstName'];
    $one=1;

} else {
    echo 'Your first name should contain just alphabets'."<br>";
}
if(preg_match("/^[A-Z a-z]+$/",$_POST['lastName'])&&!empty($_POST['lastName'])){
    $lastName = $_POST['lastName'];
    $two=1;

} else {
    echo 'Your last name should contain just alphabets'."<br>";
}


if(preg_match("/^[0-9\-\+]{10}$/",$_POST['phoneNumber'])&&!empty($_POST['phoneNumber'])){
    $number = $_POST['phoneNumber'];
    $five=1;

} else {
    echo 'phone number Should be 10 digits'."<br>";
}
if(preg_match(("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/"), $_POST['password'])&&!empty($_POST['password'])){
$password = $_POST['password']; 
$three=1;
} else {
echo $_POST['password'];
echo 'Your password is week'."<br>";
}
if(  $password ==  $repassword ){
    $four=1;
}else{
    echo 'Your password is not match'."<br>";

}
if( $one==1 && $two==1 && $three==1 &&  $four==1 &&  $five==1){
    $sql = "UPDATE userstable SET firstName=:fname, lastName=:lname, email=:Email, phoneNumber=:Phone, password=:pass WHERE id=:id";
    $db = crud::connection()->prepare($sql);

    $db->bindValue(':fname' , $name);
    $db->bindValue(':lname' , $lastName);
    $db->bindValue(':Email', $email);
    $db->bindValue(':Phone', $number);
    $db->bindValue(':pass' , $password);
    $db->bindValue(':id',$id);
    $db->execute();
    echo 'Successfully'."<br>";
    header("location:./users.php");
exit();

}else{
    echo 'not Successfully'."<br>";

}};
?>
<div class="container">

<h3>EDIT DATA </h3>
<form action="" method="post" enctype="multipart/form-data" id="form">
    <input type="text" name="firstName" placeholder="first name" value="<?php echo $data['firstName'];?>">
    <?php 
    if( !empty ($error_name) ){
        echo "<p>$error_name</p>";
    }
    ?>
    <input type="text" name="lastName" placeholder="Email" value="<?php echo $data['lastName'];?>">
    <?php 
    if( !empty($error_email) ){
        echo "<p>$error_email</p>";
    }
    if( !empty($email_exist) ){
        echo "<p>$email_exist</p>";
    }
    ?>
    <input type="text" name="email" placeholder="Email" value="<?php echo $data['email'];?>">
    <?php 
    if(  !empty($error_number)){
        echo "<p>$error_number</p>";
    }
    ?>
    <input type="number" name="phoneNumber" placeholder="Phone" value="<?php echo $data['phoneNumber'];?>">
    <?php 
    if(  !empty($error_password)){
        echo "<p>$error_password</p>";
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
    <input type="date" name="date" >
    <?php 
    if(  !empty($error_age)){
        echo "<p>$error_age</p>";
    }
    ?>
    <input type="submit" name="submit" value="edit">

</form>
    </div>

</body>
</html>