<?php
session_start();
$uid = $_SESSION['uid'];
$cid = $_GET['cid'];
include "studentHeader.php";
include "../DBConnection/dbconnection.php";
?>

<style>
    input[type="date"],
    input[type="time"] {
        color: rgba(48, 42, 39, 0.7);
        font-size: 15px;
        font-weight: 400;
        width: 100%;
        height: 60px;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 0 20px;
        margin-bottom: 30px;
        border-radius: 0px;
        outline: none;
        transition: all 200ms linear;
        transition-delay: 0.1s;
    }
</style>

<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Select Schedule</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Schedule</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<section class="contact-page">
    <div class="container">
        <div class="contact-page__top">
            <center>
                <p class="mb-2" style="color: red;font-weight: bold;">Select Schedule</p>
                <h2 class="mb-3" style="font-weight: bolder;">Select Your Preferred Schedule</h2>
            </center>
        </div>
        <div class="contact-page__bottom">
            <div class="contact-page__bottom-pattern" style="background-image: url(../assets/images/pattern/contact-pattern.jpg);"> </div>
            <div class="contact-page__bottom-inner">
                <form class="contact-page__form" method="post">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" min="<?php echo date('Y-m-d') ?>" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Select Date" name="date">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Select Time" name="time">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__btn">
                                <button type="submit" name="confirm">
                                    <span class="thm-btn">Confirm Booking</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php
if (isset($_REQUEST['confirm'])) {
    $Date = $_REQUEST['date'];
    $Time = $_REQUEST['time'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `individual_booking` WHERE `sid`='$uid' AND `date`='$Date'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Already Booked');</script>";
    } else {
        $qryReg = "INSERT INTO `individual_booking`(`cid`,`sid`,`date`,`time`)VALUES('$cid','$uid','$Date','$Time')";
        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Booked');window.location='studViewCouncellor.php';</script>";
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