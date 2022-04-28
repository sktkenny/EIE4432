<html>
    <head>
        <meta charset="utf-8">
        <title>
            Create Account
        </title>
        <link rel="stylesheet" href="login.css">
        <script src="https://kit.fontawesome.com/367681107c.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            //bulid connection
            include("database_connection.php");

			$check1 = false;
			$check2 = false;
            $check3 = false;
            
            if(isset($_POST['submit']))
            {
                $loginid = $_POST['loginid'];
                $nickname = $_POST['nickname'];
                $loginpw = $_POST['loginpw'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $date = date('Y-m-d', strtotime($_POST['birthday']));
                
                //profile upload directory
                $directory = "profileimg/";
                
                if ($_FILES['profileimg']['error'] === UPLOAD_ERR_OK)
                {
                    $check1 = true;
                }

                $filename = basename($_FILES['profileimg']['name']);
                $filepath = $directory.$filename;
                $filetype = pathinfo($filepath,PATHINFO_EXTENSION);

                $allowtypes = array('jpg','png','jpeg','gif','pdf');

                if(move_uploaded_file($_FILES['profileimg']['tmp_name'], $filepath));
                {
                    $check2 = true;
                }

                $insertdata = "INSERT INTO ac(loginid,nickname,loginpw,email,birthday,gender,profileimg) VALUES ('$loginid','$nickname','$loginpw','$email','$date','$gender','$filename')";
                $insertlogindata = "INSERT INTO loginac(loginid,loginpw) VALUES ('$loginid','$loginpw')";

                if(mysqli_query($connect,$insertdata) && mysqli_query($connect,$insertlogindata))
                {
				    $check3 = true;
                }

                if(($check1 == $check2) && ($check2 == $check3))
                {
                    echo '<script>alert("Congratulations!!! Your account has been created successfully. Please login"); window.location.href="login.html"</script>';
                }
            }

            mysqli_close($connect);
        ?>
    </body>
</html>