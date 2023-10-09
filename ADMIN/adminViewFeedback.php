<?php
session_start();
$uid = $_SESSION['uid'];
// echo $uid;
include "adminHeader.php";
include "../DBConnection/dbconnection.php";
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">

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
            <h2>View Feedbacks</h2>
            <ul class="thm-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Feedbacks</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Header-->

<?php
$qry = "SELECT `feedback`.*,`student`.`name`,`programme`.`programme_name` FROM `feedback`,`student`,`programme`,`booking` WHERE `feedback`.`uid`=`student`.`sid` AND `booking`.`pid`=`programme`.`pid` AND `booking`.`sid`=`student`.`sid`";
// echo $qry;
$result = mysqli_query($conn, $qry);
if (mysqli_num_rows($result) < 1) {
?>
    <center>
        <h1 id="nodata" class="m-3">No Feedbacks Yet</h1>
    </center>
<?php
} else {
?>
    <center>
        <h1 class="m-3 bread">Feedbacks</h1>
        <input type="text" class="form-control m-3" id="searchInput" style="width: 80%;" placeholder="Search...">
        <table id="table" border="1">
            <thead>
                <tr style="text-align: center;">
                    <th>Student</th>
                    <th>Programme Name</th>
                    <th>Title</th>
                    <th>Feedback</th>
                    <th>Date</th>
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
                            <?php echo $row['programme_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['title'] ?>
                        </td>
                        <td>
                            <?php echo $row['feedback'] ?>
                        </td>
                        <td>
                            <?php echo $row['date'] ?>
                        </td>
                        <td>
                            <?php if ($row['reply'] == "") { ?>
                                <button class="btn btn-secondary py-2 px-5 ml-1" onclick="document.getElementById('id').style.display='block'">Reply</button>
                            <?php } else { ?>
                                <p style="color: green;font-weight: bolder;">Replied</p>
                            <?php } ?>
                        </td>
                        <div class="w3-container">
                            <div id="id" class="w3-modal">
                                <div class="w3-modal-content w3-animate-top w3-card-4">
                                    <header class="w3-container w3-teal">
                                        <span onclick="document.getElementById('id').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <h2 style="color: white;text-align: center;">Reply Feedback</h2>
                                    </header>
                                    <div class="w3-container">
                                        <form method="post" class="bg-light p-3 contact-form">
                                            <div class="form-group">
                                                <input required="" type="text" placeholder="Enter Reply" name="reply" class="form-control mb-3">
                                                <input required="" value="<?php echo $row['id'] ?>" type="hidden" placeholder="Enter Reply" name="fid" class="form-control mb-3">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="sendReply" value="Send Reply" class="btn btn-primary py-3 mb-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
if (isset($_REQUEST['sendReply'])) {
    $Reply = $_REQUEST['reply'];
    $Fid = $_REQUEST['fid'];
    $qryReg = "UPDATE `feedback` SET `reply`='$Reply' WHERE `id`='$Fid'";
    echo $qryReg;
    if ($conn->query($qryReg) == TRUE) {
        echo "<script>alert('Replied');window.location='adminViewFeedback.php';</script>";
    } else {
        echo "<script>alert('Failed');</script>";
        echo "Error: " . mysqli_error($conn);
    }
}

?>


<?php
include "../COMMON/commonFooter.php";
?>