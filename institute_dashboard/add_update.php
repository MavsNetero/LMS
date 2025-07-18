<?php
session_start();
if ($_SESSION['role'] != "Texas") {
	header("Location: ../index.php");
} else {
	include_once "../config.php";
	$_SESSION["userrole"] = "Institute";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once "../head.php"; ?>
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
	<!-- NAVIGATION -->
	<?php
	$nav_role = "Updates";
	include_once "../nav.php"; ?>
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
										<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
									</h5>
									<h6 class="header-pretitle">
										Add New
									</h6>
									<!-- Title -->
									<h1 class="header-title">
										Update
									</h1>
								</div>
							</div>
							<!-- / .row -->
						</div>
					</div>
					<!-- Form -->
					<form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
						<div class="card">
							<div class="card-body text-center">
								<div class="row justify-content-center">
									<div class="col-12 col-md-12 col-xl-5">
										<!-- Image -->
										<h2 class="mb-3">
											Update Image
										</h2>
										<img src="../assets/img/illustrations/happiness.svg" id="IMG-preview" alt="..." class="img-fluid mb-3 rounded" style="margin:auto; max-width: 80%;">
										<!-- Title -->
									</div>
									<div class="row justify-content-center">
										<div class="col-12 col-md-6 m-auto">
											<!-- Heading -->
											<!-- Text -->
											<small class="text-muted">
												Only allowed PNG or JPG less than 2MB
											</small>
										</div>
										<div class="col-12 col-md-6">
											<input type="file" id="img" name="updpic" class="btn btn-sm" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/png">
										</div>
									</div>
								</div>
								<!-- / .row -->
							</div>
						</div>
						<!-- Form -->
						<!-- Priview Profile pic  -->
						<script>
							function showPreview(event) {
								var file = document.getElementById('img');
								if (file.files.length > 0) {
									// RUN A LOOP TO CHECK EACH SELECTED FILE.
									for (var i = 0; i <= file.files.length - 1; i++) {
										var fsize = file.files.item(i).size; // THE SIZE OF THE FILE.
									}
									if (fsize <= 2000000) {
										var src = URL.createObjectURL(event.target.files[0]);
										var preview = document.getElementById("IMG-preview");
										preview.src = src;
										preview.style.display = "block";
									} else {
										alert("Only allowed less then 2MB.. !");
										file.value = '';
									}
								}
							}
						</script>
						<script>
							function showPreview(event) {
								var file = document.getElementById('img');
								if (file.files.length > 0) {
									// RUN A LOOP TO CHECK EACH SELECTED FILE.
									for (var i = 0; i <= file.files.length - 1; i++) {
										var fsize = file.files.item(i).size; // THE SIZE OF THE FILE.
									}
									if (fsize <= 2000000) {
										var src = URL.createObjectURL(event.target.files[0]);
										var preview = document.getElementById("IMG-preview");
										preview.src = src;
										preview.style.display = "block";
									} else {
										alert("Only allowed less then 2MB.. !");
										file.value = '';
									}
								}
							}
						</script>
						<!-- / .row -->
						<!-- Divider -->
						<hr class="mb-5">
						<div class="row">
							<div class="col-12 col-md-6">
								<!-- Last name -->
								<div class="form-group">
									<!-- Label -->
									<label class="form-label" for="validationCustom01">
										Update Title
									</label>
									<!-- Input -->
									<input type="text" class="form-control" id="validationCustom01" name="updtitle" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<!-- Middle name -->
								<div class="form-group">
									<!-- Label -->
									<label class="form-label" for="validationCustom01">
										Update Type
									</label>
									<!-- Input -->
									<select class="form-control" id="validationCustom01" name="updtype" required>
										<option value="" hidden="">Select Type</option>
										<option value="GTU">GTU</option>
										<option value="Campus">Campus</option>
									</select>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-12 col-md-12">
								<div class="form-group">
									<!-- Label -->
									<label for="validationCustom01" class="form-label">
										Update Description
									</label>
									<!-- Input -->
									<textarea id="validationCustom01" class="form-control sm" name="upddescription" required></textarea>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<hr>
							<div class="d-flex justify">
								<!-- Button -->
								<button class="btn btn-primary" type="submit" value="sub" name="subbed">
									Add Update
								</button>
							</div>
							<!-- / .row -->
					</form>
					<br>
				</div>
			</div>
			<!-- / .row -->
		</div>
	</div>
	<?php include_once("context.php"); ?>
	<!-- Map JS -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
	<!-- Vendor JS -->
	<script src="../assets/js/vendor.bundle.js"></script>
	<!-- Theme JS -->
	<script src="../assets/js/theme.bundle.js"></script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})()
	</script>
</body>

</html>
<?php
if (isset($_POST['subbed'])) {
	// $f_name = $_FILES['updpic']['name'];
	$f_tmp_name = $_FILES['updpic']['tmp_name'];
	$f_size = $_FILES['updpic']['size'];
	$f_error = $_FILES['updpic']['error'];
	// $f_type = $_FILES['updpic']['type'];
	// $f_ext = explode('.', $f_name);
	// $f_ext = strtolower(end($f_ext));

	$updtitle = $_POST['updtitle'];
	$updtype = $_POST['updtype'];
	$upddescription = $_POST['upddescription'];
	$updloadby = "Institute";
	$updtime = date("Y-m-d");

	$upd_file = $updtitle . ".png";

	$sql = "INSERT INTO `updatemaster`( `UpdateTitle`, `UpdateDescription`, `UpdateFile`, `UpdateUploadedBy`, `UpdateUploadDate`, `UpdateType`)
	    VALUES ('$updtitle','$upddescription','$upd_file','$updloadby','$updtime','$updtype')";
	$run = mysqli_query($conn, $sql);
	if ($run == true) {
		if ($f_error === 0) {
			if ($f_size <= 2000000) {
				move_uploaded_file($f_tmp_name, "../src/uploads/updates/" . $upd_file); // Moving Uploaded File to Server ... to uploades folder by file name f_name ...
			} else {
				echo "<script>alert(File size is to big .. !);</script>";
			}
		} else {
			echo "Something went wrong .. !";
		}
		echo "<script>alert('Update Added Successfully')</script>";
		echo "<script>window.open('update_list.php','_self')</script>";
	} else {
		echo "<script>alert('Update Not Added')</script>";
		echo "<script>window.open('update_list.php','_self')</script>";
	}
}
?>