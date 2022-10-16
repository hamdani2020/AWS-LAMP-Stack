<?php 

$connect = mysqli_connect("localhost","root","","registration");

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $number = $_POST['number'];


    $query = "INSERT INTO users(firstname,lastname,programme,email,gender,contact,number) VALUES('$fname','$lname','$pname','$email','$gender','$contact','$number')";

    $result = mysqli_query($connect,$query);

    if ($result) {
        echo "<script>alert('You have successfully been registered')</script>";
    }else{
        echo "<script>alert('Sorry try again')</script>";
    }
}

?>

