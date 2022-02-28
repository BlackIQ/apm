<?php

// ----- Application Configurations & User Configurations

// Starting sessions
session_start();

// Config file
include('../config/config.php');

// Check if user is logged in or not
if ($_SESSION['status'] == true) {
    $user_id = $_SESSION['user_id'];
    $current_id = $_SESSION['user_id'];
    $_USER = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `id` = '$user_id'"));
}

// ----- Date & TIme -----

// Add timezone
date_default_timezone_set('Asia/Tehran');

// Add convertor
function gregorian_to_jalali($g_y, $g_m, $g_d)
{
	$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

    function div($a, $b) {
        return $a / $b;
    }
	// $div = create_function('$a,$b','return (int) ($a / $b);');

	$gy = $g_y-1600;
	$gm = $g_m-1;
	$gd = $g_d-1;

	$g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400);

	for ($i=0; $i < $gm; ++$i)
	$g_day_no += $g_days_in_month[$i];
	if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
	/* leap and after Feb */
	$g_day_no++;
	$g_day_no += $gd;

	$j_day_no = $g_day_no-79;

	$j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
	$j_day_no = $j_day_no % 12053;

	$jy = 979+33*$j_np+4*div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

	$j_day_no %= 1461;

	if ($j_day_no >= 366) {
	$jy += div($j_day_no-1, 365);
	$j_day_no = ($j_day_no-1)%365;
	}

	for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
	$j_day_no -= $j_days_in_month[$i];
	$jm = $i+1;
	$jd = $j_day_no+1;

	return array($jy, $jm, $jd);
}

// ----- Functions & Arrays -----

// Errors array
$errors = array();

// Return random string
function createRandId()
{
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randID = '';
    for ($i = 0; $i < 10; $i++) {
        $randID .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randID;
}

// Get name method
function getName($uid)
{
    $connectionX = mysqli_connect('server', 'username', 'password', 'database');
    $user = mysqli_fetch_assoc(mysqli_query($connectionX, "SELECT * FROM `users` WHERE `id` = '$uid'"));
    return $user['name'];
}

// ----- Account -----

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:' . $path);
}

// Login user
if (isset($_POST['login_user'])) {
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    if (empty($phone)) array_push($errors, 'شماره همراه را وارد کنید.');
    if (empty($password)) array_push($errors, 'رمز را وارد کنید.');

    if (count($errors) == 0) {
        $cpass = md5($password);
        
        if (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `users` WHERE `phone` = '$phone' AND `password` = '$cpass'")) == 1) {
            $user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `phone` = '$phone' AND `password` = '$cpass'"));
            $_SESSION['status'] = true;
            $_SESSION['user_id'] = $user['id'];
            header('location:' . $path . '/admin');
        } else array_push($errors, 'نام کاربری و رمز صحیح نمیباشند');
    }
}

// Register user
if (isset($_POST['create_user'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $admin = mysqli_real_escape_string($connection, $_POST['admin']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm = mysqli_real_escape_string($connection, $_POST['confirm']);

    if (empty($name)) array_push($errors, 'نام را وارد کنید.');
    if (empty($phone)) array_push($errors, 'شماره همراه را وارد کنید.');
    if (empty($admin)) array_push($errors, 'مدیر را انتخاب کنید.');
    if (empty($password)) array_push($errors, 'رمز را وارد کنید.');
    if (empty($confirm)) array_push($errors, 'تایید رمز را وارد کنید.');

    if (count($errors) == 0) {
        if ($password == $confirm) {
            $crypted_password = md5($password);
            $id = createRandId();
            if (mysqli_query($connection, "INSERT INTO `users` (`id`, `name`, `phone`, `password`, `admin`, `type`, `status`) VALUES ('$id', '$name', '$phone', '$crypted_password', '$admin', 'user', 'pending')")) {
                if (mysqli_query($connection, "INSERT INTO `notifications` (`id`, `user`, `title`, `status`) VALUES ('$notif_id', '$user_id', 'درخواست ثبت نام برای $name', 'unread')")) header('location:' . $path . '/admin');
                else array_push($errors, mysqli_errno($connection));
            }
            else {
                array_push($errors, mysqli_error($connection));
            }
        } else array_push($errors, 'رمز ها با هم متابقت ندارند');
    }
}

// Change password
if (isset($_POST['change_password'])) {
    $userid = mysqli_real_escape_string($connection, $_POST['change_password']);
    $new = mysqli_real_escape_string($connection, $_POST['new']);
    $confirm = mysqli_real_escape_string($connection, $_POST['confirm']);

    if (empty($new)) array_push($errors, 'رمز را وارد کنید.');
    if (empty($confirm)) array_push($errors, 'تکرار رمز را وارد کنید.');

    if (count($errors) == 0) {
        if ($new == $confirm) {
            $cnew = md5($new);
            if (mysqli_query($connection, "UPDATE users SET `password` = '$cnew' WHERE id = '$userid'")) array_push($not_errors, 'رمز شما با موفقیت تغییر کرد');
            else array_push($errors, mysqli_error($connection));
        } else array_push($errors, 'رمز ها با هم متابقت ندارند');
    }
}