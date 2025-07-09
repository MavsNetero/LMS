<?php
session_start();

// Check user role
if ($_SESSION['role'] != "Texas") {
    header("Location: ../index.php");
    exit();
}

include_once("../config.php");
$_SESSION["userrole"] = "Institute";

// Check if required parameters are set
if (!isset($_GET['brid']) || !isset($_GET['semid'])) {
    // Show a form to select branch and semester instead of redirecting
    ?>
    <div class="container mt-5">
        <div class="alert alert-warning">
            <h4>Missing Parameters</h4>
            <p>Please access this page through the proper navigation or provide the required parameters:</p>
            <ul>
                <li><strong>brid</strong> - Branch Code (e.g., CS, IT, ME)</li>
                <li><strong>semid</strong> - Semester ID (e.g., CS_1, IT_2)</li>
            </ul>
            <p>Example URL: <code>add_subject.php?brid=CS&semid=CS_1</code></p>
            <a href="../index.php" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </div>
    <?php
    exit();
}

$brcode = mysqli_real_escape_string($conn, $_GET['brid']);
$semid = mysqli_real_escape_string($conn, $_GET['semid']);

// Fetch faculty data
$facsel = "SELECT * FROM facultymaster WHERE FacultyBranchCode = '$brcode'";
$facresult = mysqli_query($conn, $facsel);

if (!$facresult) {
    die("Faculty query failed: " . mysqli_error($conn));
}

// Fetch branch data
$branchsel = "SELECT * FROM branchmaster WHERE BranchCode = '$brcode'";
$branchresult = mysqli_query($conn, $branchsel);

if (!$branchresult) {
    die("Branch query failed: " . mysqli_error($conn));
}

$brow = mysqli_fetch_assoc($branchresult);
if (!$brow) {
    echo "<script>alert('Branch not found');</script>";
    echo "<script>window.location.href='../index.php';</script>";
    exit();
}

