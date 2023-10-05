<?php
include "../DBConnection/dbconnection.php";
$sid = $_GET['id'];
$status = $_GET['status'];

if ($status == "Deleted") {
    $qry = "DELETE FROM `student` WHERE `sid`='$sid'";
    $qry1 = "DELETE FROM `login` WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
    $result1 = mysqli_query($conn, $qry1);
    if ($result && $result1) {
        echo "<script type=\"text/javascript\"> alert(\"Student $status\");
        window.location=(\"staffViewStudents.php\");</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else if ($status == "Approved") {
    $qry = "UPDATE `login` SET `status`='Approved' WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
} else if ($status == "Rejected") {
    $qry = "UPDATE `login` SET `status`='Rejected' WHERE `reg_id`='$sid'";
    $result = mysqli_query($conn, $qry);
}


// echo $result;
if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"Student $status\");
    window.location=(\"staffViewStudents.php\");</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
