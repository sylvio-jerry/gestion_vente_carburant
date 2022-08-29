<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Sweet</title>
</head>
<body>
<script src="js/jquery-3.4.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script> -->
<script src="js/sweetlover.js"></script>
    <?php 
        if(isset($_SESSION['status']) &&  $_SESSION['status']!='')
        {
        ?>
            <Script>
                swal({
                    title: "<?php echo $_SESSION['status']; ?>",
                    icon: "<?php echo $_SESSION['status_code']; ?>",
                    button: "Okay",
                });
            </Script>
         <?php
         unset($_SESSION['status']);
        }

    ?>
</body>


</html>