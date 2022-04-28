<?php
    
    //bulid connection
    include("database_connection.php");

    //for checking
    $check1 = false;
    $check2 = false;

    $tempnickname = $_COOKIE['loginid'];
    $icon = 'profileimg/admin.png';

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

        $insertproduct = "INSERT INTO product(productname,productprice,productstock,productimg) VALUES ('$productname','$productprice','$productstock','$filename')";

        if(mysqli_query($connect,$insertproduct))
        {
            $check3 = true;
        }

        if(($check1 == $check2) && ($check2 == $check3))
        {
            echo '<script>alert("Product Add Successfully")</script>';
        }
    }
    mysqli_close($connect);
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>
        Add Product
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
                    Add Product
                </div>
                <form action="addproduct.php" method="post" enctype="multipart/form-data">
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
                                <label for="productprice" class="textinform">Set Price:</label>
                            </td>
                            <td>
                                <input type="text" name="productprice" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="productstock" class="textinform">Stock:</label>
                            </td>
                            <td>
                                <input type="text" name="productstock" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="img" class="textinform">Product Image</label>
                            </td>
                            <td>
                                <input type="file" name="productimg">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" name="submit" class="loginbtnbk">Add Product</button>
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