// Handle form submission
if (isset($_POST['subbed'])) {
    // Validate and process form data
    $icode = mysqli_real_escape_string($conn, $_POST['icode']);
    $iname = mysqli_real_escape_string($conn, $_POST['iname']);
    $isem = mysqli_real_escape_string($conn, $_POST['isem']);
    $ifac = mysqli_real_escape_string($conn, $_POST['ifac']);
    
    // Validate required fields
    if (empty($icode) || empty($iname) || empty($isem) || empty($ifac)) {
        echo "<script>alert('All fields are required');</script>";
    } else {
        $temo = $brow['BranchId'];
        $temo2 = $brow['BranchCode'] . "_" . $isem;
        $BranchCode = $brow['BranchCode'];
        $iimg = $icode . ".png";
        $simg = $icode . ".pdf";
        
        $upload_success = true;
        
        // Handle profile image upload
        if (isset($_FILES['subprofile']) && $_FILES['subprofile']['error'] === 0) {
            $fs_name = $_FILES['subprofile']['tmp_name'];
            $fs_size = $_FILES['subprofile']['size'];
            
            if ($fs_size <= 2000000) {
                $upload_dir = "../src/uploads/subprofile/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                if (!move_uploaded_file($fs_name, $upload_dir . $iimg)) {
                    echo "<script>alert('Failed to upload profile image');</script>";
                    $upload_success = false;
                }
            } else {
                echo "<script>alert('Image file size is too big (max 2MB)');</script>";
                $upload_success = false;
            }
        }
        
        // Handle syllabus file upload
        if (isset($_FILES['isyllabus']) && $_FILES['isyllabus']['error'] === 0) {
            $f_name = $_FILES['isyllabus']['tmp_name'];
            $f_size = $_FILES['isyllabus']['size'];
            
            if ($f_size <= 2000000) {
                $upload_dir = "../src/uploads/syllabus/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                if (!move_uploaded_file($f_name, $upload_dir . $simg)) {
                    echo "<script>alert('Failed to upload syllabus file');</script>";
                    $upload_success = false;
                }
            } else {
                echo "<script>alert('PDF file size is too big (max 2MB)');</script>";
                $upload_success = false;
            }
        }
        
        // Insert into database if uploads were successful
        if ($upload_success) {
            $sql = "INSERT INTO subjectmaster (SubjectCode, SubjectName, SubjectBranch, SubjectSemester, SubjectFacultyId, SemCode, SubjectPic, SubjectSyllabus) 
                    VALUES ('$icode', '$iname', '$temo', '$isem', '$ifac', '$temo2', '$iimg', '$simg')";
            
            $run = mysqli_query($conn, $sql);
            
            if ($run) {
                echo "<script>alert('Subject Added Successfully');</script>";
                echo "<script>window.open('sem_details.php?semid=$temo2&brid=$BranchCode','_self');</script>";
            } else {
                echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("../head.php"); ?>
    <style>
        body {
            background: linear-gradient(
                to top, 
                rgba(194, 171, 117, 0.8),
                rgba(194, 171, 117, 0.4)
            ), 
            url('rhsopacity.png') center/cover no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

        .header-body {
            border-bottom: 2px solid white;
        }

        .header-pretitle {
            color: #558ce4;
        }

        .form-control:focus {
            border-color: #558ce4;
            box-shadow: 0 0 0 0.2rem rgba(85, 140, 228, 0.25);
        }

        .btn-primary {
            background-color: #558ce4;
            border-color: #558ce4;
        }

        .btn-primary:hover {
            background-color: #4a7bc8;
            border-color: #4a7bc8;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION -->
    <?php 
    $nav_role = "Branch";
    include_once("../nav.php"); 
    ?>
    
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <!-- Header -->
                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="header-pretitle">
                                        <a class="btn-link btn-outline" onclick="history.back()">
                                            <i class="fe uil-angle-double-left"></i>Back
                                        </a>
                                    </h5>
                                    <h6 class="header-pretitle">Add New</h6>
                                    <h1 class="header-title">Subject</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <br>
                    <form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                        <!-- Profile Image Section -->
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar">
                                            <img name="simg" class="w-100 border-radius-lg shadow-sm rounded" 
                                                 src="../assets/img/avatars/profiles/avatar-1.jpg" 
                                                 alt="Subject Image" id="IMG-preview">
                                        </div>
                                    </div>
                                    <div class="col ml-n2">
                                        <h4 class="mb-1">Subject Photo</h4>
                                        <small class="text-muted">Only allowed PNG or JPG less than 2MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <input type="file" id="img" name="subprofile" class="btn btn-sm" 
                                       onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/png">
                            </div>
                        </div>

                        <hr class="my-5">

                        <!-- Form Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="subjectCode" class="form-label">Subject Code</label>
                                <input type="number" class="form-control" id="subjectCode" name="icode" 
                                       placeholder="20240000" required>
                                <div class="invalid-feedback">Please provide a valid subject code.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="subjectName" class="form-label">Subject Name</label>
                                <input type="text" class="form-control" id="subjectName" name="iname" 
                                       placeholder="Computer Programming" required>
                                <div class="invalid-feedback">Please provide a subject name.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="branch" class="form-label">Branch</label>
                                <input type="text" class="form-control" id="branch" name="ibranch" 
                                       value="<?php echo htmlspecialchars($brow['BranchName']); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="isem" required>
                                    <option value="<?php echo substr($semid, -1, 1); ?>" selected>
                                        <?php echo substr($semid, -1, 1); ?>
                                    </option>
                                    <?php for ($x = 1; $x <= $brow['BranchSemesters']; $x++) { 
                                        if ($x != substr($semid, -1, 1)) {
                                            echo "<option value='" . $x . "'>" . $x . "</option>";
                                        }
                                    } ?>
                                </select>
                                <div class="invalid-feedback">Please select a semester.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="faculty" class="form-label">Faculty</label>
                                <select class="form-select" id="faculty" name="ifac" required>
                                    <option value="" selected>Select Faculty</option>
                                    <?php
                                    mysqli_data_seek($facresult, 0); // Reset result pointer
                                    while ($facrow = mysqli_fetch_assoc($facresult)) { ?>
                                        <option value="<?php echo $facrow['FacultyId']; ?>">
                                            <?php echo htmlspecialchars($facrow['FacultyFirstName'] . " " . $facrow['FacultyLastName']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">Please select a faculty member.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="syllabus" class="form-label">Syllabus</label>
                                <input type="file" class="form-control" id="syllabus" name="isyllabus" 
                                       accept="application/pdf" required>
                                <div class="invalid-feedback">Please upload a syllabus PDF.</div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-5">

                        <div class="d-flex justify-content-start">
                            <button class="btn btn-primary" type="submit" name="subbed">
                                Add Subject
                            </button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("context.php"); ?>

    <!-- Scripts -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <script src="../assets/js/vendor.bundle.js"></script>
    <script src="../assets/js/theme.bundle.js"></script>

    <script>
        // Image preview function
        function showPreview(event) {
            var file = document.getElementById('img');
            if (file.files.length > 0) {
                var fsize = file.files[0].size;
                if (fsize <= 2000000) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("IMG-preview");
                    preview.src = src;
                    preview.style.display = "block";
                } else {
                    alert("File size must be less than 2MB!");
                    file.value = '';
                }
            }
        }

        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>