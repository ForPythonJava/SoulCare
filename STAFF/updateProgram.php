<?php
session_start();
$uid = $_SESSION['uid'];
$pid = $_REQUEST['id'];
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
</style>
<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Update Programme</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Programme</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<?php
$qry = "SELECT `programme`.*,`councellor`.* FROM `programme`,`councellor` WHERE `programme`.`sid`='$uid' AND `councellor`.`cid`=`programme`.`cid` AND `programme`.`pid`='$pid'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
$name = $row['name'];

?>

<!--Start Contact Page-->
<section class="contact-page">
    <div class="container">
        <div class="contact-page__bottom">
            <div class="contact-page__bottom-pattern" style="background-image: url(../assets/images/pattern/contact-pattern.jpg);">
            </div>
            <div class="contact-page__bottom-inner">
                <form class="contact-page__form" method="post">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Name of Event" name="name" value="<?php echo $row['programme_name'] ?>" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" min="<?php echo date('Y-m-d') ?>" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Date" name="date" id="select" value="<?php echo $row['date'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Time" value="<?php echo $row[6] ?>" name="time" id="select" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <select name="councellor" id="select" required>
                                    <option value="<?php echo $row['cid'] ?>"><?php echo $row['cid'] ?></option>
                                    <?php
                                    $qry = "SELECT * FROM `councellor` WHERE `name` !='$name'";
                                    $result = mysqli_query($conn, $qry);
                                    while ($row1 = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo $row1['cid']; ?>"><?php echo $row1['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Location" value="<?php echo $row['location'] ?>" name="location" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Contact Number" value="<?php echo $row['phone'] ?>" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <textarea name="desc" placeholder="Description" required><?php echo $row['description'] ?></textarea>
                            </div>
                            <div class="contact-page__btn">
                                <button type="submit" name="updateProgram">
                                    <span class="thm-btn">Update</span>
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
if (isset($_REQUEST['updateProgram'])) {
    $Name = $_REQUEST['name'];
    $Date = $_REQUEST['date'];
    $Time = $_REQUEST['time'];
    $Councellor = $_REQUEST['councellor'];
    $Location = $_REQUEST['location'];
    $Description = $_REQUEST['desc'];
    $Phone = $_REQUEST['phone'];

    $qryUpdate = "UPDATE `programme` SET `cid`='$Councellor',`sid`='$uid',`programme_name`='$Name',`description`='$Description',`date`='$Date',`time`='$Time',`location`='$Location',`phone`='$Phone' WHERE `pid`='$pid'";
    if ($conn->query($qryUpdate) == TRUE) {
        echo "<script>alert('Programme Updated');window.location='addProgramme.php';</script>";
    } else {
        echo "<script>alert('Failed');</script>";
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<?php
include "../COMMON/commonFooter.php";
?>