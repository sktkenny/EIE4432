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

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>
            Product Status
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
                        Product Status
                    </div>
                </div>
                    <div class="showproductform">
                        <form action="" method="post">
                            <button type="submit" name="submit" class="showstatusbtnbk">
                                <i class="fas fa-eye"></i>
                                Show Product Status
                            </button>
                        </form>
                        <?php

                            //bulid connection
                            include("database_connection.php");

                            if(isset($_POST['submit']))
                            {
                                $showproductstatus = "SELECT * FROM product";
                                $result = mysqli_query($connect,$showproductstatus);

                                if(!$result)
                                {
                                    die("There is problem.");
                                }
                                
                                if(mysqli_num_rows($result) > 0)
                                {
                                    $numberofrow = mysqli_num_rows($result);
                                    echo "<p class='producttitle'>There are ".$numberofrow." product in the shop.</p>";

                                    echo "<table border='1' class='producttable'>";
                                    echo "<tr>";
                                    echo "<th>Prodcut Name</th>";
                                    echo "<th>Price</th>";
                                    echo "<th>Stock</th>";
                                    echo "<th>Picture</th>";
                                    echo "</tr>";

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['productname']."</td>";
                                        echo "<td>"."$".$row['productprice']."</td>";
                                        echo "<td>".$row['productstock']."</td>";
                                        $imgurl = 'productimg/'.$row['productimg'];
                                        echo "<td><img class='productpicture' src=".$imgurl." atl=''></td>";
                                        echo "</tr>";
                                    }

                                    echo "</table>";
                                }
                                else
                                {
                                    echo "There is no product in the shop.";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        @2021 Author: Kenny.  All Right Reserved.
    </footer>

