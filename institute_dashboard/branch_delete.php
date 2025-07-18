<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/favicon/favicon.ico" type="image/x-icon" />
    <title>LMS by Titanslab</title>
    <style>
        
        body {
    background: linear-gradient(
        to top, 
        rgba(194, 171, 117, 0.8), /* Main shade with less opacity */
        rgba(194, 171, 117, 0.4) /* Secondary shade with less opacity */
    ), 
    url('rhsopacity.png') center/cover no-repeat;
    background-size: cover;
    background-attachment: fixed;
}



.header-body{
	border-bottom:2px solid white;
}
.header-pretitle{
	color:#558ce4;
}

    </style>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['role'] != "Texas") {
        header("Location: ../index.php");
    } else {
        include_once("../config.php");
        $_SESSION["userrole"] = "Institute";
        $fid = $_GET['brid'];
        $fid = mysqli_real_escape_string($conn, $fid);
        $qur = "DELETE FROM branchmaster WHERE BranchId = '$fid'";
        try {
            $res = mysqli_query($conn, $qur);
            if ($res) {
                echo "<script>alert('Branch Deleted Successfully');</script>";
                echo "<script>window.location.href='../institute_dashboard/branch_list.php';</script>";
            } else {
                echo "<script>alert('Branch Deletion Failed, Because This Branch is Not Empty');</script>";
                echo "<script>window.open('branch_list.php','_self')</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Branch Deletion Failed, Because This Branch is Not Empty');</script>";
            echo "<script>window.open('branch_list.php','_self')</script>";
        }
    }
    ?>
</body>

</html>