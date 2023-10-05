<?php
session_start();
$uid = $_SESSION['uid'];
$pid = $_REQUEST['id'];
include "studentHeader.php";

include "../DBConnection/dbconnection.php";
?>
<style>
    h1 {
        text-align: center;
        font-family: Tahoma, Arial, sans-serif;
        color: #06D85F;
        margin: 80px 0;
    }

    .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
    }

    .button {
        font-size: 1em;
        padding: 10px;
        color: #fff;
        border: 2px solid #06D85F;
        border-radius: 20px/50px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-out;
    }

    .button:hover {
        background: #06D85F;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 1;

    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }


    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
        z-index: 1;
    }

    .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
    }

    .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }

    .popup .close:hover {
        color: #06D85F;
    }

    .popup .content {
        max-height: 30%;
        overflow: auto;
    }

    @media screen and (max-width: 700px) {
        .box {
            width: 70%;
        }

        .popup {
            width: 70%;
        }
    }
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Book Now</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Booking</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->
<?php
$qry = "SELECT `programme`.*,`councellor`.* FROM `programme`,`councellor` WHERE `councellor`.`cid`=`programme`.`cid` AND `programme`.`pid`='$pid'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
?>
<!--Start Testimonial One-->
<section class="testimonial-one testimonial-one--two">
    <center>
        <div class="container m-3">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testimonial-one__inner">
                        <div class="testimonial-carousel__one owl-theme owl-carousel">
                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__slide testimonial-one__single">
                                <h1>
                                    <b>
                                        <?php echo $row['programme_name'] ?>
                                    </b>
                                </h1>
                                <p class="testimonial-one__single-text">
                                    <?php echo $row['description'] ?>
                                </p>
                                <div class="testimonial-one__client-info">
                                    <div class="testimonial-one__client-details">
                                        <div class="testimonial-one__client-img">
                                            <img src="../assets/image/<?php echo $row['image'] ?>" alt="#">
                                        </div>
                                        <div class="testimonial-one__client-content">
                                            <h4>
                                                <?php echo $row['name'] ?>
                                            </h4>
                                            <p>
                                                <?php echo $row['quali'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="testimonial-one__quote">
                                        <span class="icon-quote"></span>
                                    </div> -->
                                </div>
                                <br>
                                <div class="box" style="margin: 0;padding: 0;">
                                    <a class="btn btn-outline-success" href="#popup1" style="width: 120px;">Select
                                        Mode</a>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->
                        </div>
                        <div id="popup1" class="overlay" style="margin-top: 110px;">
                            <div class="popup">
                                <h2>Hello
                                    <?php echo $row['name'] ?>
                                </h2>
                                <a class="close" href="#">&times;</a>
                                <div class="content">
                                    We're excited to have you join our counseling sessions! To ensure your convenience,
                                    please let us know your preferred class format: <br>
                                    1.Online Counseling: Attend sessions virtually from anywhere. Flexible and
                                    interactive. <br>
                                    2.Offline Counseling: Join us in person for face-to-face discussions.
                                    <br>
                                    <form method="post" class="mt-3">
                                        <input type="radio" id="online" value="Online" name="mode" required>
                                        <label for="online" style="color: red;">Online</label>
                                        <input type="radio" id="offline" value="Offline" name="mode" required>
                                        <label for="offline" style="color: red;">Offline</label><br>
                                        <input type="submit" value="Confirm" class="btn btn-primary mt-3"
                                            name="bookProgram">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</section>


<?php
if (isset($_REQUEST['bookProgram'])) {
    $Mode = $_REQUEST['mode'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `booking` WHERE `pid`='$pid' AND `sid`='$uid' AND `status`='Booked'";

    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Programme Already Booked');</script>";
    } else {
        $qryReg = "INSERT INTO `booking`(`pid`,`sid`,`mode`)VALUES('$pid','$uid','$Mode')";
        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Booking Successful');window.location='viewBookings.php';</script>";
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