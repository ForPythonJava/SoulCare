<?php
include "../DBConnection/dbconnection.php";
$did = $_GET['id'];
$qry = "DELETE FROM `councellor` WHERE `cid`='$did'";
$qry1 = "DELETE FROM `login` WHERE `reg_id`='$did'";
$result = mysqli_query($conn, $qry);
$result1 = mysqli_query($conn, $qry1);
// echo $result;
if ($result && $result1) {
    echo "<script type=\"text/javascript\"> alert(\"Councellor Deleted\");
    window.location=(\"addCouncellor.php\");
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>