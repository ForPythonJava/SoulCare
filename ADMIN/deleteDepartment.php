<?php
include "../DBConnection/dbconnection.php";
$did = $_GET['id'];
$qry = "DELETE FROM `department` WHERE `dept_id`='$did'";
$result = mysqli_query($conn, $qry);

// echo $result;
if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"Department Deleted\");
    window.location=(\"addDepartment.php\");
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
