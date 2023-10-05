<?php
include "../DBConnection/dbconnection.php";
$sid = $_GET['id'];
$status = $_GET['status'];

if ($status == 'Approve') {
    $qry = "UPDATE `login` SET `status`='Approved' WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
} else if ($status == 'Reject') {
    $qry = "UPDATE `login` SET `status`='Rejected' WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
} else if ($status == 'Delete') {
    $qry = "DELETE FROM `staff` WHERE `staff_id`='$sid'";
    $qry1 = "DELETE FROM `login` WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
    $result1 = mysqli_query($conn, $qry1);
    if ($result && $result1) {
        echo "<script type=\"text/javascript\"> alert(\"Staff Deleted\");
        window.location=(\"adminViewStaff.php\");</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"$status\");
    window.location=(\"adminViewStaff.php\");</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
