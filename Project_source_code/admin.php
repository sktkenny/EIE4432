<?php

    if(!isset($_COOKIE['loginid']))
    {
        header('location:login.html');
    }
    else
    {
        include("database_connection.php");
        $tempnickname = $_COOKIE['loginid'];
        $icon = 'profileimg/admin.png';
    }

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>
            Admin
        </title>
        <link rel="stylesheet" href="login.css">
        <script src="https://kit.fontawesome.com/367681107c.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <header>
                    <button class="iconbk" onclick="window.location.href='admin.php'">
                        <?php
                            echo "<img class='icon' src=".$icon." atl=''>";
                            echo "<div class='icontext'>$tempnickname</div>";
                        ?>
                    </button>
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
                        Administrator
                    </div>
                </div>
                <div>
                    <table class="admintable">
                        <tr>
                            <td>
                            <div class="login">
                                    <button class="login" onclick="window.location.href='addproduct.php'">
                                        <i class="fas fa-plus-square"></i>
                                        Adding Product 
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="login">
                                    <button class="login" onclick="window.location.href='productstatus.php'">
                                        <i class="fas fa-box-open"></i>
                                        Product Status
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="login">
                                    <button class="login" onclick="window.location.href='updateproduct.php'">
                                        <i class="fas fa-pen-square"></i>
                                        Update Product
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="login">
                                    <button class="login" onclick="window.location.href='purchaserecord.php'">
                                        <i class="far fa-clipboard"></i>
                                        Purchase Record
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            @2021 Author: Kenny.  All Right Reserved.
        </footer>
    </body>
</html>