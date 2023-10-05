<?php
session_start();
$uid = $_SESSION['uid'];
include "staffHeader.php";
include "../DBConnection/dbconnection.php";
?>
<style>
    #table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 10px;
    }
    #img{
        height: 400px;
        width: 400px;
    }
</style>
<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>View Councellor</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Councellor</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<?php
$qry = "SELECT * FROM `councellor`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
    ?>
    <center>
        <h1 id="nodata" class="m-3">No Councellors Avaliable</h1>
    </center>
    <?php
} else {
    ?>

    <section class="team-one team-one--team">
        <div class="container">
            <div class="row">
                <!--Start Team One Single-->
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="team-one__single">
                            <div class="team-one__single-img">
                                <img src="../assets/image/<?php echo $row['image'] ?>" alt="#" id="img">
                            </div>
                            <div class="team-one__single-content">
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"
                                                style="color: 	#1877F2;"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"
                                                style="color: 	#1DA1F2;"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"
                                                style="color: 	#E60023;"></i></a></li>
                                </ul>
                                <div class="title-box text-center">
                                    <h2><a href="#">
                                            <?php echo $row['name'] ?>
                                        </a></h2>
                                    <p><?php echo $row['quali'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!--End Team One Single-->
            </div>
        </div>
    </section>
<?php } ?>



<?php
include "../COMMON/commonFooter.php";
?>