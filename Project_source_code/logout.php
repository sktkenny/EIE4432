<?php

    setcookie('loginid', "", time()-3600);
    setcookie('loginpw', "", time()-3600);
    header("location:login.html");

?>