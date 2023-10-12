<?php

//connection query
$conn = mysqli_connect("localhost","root","ceymox123","DB");

if (!$conn) {
    die("Connection failed:".mysqli_connect_error());
}
//insert query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $checkEmail = "SELECT * FROM demo WHERE email = '$email'";
    $emailResult = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($emailResult) > 0) {
        echo "<script>alert('Email already exists. Cannot insert a duplicate.')</script>";
    } else {
        $sql = "INSERT INTO demo (fname, lname, gender, address, email, phone) VALUES ('$fname', '$lname', '$gender', '$address', '$email', '$phone')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record inserted successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$sqldi = "SELECT * FROM demo";
$result = mysqli_query($conn, $sqldi);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Basic Form</title>  
    <style>
        h1 {
            text-align:center;
            color:red;
        }
        form {
            width:400px;
            margin:0 auto;
            border:2px solid;
            padding :12px 20px;
        }
        input[type=text] {
            padding:10px 0;
            margin:8px 30px;
        }
        input[type=email]{
            padding: 10px 0;
            margin:8px 60px;
        }
        #phone{
            padding:10px 0;
            margin:8px 0;
        }
        #address{
            padding:10px 0;
            margin:8px 105px;
        }
        #male{
            padding:10px 200px;
            margin:8px 110px;
        }
        #female{
            padding:10px 200px;
            margin:8px 110px;
        }
        table {
            border :2px solid;
            border-collapse: collapse;
        }
        th, td {
            padding:15px;
            border-bottom:2px solid;
            
        }
    </style>
</head>
<body>
    <!-- Form creation-->
    <h1>Basic Form</h1>
    <form id="myForm" method="post">
        First Name:
        <input type="text" id="fname" name="fname" required><br><br>
        <span id="fnameError" class="error"></span>
        Last Name:
        <input type="text" id="lname" name="lname" required><br><br>
        <span id="lnameError" class="error"></span>
        Gender:<br>
        <input type="radio" id="male" name="gender" value="male" required> Male<br>
        <input type="radio" id="female" name="gender" value="female" required> Female<br><br>
        Address:<br>
        <textarea cols="20" rows="6" id="address" name="address"></textarea><br><br>
        <span id="addressError" class="error"></span>
        Email:
        <input type="email" id="email" name="email" required><br><br>
        Phone Number:
        <input type="text" id="phone" name="phone" required><br><br>
        <span id="phoneError" class="error"></span>
        <input type="button" name="submitt" value="submit form" onclick="validate()"><br><br>
    </form>

    <?php
    //display records
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Gender</th><th>Address</th><th>Email</th><th>Phone</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["fname"] . $row["lname"] ."</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td><a class='btn btn-info' href='edit.php?id=". $row['id']."'>Edit</a>&nbsp;<a class='btn btn-danger' href='delete.php?id=". $row['id']."'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }
    ?>
</body>
</html>

<script>
function validate() {
    
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var address = document.getElementById("address").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;

    document.getElementById("fnameError").textContent = "";
    document.getElementById("lnameError").textContent = "";
    document.getElementById("addressError").textContent = "";
    document.getElementById("phoneError").textContent = "";

    var isValid=true;

    if(fname == "" || lname == "" || address == "" || phone == "" || email == "" ) {
        alert("Please fill in all fields.");
        return false;
    }

    var namePattern = /^[a-zA-Z ]{3,30}$/;
    var phonePattern = /^[6789]\d{9}$/;

    if (!namePattern.test(fname) || !namePattern.test(lname)) {
        document.getElementById("fnameError").textContent = "name should contain atleast 3 letters and only letters";
        isValid = false;
    }

    if (address.length > 100) {
        document.getElementById("addressError").textContent = "address should contain atmost 100 letters";
        isValid = false;
    }

    if (!phonePattern.test(phone)) {
        document.getElementByID("phoneError").textContent ="phone must contain 10 numbers and should start with 6,7,8,9";
        isValid = false;
    }
    if(isValid) {
    document.getElementById("myForm").submit();
    }
}
</script>