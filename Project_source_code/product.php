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
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Product
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
                        Product
                    </div>
                </div>
                <div class="product">
                    <?php
                        $producttable = "SELECT * FROM  product";
                        $result = mysqli_query($connect,$producttable);

                        if(!$result)
                        {
                            die("Could not run query1.");
                        }

                        if(mysqli_num_rows($result) > 0)
                        {
                            $numberofrow = mysqli_num_rows($result);
                            echo "<table class='tableproduct'>";
                            echo "<tbody>";

                            for($x = 0; $x < $numberofrow; $x++)
                            {
                                $row = mysqli_fetch_assoc($result);
                                if(is_int($x/4))
                                {
                                    echo "<tr>";
                                }
                                echo "<td class='productcol'>";
                                echo "<div class='productimg'>";
                                $imgurl = 'productimg/'.$row['productimg'];
                                echo "<img class='productimgsize' src=".$imgurl." alt='product'.".$row['productname']."'>";
                                echo "</div>";
                                echo "<div class='productdescri'>";
                                echo "<div class='textinproduct'>";
                                echo $row['productname'];
                                echo "</div>";
                                echo "<br>";
                                echo "<div class='textinproduct'>";
                                echo "HKD: $".$row['productprice'];
                                echo "</div>";
                                echo "<br>";
                                echo "<div class='textinproduct'>";
                                echo "Stock :".$row['productstock'];
                                echo "</div>";
                                echo "<br>";
                                if($row['productstock'] > 0)
                                {
                                    echo "<form action='cart.php' method='post'>";
                                    echo "<input type='hidden' name='productname' value='".$row['productname']."'>";
                                    echo "<input type='hidden' name='productprice' value='".$row['productprice']."'>";
                                    echo "<button class='buybtn' type='submit' name='submit'>";
                                    echo "<i class='fas fa-cart-plus' id='cartlogo'></i>";
                                    echo "Add To Cart";
                                    echo "</button>";
                                    echo "</form>";
                                }
                                else
                                {
                                    echo "<div class='disbuybtn'>";
                                    echo "<i class='fas fa-cart-plus' id='cartlogo'></i>";
                                    echo "Add To Cart";
                                    echo "</div>";
                                }
                                
                                echo "</td>";
                                if(is_int(($x-3)/4))
                                {
                                    echo "</tr>";
                                }
                            }

                            echo "</tbody>";
                            echo "</table>";
                        }
                        else
                        {
                            echo "<div class='producttitle'>";
                            echo "Sorry, no product in the shop";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <footer>
            @2021 Author: Kenny.  All Right Reserved.
        </footer>
    </body>
</html>