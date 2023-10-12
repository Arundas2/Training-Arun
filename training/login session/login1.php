<!DOCTYPE html>
<html>
    <body>
        <?php
        session_start();
        $name=$_SESSION['username'];
        echo"<strong>welcome</strong>"."<br>";
        echo"$name";
        //echo $_COOKIE['username'];
        ?>
        <br><a href='logout.php'>Logout</a>
    </body>
<html>