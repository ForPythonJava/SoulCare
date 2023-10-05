<?php
session_start();
include "commonHeader.php";
include "../DBConnection/dbconnection.php";
?>
<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Register Now</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Student</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

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
                                <input type="text" placeholder="Name" name="name" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="email" placeholder="Email address" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" pattern="[6789][0-9]{9}" maxlength="10" minlength="10" placeholder="Phone" name="phone" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <select name="department" id="select" required>
                                    <option selected disabled>Select Department</option>
                                    <?php
                                    $qry = "SELECT * FROM `department`";
                                    $result = mysqli_query($conn, $qry);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
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
                                <select name="gender" id="select" required>
                                    <option selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">FeMale</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" id="select" placeholder="Password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <textarea name="address" placeholder="Address" required></textarea>
                            </div>
                            <div class="contact-page__btn">
                                <button type="submit" name="addStudent">
                                    <span class="thm-btn">SignUp</span>
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
if (isset($_REQUEST['addStudent'])) {
    $Name = $_REQUEST['name'];
    $Email = $_REQUEST['email'];
    $Phone = $_REQUEST['phone'];
    $Department = $_REQUEST['department'];
    $Gender = $_REQUEST['gender'];
    $Password = $_REQUEST['password'];
    $Address = $_REQUEST['address'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `student` WHERE `email`='$Email' OR `phone`='$Phone'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Student Already Exists');</script>";
    } else {
        $qryReg = "INSERT INTO `student`(`name`,`email`,`phone`,`address`,`gender`,`department`)VALUES('$Name','$Email','$Phone','$Address','$Gender','$Department')";
        $qryLog = "INSERT INTO `login`(`reg_id`,`email`,`password`,`usertype`)VALUES((SELECT MAX(`sid`) FROM `student`),'$Email','$Password','Student')";
        if ($conn->query($qryReg) == TRUE && $conn->query($qryLog) == TRUE) {
            echo "<script>alert('Registration Successful');window.location='login.php';</script>";
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