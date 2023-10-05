<?php
include "adminHeader.php";
include "../DBConnection/dbconnection.php";
?>
<style>
    #table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: 10px;
    }

    #img {
        height: 100px !important;
        width: 100px !important;
    }

    input[type='time'] {
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
            <h2>Add Councellor</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Councellor</li>
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
                <form class="contact-page__form" method="post" enctype="multipart/form-data">
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
                                <input type="text" placeholder="Qualification" name="quali" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" onfocus="(this.type='time')" placeholder="Select Starting Time" name="stime" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" onfocus="(this.type='time')" placeholder="Select Ending Time" name="etime" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="password" id="select" placeholder="Password" name="password" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="file" class="form-control form-control-lg" accept="image/*" name="imgFile" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <textarea name="address" placeholder="Address" required></textarea>
                            </div>
                            <div class="contact-page__btn">
                                <button type="submit" name="addCouncellor">
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
if (isset($_REQUEST['addCouncellor'])) {
    $Name = $_REQUEST['name'];
    $Email = $_REQUEST['email'];
    $Phone = $_REQUEST['phone'];
    $Stime = $_REQUEST['stime'];
    $Etime = $_REQUEST['etime'];

    $StimeWithAMPM = date("h:i A", strtotime($Stime));
    $EtimeWithAMPM = date("h:i A", strtotime($Etime));
    $Quali = $_REQUEST['quali'];
    $Password = $_REQUEST['password'];
    $Image = $_FILES["imgFile"]["name"];
    $tempname = $_FILES["imgFile"]["tmp_name"];
    $folder = "image/" . $Image;
    $Address = $_REQUEST['address'];
    $combinedTime = $StimeWithAMPM . " - " . $EtimeWithAMPM;

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `councellor` WHERE `email`='$Email' OR `phone`='$Phone'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);
    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Councellor Already exists');window.location='addCouncellor.php';</script>";
    } else {
        if (move_uploaded_file($tempname, '../assets/image/' . $Image)) {
            $qryReg = "INSERT INTO `councellor` (`name`, `email`, `phone`, `quali`, `image`, `address`, `time`) VALUES ('$Name', '$Email', '$Phone', '$Quali', '$Image', '$Address', '$combinedTime')";
            $qryLog = "INSERT INTO `login`(`reg_id`,`email`,`password`,`usertype`,`status`)VALUES((SELECT MAX(`cid`) FROM `councellor`),'$Email','$Password','Councellor','Approved')";
            if ($conn->query($qryReg) == TRUE && $conn->query($qryLog) == TRUE) {
                echo "<script>alert('Councellor Added');window.location = 'addCouncellor.php';</script>";
            } else {
                echo "<script>alert('Failed');window.location = 'addCouncellor.php';</script>";
                echo "Error: " . mysqli_error($conn);
            }
            // echo $qryReg;
        } else {
            echo "Error:" . mysqli_error($conn);
        }
    }
}

?>


<?php
$qry = "SELECT * FROM `councellor`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Councellors Added</h1>
    </center>
<?php
} else {
?>
    <center>
        <h1 class="m-3 bread">Councellors</h1>
        <input type="text" class="form-control m-3" id="searchInput" style="width: 80%;" placeholder="Search...">
        <table id="table" border="1">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Qualification</th>
                    <th>Address</th>
                    <th>Time</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr id="row{{ forloop.counter }}" style="text-align: center;">
                        <td>
                            <?php echo $row['name'] ?>
                        </td>
                        <td>
                            <?php echo $row['email'] ?>
                        </td>
                        <td>
                            <?php echo $row['phone'] ?>
                        </td>
                        <td>
                            <?php echo $row['quali'] ?>
                        </td>
                        <td>
                            <?php echo $row['address'] ?>
                        </td>
                        <td>
                            <?php echo $row['time'] ?>
                        </td>
                        <td>
                            <img src="../assets/image/<?php echo $row['image'] ?>" id="img" alt="">
                        </td>
                        <td>
                            <a href="deleteCouncellors.php?id=<?php echo $row['cid'] ?>" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div id="noMatchingData" style="display: none;">
            <h1 class="m-5">No Results Found</h1>
        </div>
    </center>
<?php } ?>


<!-- Include Bootstrap JS and jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle search input
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var rows = $("#tableBody tr");
            var matchingRows = rows.filter(function() {
                var rowText = $(this).text().toLowerCase();
                return rowText.indexOf(value) > -1;
            });
            rows.hide(); // Hide all rows initially
            matchingRows.show(); // Show matching rows
            if (matchingRows.length === 0) {
                $("#noMatchingData").show(); // Show message if no matching rows
                $("#table").hide();
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching rows
                $("#table").show();
            }
        });
    });
</script>



<?php
include "../COMMON/commonFooter.php";
?>