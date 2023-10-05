<?php
// session_destroy();
session_start();
include "commonHeader.php";
include '../DBConnection/dbconnection.php';
?>


<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Login</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<!--Start Contact Page-->
<section class="contact-page">
    <div class="container">
        <div class="contact-page__top">
            <center>
                <p class="mb-2" style="color: red;font-weight: bold;">WELCOME BACK</p>
                <h2 class="mb-3" style="font-weight: bolder;">Sign In Now</h2>
            </center>
        </div>

        <div class="contact-page__bottom">
            <div class="contact-page__bottom-pattern" style="background-image: url(../assets/images/pattern/contact-pattern.jpg);"> </div>
            <div class="contact-page__bottom-inner">
                <form class="contact-page__form" method="post">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="email" placeholder="Email address" name="email">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="password" placeholder="Password" name="password">
                                <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__btn">
                                <button type="submit" name="login">
                                    <span class="thm-btn">Login</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Contact Page-->

<?php
if (isset($_REQUEST['login'])) {
    $Email = $_REQUEST['email'];
    $Password = $_REQUEST['password'];

    $qry = "SELECT * FROM `login` WHERE `email`='$Email' AND `password`='$Password'";
    $result = mysqli_query($conn, $qry);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $uid = $data['reg_id'];
        $type = $data['usertype'];
        $status = $data['status'];
        $_SESSION['uid'] = $uid;
        $_SESSION['type'] = $type;
        if ($status == 'Approved') {
            if ($type == 'Admin') {
                echo "<script>alert('Login Success');window.location='../ADMIN/adminHome.php'</script>";
            } elseif ($type == 'Student') {
                echo "<script>alert('Login Success'); window.location='../STUDENT/studentHome.php'</script>";
            } elseif ($type == 'Staff') {
                echo "<script>alert('Login Success');window.location='../STAFF/staffHome.php'</script>";
            } elseif ($type == 'Councellor') {
                echo "<script>alert('Login Success');window.location='../COUNCELLOR/councellorHome.php'</script>";
            }
        } else {
            echo "<script>alert('You are Not Approved');</script>";
        }
    } else {
        echo "<script>alert('Invalid Email / Password');</script>";
    }
}
?>

<?php
include "commonFooter.php";
?>