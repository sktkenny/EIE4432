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


        //for checking
        $check1 = false;
        $check2 = false;

        if(isset($_POST['submit']))
        {
            
            $productname = $_POST['productname'];
            $productprice = $_POST['productprice'];
            $productstock = $_POST['productstock'];

            $directory = "productimg/";

            if ($_FILES['productimg']['error'] === UPLOAD_ERR_OK)
            {
                $check1 = true;
            }

            $filename = basename($_FILES['productimg']['name']);
            $filepath = $directory.$filename;
            $filetype = pathinfo($filepath,PATHINFO_EXTENSION);

            if(move_uploaded_file($_FILES['productimg']['tmp_name'], $filepath));
            {
                $check2 = true;
            }

            if(!empty($productprice))
            {
                $updateproductdetail = "UPDATE product SET productprice = '$productprice' WHERE productname = '$productname'";
                echo '<script>alert("Update Product Price Successfully")</script>';
                mysqli_query($connect, $updateproductdetail);
            }
            else if(!empty($productstock))
            {
                $updateproductdetail = "UPDATE product SET productstock = '$productstock' WHERE productname = '$productname'";
                echo '<script>alert("Update Product Stock Successfully")</script>';
                mysqli_query($connect, $updateproductdetail);
            }
            else if(!empty($filename))
            {
                $updateproductdetail = "UPDATE product SET productimg = '$filename' WHERE productname = '$productname'";
                echo '<script>alert("Update Product Picture Successfully")</script>';
                mysqli_query($connect, $updateproductdetail);
            }
            else
            {
                $updateproductdetail = "UPDATE product SET productprice = '$productprice', productstock = '$productstock' ,productimg = '$filename' WHERE productname = '$productname'";
                echo '<script>alert("Update Product Detail Successfully")</script>';
                mysqli_query($connect, $updateproductdetail);
            }
            
            /* for checking
            if(mysqli_query($connect, $updateproductdetail) && ($check1 == $check2))
            {
                echo '<script>alert("Update Product Detail Successfully")</script>';
            }
            */
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        Update Product detail
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
            <div class="login-title">
                <div class="title-text">
                    Update Product Detail
                </div>
                <form action="updateproduct.php" method="post" enctype="multipart/form-data">
                    <table class="tablecontainer">
                        <tr>
                            <td>
                                <label for="productname" class="textinform"> Product Name:</label>
                            </td>
                            <td>
                                <input type="text" name="productname" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="productprice" class="textinform">Update Price:</label>
                            </td>
                            <td>
                                <input type="text" name="productprice">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="productstock" class="textinform">Update Stock:</label>
                            </td>
                            <td>
                                <input type="text" name="productstock">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="img" class="textinform">Update Product Image</label>
                            </td>
                            <td>
                                <input type="file" name="productimg">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="submit" class="loginbtnbk">Update Product</button>
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