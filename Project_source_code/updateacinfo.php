<?php

    if(!isset($_COOKIE['loginid']))
    {
        header('location:login.html');
    }
    else
    {
        //bulid connection
        include("database_connection.php");

        //for checking
        $check1 = false;
        $check2 = false;
        
        $searchloginid = "SELECT * FROM ac WHERE loginid = ".$_COOKIE['loginid']."";
        $result = mysqli_query($connect,$searchloginid);
        $row = mysqli_fetch_array($result);
        $tempnickname = $row['nickname'];
        $icon = 'profileimg/'.$row['profileimg'];

        if(isset($_POST['submit']))
        {
            //$loginid = $_POST['loginid'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];

            $directory = "profileimg/";

            if ($_FILES['profileimg']['error'] === UPLOAD_ERR_OK)
            {
                $check1 = true;
            }

            $filename = basename($_FILES['profileimg']['name']);
            $filepath = $directory.$filename;
            $filetype = pathinfo($filepath,PATHINFO_EXTENSION);

            if(move_uploaded_file($_FILES['profileimg']['tmp_name'], $filepath));
            {
                $check2 = true;
            }

            $updateacinfo = "UPDATE ac SET nickname = '$nickname', email = '$email', profileimg = '$filename' WHERE loginid = '".$_COOKIE['loginid']."'";
            if(mysqli_query($connect,$updateacinfo) && ($check1 == $check2))
            {
                echo '<script>alert("Update Personal Information Successfully")</script>';
                echo '<script>window.location.href="main.php"</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Update account information
        </title>
        <link rel="stylesheet" href="login.css">
        <script src="https://kit.fontawesome.com/367681107c.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <header>
                <div class="iconbk">
                    <?php
                        echo "<img class='icon' src=".$icon." atl=''>";
                        echo "<div class='icontext'>$tempnickname</div>";
                    ?>
                </div>
                <div class="login">
                    <button class="login" onclick="window.location.href='main.php'">
                        <i class="fas fa-home"></i>
                        Home
                    </button>
                    </div>
                <div class="login">
                    <button class="login" onclick="window.location.href='logout.php'">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </header>
            <div class="content">
                <div class="login-title">
                    <div class="title-text">
                        Update Your Personal Information
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="tablecontainer">
                            <!--
                                <tr>
                                    <td>
                                        <label for="loginid" class="textinform"> Login ID:</label>
                                    </td>
                                    <td>
                                        <input type="text" name="loginid" required>
                                    </td>
                                </tr>
                            -->
                            <tr>
                                <td>
                                    <label for="nickname" class="textinform">Nick Name:</label>
                                </td>
                                <td>
                                    <input type="text" name="nickname" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" class="textinform">Email:</label>
                                </td>
                                <td>
                                    <input type="text" name="email" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="img" class="textinform">Profile Image</label>
                                </td>
                                <td>
                                    <input type="file" name="profileimg">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" name="submit" class="loginbtnbk">Update</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <footer>
            @2021 Author: Kenny.  All Right Reserved.
        </footer>
    </body>
</html>