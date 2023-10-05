<?php
include "adminHeader.php";
include "../DBConnection/dbconnection.php";
?>

<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>Add Department</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Department</li>
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="contact-page__input-box">
                                <input type="text" pattern="[a-z A-Z]+" placeholder="Department" name="dept">
                            </div>
                        </div>
                        <div class="contact-page__btn">
                            <button type="submit" name="addDept">
                                <span class="thm-btn">Add</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<!--End Contact Page-->


<?php
$qry = "SELECT * FROM `department`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
    ?>
    <center>
        <h1 id="nodata" class="m-3">No Departments Added</h1>
    </center>
    <?php
} else {
    ?>
    <center>
        <h1 class="m-3 bread">Departments</h1>
        <input type="text" class="form-control m-3" id="searchInput" style="width: 50%;" placeholder="Search...">
        <table id="table" border="1">
            <thead>
                <tr style="text-align: center;">
                    <th>Department</th>
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
                            <a href="deleteDepartment.php?id=<?php echo $row['dept_id'] ?>"
                                class="btn btn-outline-danger">Delete</a>
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
if (isset($_REQUEST['addDept'])) {
    $Dept = $_REQUEST['dept'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `department` WHERE `name`='$Dept'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Department Already Exists');</script>";
    } else {
        $qryReg = "INSERT INTO `department`(`name`)VALUES('$Dept')";
        if ($conn->query($qryReg) == TRUE) {
            echo "<script>alert('Department Added');window.location='addDepartment.php';</script>";
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