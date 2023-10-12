<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $fname=$_POST["fname"];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    echo "<table>";
    echo "<tr><th>Name</th><th>Gender</th><th>Address</th><th>Email</th><th>Phone</th></tr>";
    echo"<tr>";
    echo"<th>First name:$fname</th>";
    echo"<th>Last name:$lname</th>";
    echo"<th>Gender:$gender</th>";
    echo"<th>Email:$email</th>";
    echo"<th>Phone_no:$phone</th>";
    echo"<tr>";
}