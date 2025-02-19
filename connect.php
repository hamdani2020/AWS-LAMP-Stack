<?php 
$host = "db"; // Use service name from docker-compose
$username = "root";
$password = "root";
$database = "registration";

// Connect to MySQL
$connect = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pname = $_POST['pname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $number = $_POST['number'];

    // Prevent SQL Injection
    $fname = mysqli_real_escape_string($connect, $fname);
    $lname = mysqli_real_escape_string($connect, $lname);
    $pname = mysqli_real_escape_string($connect, $pname);
    $email = mysqli_real_escape_string($connect, $email);
    $gender = mysqli_real_escape_string($connect, $gender);
    $contact = mysqli_real_escape_string($connect, $contact);
    $number = mysqli_real_escape_string($connect, $number);

    // Insert into users table
    $query = "INSERT INTO users (firstname, lastname, programme, email, gender, contact, number) 
              VALUES ('$fname', '$lname', '$pname', '$email', '$gender', '$contact', '$number')";

    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Registration failed: " . mysqli_error($connect) . "');</script>";
    }
}
?>

