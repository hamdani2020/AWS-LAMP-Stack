
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>GMSA Registration Form</title>
</head>
<body>

    <nav>
        <div class="topnav" id="myTopnav">
            
            <a href="#home" >Home</a>
            <a href="#news">About</a>
            <a href="#contact">Contact</a>
            <a href="#about" class="active">Become a member</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              <i class="fa fa-bars"></i>
            </a>
          </div>
    </nav>

    <div class="container">
        <h1 class="title">GMSA Registration Form</h1>
        <br>

        <form class="reg--form" method="post">
            <label>Firstname: </label>
            <input type="text" name="fname" placeholder="enter firstname">
            <br>
            <br>
            <label>Lastname: </label>
            <input type="text" name="lname" placeholder="Enter Lastname">
            <br><br>
            <label>Programme: </label>
            <input type="text" name="pname" placeholder="Enter Programme">
            <br><br>
            <label>Email: </label>
            <input type="email" name="email" placeholder="Enter Email">
            <br><br>
            <label>Gender: </label>
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
            <br><br>
            <label>Contact: </label>
            <input type="text" name="contact" placeholder="Enter WhatsApp Contact">
            <br><br>
            <label>Reference Name: </label>
            <input type="text" name="number" placeholder="Must be 8 digit">
            <br><br>
            <input class="register" type="submit" name="register" value="register">
        </form>
    </div>
    <script>
        function myFunction() {
          var x = document.getElementById("myTopnav");
          if (x.className === "topnav") {
            x.className += " responsive";
          } else {
            x.className = "topnav";
          }
        }
        </script>
</body>
</html>