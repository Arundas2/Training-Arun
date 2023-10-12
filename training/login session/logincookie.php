<!DOCTYPE html>
<html>
    <body>

        <?php
        session_start();

        $conn = mysqli_connect("localhost","root","ceymox123","DB");
        if (!$conn) {
            die("Connection failed:".mysqli_connect_error());
        }

        if($_SERVER['REQUEST_METHOD']=='POST') {
            $username=$_POST['username'];
            $password=$_POST['password'];

            $check = "SELECT * FROM login WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $check);
            
                $row=mysqli_fetch_assoc($result);
                $check_username = $row['username'];
                $check_password = $row['password'];

                if($username== $check_username && $password== $check_password) {
                    setcookie('username',$username,time()+60,'/');
                    header('Location:login1.php');
                } else {
                    echo"invalid username or password.<br><a href='login.html'>Try again</a>";
                }
            
        }
        ?>
    </body>
</html>