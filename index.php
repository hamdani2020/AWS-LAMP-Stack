
<?php 

$connect = mysqli_connect("localhost","root","","gmsa");

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $number = $_POST['number'];


    $query = "INSERT INTO registration(firstname,lastname,programme,email,gender,contact,number) VALUES('$fname','$lname','$pname','$email','$gender','$contact','$number')";

    $result = mysqli_query($connect,$query);

    if ($result) {
        echo "<script>alert('You have successfully been registered')</script>";
    }else{
        echo "<script>alert('Sorry try again')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>GMSA Registration Form</title>
</head>
<body>
    <center>
        <h1>GMSA Registration Form</h1>
        <br>

        <form method="post">
            <label>Firstname</label>
            <input type="text" name="fname" placeholder="enter firstname">
            <br>
            <br>
            <label>Lastname</label>
            <input type="text" name="lname" placeholder="Enter Lastname">
            <br><br>
            <label>Programme</label>
            <input type="text" name="pname" placeholder="Enter Programme">
            <br><br>
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter Email">
            <br><br>
            <label>Gender</label>
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female
            <br><br>
            <label>Contact</label>
            <input type="text" name="contact" placeholder="Enter WhatsApp Contact">
            <br><br>
            <label>Reference Name</label>
            <input type="text" name="number" placeholder="Must be 8 digit">
            <br><br>
            <input type="submit" name="register" value="register">
        </form>
    </center>
</body>
</html>