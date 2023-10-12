<?php
$conn = mysqli_connect("localhost","root","ceymox123","DB");

if (!$conn) {
    die("Connection failed:".mysqli_connect_error());
}

if(isset($_GET['id'])) {
    $del_id=$_GET['id'];

    $sql="DELETE FROM demo WHERE id=$del_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('deleted successfully')</script>";
    } else {
        echo "Error deleting record:".mysqli_error($conn);
    }
}
?>