<?php
include "../DBConnection/dbconnection.php";
$did = $_GET['id'];
$qry = "DELETE FROM `programme` WHERE `pid`='$did'";
$result = mysqli_query($conn, $qry);

// echo $result;
if ($result) {
    echo "<script type=\"text/javascript\"> alert(\"Programme Deleted\");
    window.location=(\"addProgramme.php\");
    </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>