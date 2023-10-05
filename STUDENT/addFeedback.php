<?php
session_start();
$uid = $_SESSION['uid'];
$bid = $_REQUEST['id'];
include "studentHeader.php";
include "../DBConnection/dbconnection.php";
$qryCheck = "SELECT COUNT(*) AS cnt FROM `feedback` WHERE `booking_id`='$bid' AND `uid`='$uid'";
$qryOut = mysqli_query($conn, $qryCheck);
$fetchData = mysqli_fetch_array($qryOut);

if ($fetchData['cnt'] > 0) {
    echo "<script>alert('Feedback Already Added');window.location='viewBookings.php';</script>";
}
?>

<style>
    #table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 10px;
    }
</style>
<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Add Feedback</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Feedback</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<!--Start Contact Page-->
<section class="contact-page">
    <div class="container">

        <div class="contact-page__bottom">
            <div class="contact-page__bottom-pattern"
                style="background-image: url(../assets/images/pattern/contact-pattern.jpg);">
            </div>
            <div class="contact-page__bottom-inner">
                <form class="contact-page__form" method="post">
                    <div class="row">
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Title" name="title" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <textarea name="feedback" placeholder="Feedback" required></textarea>
                            </div>
                            <div class="contact-page__btn">
                                <button type="submit" name="addFeedback">
                                    <span class="thm-btn">Add</span>
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
if (isset($_REQUEST['addFeedback'])) {
    $Title = $_REQUEST['title'];
    $Feedback = $_REQUEST['feedback'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `feedback` WHERE `booking_id`='$bid' AND `uid`='$uid'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Student Already Exists');</script>";
    } else {
        $qryReg = "INSERT INTO `feedback`(`uid`,`booking_id`,`title`,`feedback`,`date`)VALUES('$uid','$bid','$Title','$Feedback',CURDATE())";
        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Feedback Added');window.location='viewBookings.php';</script>";
        } else {
            echo "<script>alert('Failed');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<?php
include "../COMMON/commonFooter.php";
?>