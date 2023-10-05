<?php
session_start();
$uid = $_SESSION['uid'];
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

    #para:hover {
        cursor: default;
    }
</style>
<!--Start Page Header-->
<section class="page-header">
    <div class="page-header__bg" style="background-image: url(../assets/images/backgrounds/page-header-bg.jpg)">
    </div>
    <div class="shape1"><img src="../assets/images/shapes/page-header-shape1.png" alt="#"></div>
    <div class="container">
        <div class="page-header__inner text-center">
            <h2>View Staffs</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Staffs</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->


<?php
$qry = "SELECT `staff`.*,`login`.* FROM `staff`,`login` WHERE `staff`.`staff_id`=`login`.`reg_id`";
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Staffs Registered</h1>
    </center>
<?php
} else {
?>
    <center>
        <h1 class="m-3 bread">Staffs</h1>
        <input type="text" class="form-control m-3" id="searchInput" style="width: 80%;" placeholder="Search...">
        <table id="table" border="1">
            <thead>
                <tr style="text-align: center;">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Qualification</th>
                    <th>Address</th>
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
                            <?php echo $row['dept'] ?>
                        </td>
                        <td>
                            <?php echo $row['quali'] ?>
                        </td>
                        <td>
                            <?php echo $row['address'] ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'Pending') {
                            ?>
                                <a href="manageStaff.php?id=<?php echo $row['staff_id'] ?>&status=Approve" class="btn btn-outline-success">Approve</a>
                                <a href="manageStaff.php?id=<?php echo $row['staff_id'] ?>&status=Reject" class="btn btn-outline-danger">Reject</a>
                            <?php } else {
                            ?>
                                <a href="manageStaff.php?id=<?php echo $row['staff_id'] ?>&status=Delete" class="btn btn-outline-danger">Delete</a>
                            <?php
                            }
                            ?>
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