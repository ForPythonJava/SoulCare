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
        width: 95%;
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
            <h2>Add Programme</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Programme</li>
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Name of Event" name="name" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" min="<?php echo date('Y-m-d') ?>" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" placeholder="Date" name="date" id="select" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Time" name="time" id="select" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <select name="councellor" id="select" required>
                                    <option selected disabled>Select Councelor</option>
                                    <?php
                                    $qry = "SELECT * FROM `councellor`";
                                    $result = mysqli_query($conn, $qry);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $row['cid']; ?>"><?php echo $row['name']; ?></option>
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
                                <input type="text" placeholder="Location" name="location" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" placeholder="Contact Number" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <textarea name="desc" placeholder="Description" required></textarea>
                            </div>
                            <div class="contact-page__btn">
                                <button type="submit" name="addProgramme">
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
if (isset($_REQUEST['addProgramme'])) {
    $Name = $_REQUEST['name'];
    $Date = $_REQUEST['date'];
    $Time = $_REQUEST['time'];
    $Councellor = $_REQUEST['councellor'];
    $Location = $_REQUEST['location'];
    $Description = $_REQUEST['desc'];
    $Phone = $_REQUEST['phone'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `programme` WHERE `name`='$Name'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Programme Already Added');</script>";
    } else {
        $qryReg = "INSERT INTO `programme`(`cid`,`sid`,`programme_name`,`description`,`date`,`time`,`location`,`phone`)VALUES('$Councellor','$uid','$Name','$Description','$Date','$Time','$Location','$Phone')";
        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Programme Added');window.location='addProgramme.php';</script>";
        } else {
            echo "<script>alert('Failed');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>

<?php
$qry = "SELECT `programme`.*,`councellor`.`name` FROM `programme`,`councellor` WHERE `programme`.`sid`='$uid' AND `councellor`.`cid`=`programme`.`cid`";
// echo $qry;
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
    ?>
    <center>
        <h1 id="nodata" class="m-3">No Programme Added</h1>
    </center>
    <?php
} else {
    ?>
    <center>
        <h1 class="m-3 bread">Programs</h1>
        <input type="text" class="form-control m-3" id="searchInput" style="width: 95%;" placeholder="Search...">
        <table id="table" border="1">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr id="row{{ forloop.counter }}" style="text-align: center;">
                        <td>
                            <?php echo $row['programme_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['description'] ?>
                        </td>
                        <td>
                            <?php echo $row['date'] ?>
                        </td>
                        <td>
                            <?php echo $row['time'] ?>
                        </td>
                        <td>
                            <?php echo $row['location'] ?>
                        </td>
                        <td>
                            <?php echo $row['phone'] ?>
                        </td>
                        <td>
                            <a href="updateProgram.php?id=<?php echo $row['pid'] ?>" class="btn btn-outline-success">Update</a>
                        </td>
                        <td>
                            <a href="deleteProgramme.php?id=<?php echo $row['pid'] ?>" class="btn btn-outline-danger">Delete</a>
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
    $(document).ready(function () {
        // Handle search input
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            var rows = $("#tableBody tr");
            var matchingRows = rows.filter(function () {
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