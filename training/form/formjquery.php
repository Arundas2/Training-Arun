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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
        .submit{
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
    <div id="f1"></div>
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
        <span id="emailError" class="error"></span>
        Phone Number:
        <input type="text" id="phone" name="phone" required><br><br>
        <span id="phoneError" class="error"></span><br>
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
    
    var fname=$("#fname").val();
    var lname=$("#lname").val();
    var address=$("#address").val();
    var email=$("#email").val();
    var phone=$("#phone").val();

    check=0;

    $("#fnameError").text("");
    $("lnameError").text("");
    $("adressError").text("");
    $("#emailError").text("");
    $("#phoneError").text("");

    var namePattern = /^[a-zA-Z ]{3,30}$/;
    var phonePattern = /^[7-9][0-9]{9}$/;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(fname ==""||lname ==""||address ==""|| phone==""||email =="") {
        check = 1;
        $("#enterform").text("enter all fields");
    }
    if(!namePattern.test(fname)||fname.length<3) {
        check = 1;
        $("#fnameError").text("name should conatian only letters and minimum 3 letters ");
    }
    if (address.length > 100) {
        check = 1;
        $("#addressError").text("address should conatain only 100 letters");
    }

    if(!phonePattern.test(phone)) {
        check = 1;
        $("#phoneError").text("invalid phone number");
    }
    if(!emailPattern.test(email)) {
        $("#emailError").text("enter valid email");
    }
    if(check == 1) {
        return false;
    }
                
    document.getElementById("myForm").submit();
}

</script>