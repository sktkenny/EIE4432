<?php

    if(!isset($_COOKIE['loginid']))
    {
        header('location:login.html');
    }
    else
    {
        include("database_connection.php");
        
        $searchloginid = "SELECT * FROM ac WHERE loginid = ".$_COOKIE['loginid']."";
        $result = mysqli_query($connect,$searchloginid);
        $row = mysqli_fetch_array($result);
        $tempnickname = $row['nickname'];
        $icon = 'profileimg/'.$row['profileimg'];
    }

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        Kenny's Online Shop
    </title>
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/367681107c.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <header>
                <button class="iconbk" onclick="window.location.href='main.php'">
                    <?php
                        echo "<img class='icon' src=".$icon." atl=''>";
                        echo "<div class='icontext'>$tempnickname</div>";
                    ?>
                </button>
                <div class="login">
                    <button class="login" onclick="window.location.href='updateacinfo.php'">
                        <i class="fas fa-user-edit"></i>
                        Update Personal Info
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
            <div class="titleother">
                <div class="title-text">
                    Welcome to My Shop,
                    <?php
                        echo ''.$tempnickname.'';
                    ?>
                    !<br>
                </div>
                <div class="createactext">
                    Click the picture to know more product!
                </div>
            </div>
            <div class="mainbk">
                <a href="product.php">
                    <img class="mainbkimg" src="https://localhost/web/Project/productimg/people.jpg" alt="people">
                </a>
            </div>
        </div>
    </div>
    <footer>
        @2021 Author: Kenny.  All Right Reserved.
    </footer>
</body>