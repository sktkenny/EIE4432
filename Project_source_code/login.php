<?php

    //bulid connection
    include("database_connection.php");

    $check1 = false;
    $check2 = false;
    $check3 = false;

    //store login info
    $tempid = null;
    $temppw = null;

    if(isset($_POST['submit']))
    {
        
        $loginid = trim($_POST['loginid']);
        $loginpw = trim(($_POST['loginpw']));

        if(($loginid == 'admin') && ($loginpw == 'adminpass'))
        {
            $loginid = 'Admin';
            setcookie('loginid', $loginid, time() + 3600);
            setcookie('loginpw', $loginpw, time() + 3600);
            echo '<script>alert("Login as Admin")</script>';
            echo '<script>window.location.href="admin.php"</script>';
        }
        else
        {
            $searchloginid = "SELECT * FROM loginac WHERE loginid = '$loginid'";
            $result = mysqli_query($connect,$searchloginid);

            $row = mysqli_fetch_array($result);

            if($row > 0)
            {
                $tempid = $row['loginid'];
                $temppw = $row['loginpw'];

                if($temppw != $loginpw)
                {
                    echo '<script>alert("Wrong password")</script>';
                    echo '<script>window.location.href="login.html"</script>';
                }
                else
                {
                    setcookie('loginid', $tempid, time() + 86400);
                    setcookie('loginpw', $temppw, time() + 86400);
                    echo '<script>alert("Login Success")</script>';
                    echo '<script>window.location.href="main.php"</script>';
                }
            }
            else
            {
                echo '<script>alert("User does not exist")</script>';
                echo '<script>window.location.href="login.html"</script>';
            }

        }
        mysqli_free_result($result);
    }
    mysqli_close($connect);
?>