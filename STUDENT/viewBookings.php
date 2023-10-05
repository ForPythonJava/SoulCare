<?php
session_start();
$uid = $_SESSION['uid'];
include "studentHeader.php";
include "../DBConnection/dbconnection.php";
?>

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
$qry = "SELECT `programme`.*,`councellor`.*,`booking`.* FROM `programme`,`councellor`,`booking` WHERE `councellor`.`cid`=`programme`.`cid` AND `programme`.`pid`=`booking`.`pid` AND `booking`.`sid`='$uid' AND `booking`.`status`='Booked'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Bookings Yet</h1>
    </center>
<?php
} else {
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
                                                    &nbsp;&nbsp;
                                                    <?php echo $row['quali'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- <div class="testimonial-one__quote">
                                        <span class="icon-quote"></span>
                                    </div> -->
                                    </div>
                                    <br>
                                    <?php
                                    $cdate = date('Y-m-d');
                                    if ($row['date'] < $cdate) {
                                    ?>
                                        <div class="box" style="margin: 0;padding: 0;">
                                            <a class="btn btn-outline-success" href="addFeedback.php?id=<?php echo $row['booking_id'] ?>" style="width: 140px;">Add
                                                Feedback</a>
                                        </div>
                                    <?php
                                    } else {
                                        $status = $row['status'];
                                        echo "<h2 style='font-weight:bold;' class='btn btn-outline-danger'>$status</h2>";
                                    }
                                    ?>
                                </div>
                                <!--End Testimonial One Single-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </section>
<?php } ?>


<?php
include "../COMMON/commonFooter.php";
?>