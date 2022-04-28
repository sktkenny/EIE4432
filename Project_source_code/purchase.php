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

        $check = false;

        if(isset($_POST['submit']))
        {
            $productname = $_POST['productname'];
            $productprice = $_POST['productprice'];
            $productquantity = $_POST['productquantity'];
            $cost = $productprice*$productquantity;

            //search the old stock quantity
            $searchproductstock = "SELECT productstock FROM product WHERE productname = '$productname'";
            $result0 = mysqli_query($connect,$searchproductstock);
            $row0 = mysqli_fetch_array($result0);
            $tempstock = $row0['productstock'];

            //record the purchase
            $insertpurchase = "INSERT INTO purchaserecord(loginid,productname,productstock,cost,nickname) VALUES ('".$_COOKIE['loginid']."','$productname','$productquantity','$cost','$tempnickname')";
            $result1 = mysqli_query($connect,$insertpurchase);
            
            //clear the cart
            $clearcart = "DELETE FROM cart WHERE loginid=".$_COOKIE['loginid']."";
            $result2 = mysqli_query($connect,$clearcart);

            //update product quantity
            $newstock = $tempstock - $productquantity;
            $updateproductstock = "UPDATE product SET productstock = '$newstock' WHERE productname = '$productname'";
            if(mysqli_query($connect,$updateproductstock))
            {
                $check = true;
            }

            if($check && ($result1 == $result2))
            {
                $clearcart = "DELETE FORM cart WHERE loginid=".$_COOKIE['loginid']."";
                mysqli_query($connect,$clearcart);
                echo '<script>alert("Purchase Success")</script>';
                echo '<script>window.location.href="product.php"</script>';
            }

        }
    }

?>