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
                            <table class='producttable'>
                                <tr>
                                    <td>
                                        Search customer purchase record by ID:
                                    </td>
                                    <td>
                                        <input type="text" name="customerID" placeholder="Input customer ID...">
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" name="submitID" class="showstatusbtnbk">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                            <button type="submit" name="submit" class="showstatusbtnbk">
                                <i class="fas fa-eye"></i>
                                Show All Record
                            </button>
                        </form>
                        <?php

                            //bulid connection
                            include("database_connection.php");

                            if(isset($_POST['submitID']))
                            {
                                $tempid = $_POST['customerID'];
                                $searchbycustomerID = "SELECT * FROM purchaserecord WHERE loginid = '$tempid'";
                                $result = mysqli_query($connect,$searchbycustomerID);

                                if(!$result)
                                {
                                    die("There is problem.");
                                }
                                
                                if(mysqli_num_rows($result) > 0)
                                {
                                    $numberofrow = mysqli_num_rows($result);
                                    echo "<p class='producttitle'>There are ".$numberofrow." purchase record of customer.</p>";

                                    echo "<table border='1' class='producttable'>";
                                    echo "<tr>";
                                    echo "<th>Customer ID</th>";
                                    echo "<th>Prodcut Name</th>";
                                    echo "<th>Quantity</th>";
                                    echo "<th>Total Cost</th>";
                                    echo "</tr>";

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['loginid']."</td>";
                                        echo "<td>".$row['productname']."</td>";
                                        echo "<td>".$row['productstock']."</td>";
                                        echo "<td>".$row['cost']."</td>";
                                        echo "</tr>";
                                    }

                                    echo "</table>";
                                }
                                else
                                {
                                    echo "There is no purchase record.";
                                }
                            }

                            if(isset($_POST['submit']))
                            {
                                $searchall = "SELECT * FROM purchaserecord ORDER BY nickname";
                                $result = mysqli_query($connect,$searchall);
                               
                                //check connect of the table
                                if(!$result)
                                {
                                    die("Could not run query1.");
                                }

                                if(mysqli_num_rows($result) > 0)
                                {
                                    $numberofrows = mysqli_num_rows($result);
				                    echo "<p class='producttitle'>"."There are ".$numberofrows." of purchase record"."</p>";

                                    echo "<table border='1' class='producttable'>";
                                    echo "<tr>";
                                    echo "<th>Customer Nickname</th>";
                                    echo "<th>Customer ID</th>";
                                    echo "<th>Prodcut Name</th>";
                                    echo "<th>Quantity</th>";
                                    echo "<th>Total Cost</th>";
                                    echo "</tr>";

                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['nickname']."</td>";
                                        echo "<td>".$row['loginid']."</td>";
                                        echo "<td>".$row['productname']."</td>";
                                        echo "<td>".$row['productstock']."</td>";
                                        echo "<td>".$row['cost']."</td>";
                                        echo "</tr>";
                                    }
                                    
                                    echo "</table>";
                                }
                                else
                                {
                                    echo "There is no record were found.";
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
