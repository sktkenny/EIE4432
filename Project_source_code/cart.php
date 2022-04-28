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
            Shopping Cart
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
                    <button class="login" onclick="window.location.href='product.php'">
                        <i class="fas fa-tshirt"></i>
                        Product
                    </button>
                </div>
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
                        Cart
                    </div>
                </div>
                <div class="product">
                    <?php
                        
                        if(isset($_POST['submit']))
                        {
                            $productname = $_POST['productname'];
                            $productprice = $_POST['productprice'];

                            $searchproductimg = "SELECT productimg FROM product WHERE productname = '$productname'";
                            $result = mysqli_query($connect,$searchproductimg);
                            $row = mysqli_fetch_array($result);
                            $cartimg = $row['productimg'];

                            $addtocart = "INSERT INTO cart(productname,productprice,loginid,productimg) VALUES ('$productname','$productprice','".$_COOKIE['loginid']."','$cartimg')";
                            $result2 = mysqli_query($connect,$addtocart);

                            /*test
                            if($result2)
                            {
                                echo "ok";
                            }
                            */

                            $showcart = "SELECT * FROM cart";
                            $result3 = mysqli_query($connect,$showcart);

                            if(mysqli_num_rows($result3) > 0)
                            {
                                $numberofrow = mysqli_num_rows($result3);
                                echo "<p class='producttitle'>There are ".$numberofrow." product in your cart.</p>";

                                echo "<form action='purchase.php' method='post'>";
                                echo "<table border='1' class='producttable'>";
                                echo "<tr>";
                                echo "<th>Picture</th>";
                                echo "<th>Prodcut Name</th>";
                                echo "<th>Price</th>";
                                echo "<th>Quantity</th>";
                                echo "</tr>";

                                while($row2 = mysqli_fetch_assoc($result3))
                                {
                                    echo "<tr>";
                                    $imgurl = 'productimg/'.$row2['productimg'];
                                    echo "<td><img class='productpicture' src=".$imgurl." atl=''></td>";
                                    echo "<td>".$row2['productname']."<br><input type='hidden' name='productname' value='".$row2['productname']."'></td>";
                                    echo "<td>"."$".$row2['productprice']."<br><input type='hidden' name='productprice' value='".$row2['productprice']."'</td>";
                                    echo "<td><input type='text' name='productquantity'></td>";
                                    //echo "<td>".$row['productstock']."</td>";
                                    echo "</tr>";
                                }
                                echo "<tr><td class='cartbuybtn'><button type'submit' name='submit' class='login'>Buy</button></td></tr>";
                                echo "</table>";
                                echo "</form>";
                            }
                            
                            
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