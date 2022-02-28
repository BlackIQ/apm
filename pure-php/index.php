<?php

include('resources/config/config.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>صفحه اصلی</title>
    <script src="https://kit.fontawesome.com/4a679d8ec0.js" crossorigin="anonymous"></script>
    <link href="resources/sass/main.css" type="text/css" rel="stylesheet">
    <link href="resources/css/mdb.min.css" type="text/css" rel="stylesheet">
</head>
<body class="body">
<nav class="nnav navbar navbar-expand-lg fixed-top navbar-light bg-blur">
    <div class="container-fluid">
        <a class="navbar-brand text-main" href=".">نام پروژه</a>
        <button class="navbar-toggler text-main text-main" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active"href=".">خانه</a>
                </li>
            </ul>
            <div class="me-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="client" class="nav-link active">ورود به پنل</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link"></span>
                    </li>
                    <li class="nav-item">
                        <h4><i class="nav-link theme-changer pointer fa"></i></h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="footer">
    <?php include('resources/widgets/footer.php'); ?>
</div>
<div class="under-footer">
    <?php include('resources/widgets/under-footer.php'); ?>
</div>
<script src="resources/js/jquery-3.6.0.min.js"></script>
<script src="resources/js/script.js"></script>
<script src="resources/js/mdb.min.js"></script>
</body>
</html>