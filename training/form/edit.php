<?php

$conn = mysqli_connect("localhost","root","ceymox123","DB");

if (!$conn) {
    die("Connection failed:".mysqli_connect_error());
}

if(isset($_POST['edit'])) {
    $edit = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "UPDATE demo SET fname='$fname', lname='$lname', gender='$gender', address='$address', email='$email', phone='$phone' WHERE id=$edit";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New records updated successfully')</script>";
    } else {
        echo "Error updating rocord:".mysqli_error($conn);
    }
}

if(isset($_GET['id'])) {
    $edit = $_GET['id'];
    $sql="SELECT * FROM demo WHERE id=$edit";
    $result= mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0) {
        while($row=mysqli_fetch_assoc($result)) {
            $edit=$_GET['id'];
            $fname=$row['fname'];
            $lname=$row['lname'];
            $gender=$row['gender'];
            $address=$row['address'];
            $email=$row['email'];
            $phone=$row['phone'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>update form</title>
    <style>
        h1 {
            text-align:center;
            color:red;
        }
        form {
            width:300px;
            margin:0 auto;
            border:2px solid;
            padding :12px 20px;
        }
    </style>
</head>
<body>
    <h1>User Update Form</h1>
    <form method="post">
        First Name:
        <input type="text" name="fname" value="<?php echo $fname;?>"><br><br>
        <input type="hidden" name="id" value="<?php echo $edit;?>">
        Last Name:
        <input type="text" name="lname" value="<?php echo $lname;?>"><br><br>
        Gender:<br>
        <input type="radio" name="gender" value="male" <?php if($gender=='male'){ echo "checked";}?> >Male<br>
        <input type="radio" name="gender" value="Female" <?php if($gender=='Female'){ echo "checked";}?>>Female<br><br>
        Address:<br>
        <textarea cols="20" rows="6" id="address" name="address"></textarea><br><br>
        Email:
        <input type="email" name="email" value="<?php echo $email;?>"><br><br>
        Phone Number:
        <input type="text" name="phone" value="<?php echo $phone;?>"><br><br>
        <input type="submit" value="edit" name="edit">
        </form> 
</body>
</html>
