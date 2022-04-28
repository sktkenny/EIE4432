<?php

    //bulid connection
    include("database_connection.php");

    if(isset($_POST['submit']))
    {
        $loginid = $_POST['loginid'];
        $email = $_POST['email'];
        $loginpw = $_POST['loginpw'];
        $confirmpw = $_POST['confirmpw'];

        $searchloginid = "SELECT * FROM ac WHERE loginid = '$loginid'";

        $result = mysqli_query($connect,$searchloginid);

        $row = mysqli_fetch_array($result);

        if($row > 0)
        {
            $tempemail = $row['email'];
            if($tempemail != $email)
            {
                echo '<script>alert("Wrong email address")</script>';
                echo '<script>window.location.href="resetpw.html"</script>';
            }
            else if($loginpw != $confirmpw)
            {
                echo '<script>alert("The password is not the same! Please set it again!")</script>';
                echo '<script>window.location.href="resetpw.html"</script>';
            }
            else
            {
                $resetinac = "UPDATE ac SET loginpw = '$loginpw' WHERE loginid = '$loginid'";
                $resetinloginac = "UPDATE loginac SET loginpw = '$loginpw' WHERE loginid = '$loginid'";
                if(mysqli_query($connect,$resetinac) && mysqli_query($connect,$resetinloginac))
                {
                    echo '<script>alert("Password reset successfully")</script>';
                    echo '<script>window.location.href="login.html"</script>';
                }
            }
        }
        else
        {
            echo '<script>alert("User does not exist")</script>';
            echo '<script>window.location.href="resetpw.html"</script>';
        }
    }
?>
