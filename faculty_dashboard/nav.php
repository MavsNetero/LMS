<style>
	#sidebar{
			background-color: #987554;
			color:white;
	}

	.nav-item>a i, .nav-link i{
		color:white;
	}

	.nav-item {
		position: relative;
	}
	.nav-item a:active {
		color:black;
	}


	.nav-item::after {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		color:black;
		background-color: #d8d0c5;
		opacity: 0.2; /* Adjust opacity here */
		transform: scaleX(0);
		transform-origin: bottom right;
		transition: transform 0.3s ease, opacity 0.3s ease;
		z-index: -1;
	}

	.nav-item:hover::after {
		transform: scaleX(1);
		transform-origin: bottom left;
		opacity: 0.6; /* Adjust opacity on hover */
	}

	.nav-item.active::after {
		transform: scaleX(1);
		transform-origin: bottom left;
		opacity: 0.6; /* Adjust opacity when active */
	}


	.pb-5{
	margin-bottom: -20px;
}
.navbar-brand img{
	margin-top:-20px;
	margin-bottom: -20px;
}

.navbar-toggler>span{
	color: white;
}

</style>
<!-- NAVIGATION -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
	<div class="container-fluid">
		<!-- Toggler -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<!-- Brand -->
			<div class="justify-start d-flex flex-column justify-content-center align-items-center pt-4">
			<div class="navbar-brand">
				<img src="../assets/img/rhslogo.png?t=<?php time(); ?>" 
					class="navbar-brand-img mx-auto d-none d-md-block" 
					alt="...">
			</div>
			<p class="pb-5">Rizal High School</p>
		</div>
		<!-- User (xs) -->
		<div class="navbar-user d-md-none">
			<!-- Dropdown -->
			<div class="dropdown">
			</div>
		</div>
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidebarCollapse">
			<!-- Form -->
			<form class="mt-4 mb-3 d-md-none">
				<div class="input-group input-group-rounded input-group-merge input-group-reverse">
					<input class="form-control" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-text">
						<span class="fe fe-search"></span>
					</div>
				</div>
			</form>
			<!-- Navigation -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a style="color: white;" href="../faculty_dashboard" class="nav-link <?php if ($nav_role == "Dashboard") {
																		echo "active";
																	} ?>">
						<i class="fe fe-home"></i> Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a style="color: white;" href="student_list.php" class="nav-link <?php if ($nav_role == "Student") {
																	echo "active";
																} ?>">
						<i class="fe uil-user"></i> Students
					</a>
				</li>
				<li class="nav-item">
					<a style="color: white;" href="branch_profile.php" class="nav-link <?php if ($nav_role == "Branch") {
																		echo "active";
																	} ?>">
						<i class="fe uil-code-branch"></i> Branch
					</a>
				</li>
				<li class="nav-item">
					<a style="color: white;" href="subjects.php" class="nav-link <?php if ($nav_role == "Subjects") {
																echo "active";
															} ?>">
						<i class="fe uil-file"></i> Subjects
					</a>
				</li>

				<li class="nav-item">
					<a style="color: white;" href="assignment_list.php" class="nav-link <?php if ($nav_role == "Assignment") {
																		echo "active";
																	} ?>">
						<i class="fe uil-book"></i> Assignments
					</a>
				</li>
				<!--
				<li class="nav-item">
					<a style="color: white;" href="update_list.php" class="nav-link <?php if ($nav_role == "Updates") {
																	echo "active";
																} ?>">
						<i class="fe fe-bell"></i>Updates
					</a>
				</li>
				
				<li class="nav-item">
					<a style="color: white;" href="timetable_list.php" class="nav-link <?php if ($nav_role == "Time Table") {
																		echo "active";
																	} ?>">
						<i class="fe uil-calendar-alt"></i>Time Tables
					</a>
				</li>
				-->
			</ul> 
			<!-- Divider -->
			<hr class="navbar-divider my-3">
			<!-- Heading -->
			<h6 style="color: white;" class="navbar-heading">
				Legal Center
			</h6>
			<!-- Navigation -->
			 <!--
			<ul class="navbar-nav mb-md-4" style="height:50px;">
				<li class="nav-item">
					<a style="color: white;" href="Study_related.php" class="nav-link <?php if ($nav_role == "Study related querys") {
																	echo "active";
																} ?>">
						<i style="color: white;" class="fe fe-book"></i>Study Queries
					</a>
				</li>
			</ul>
			-->

			<ul class="navbar-nav mb-md-4" style="height:50px;">
				<li class="nav-item">
					<a style="color: white;" href="termsandpolicy.php" class="nav-link <?php if ($nav_role == "Study related querys") {
																	echo "active";
																} ?>">
						<i style="color: white;" class="fe fe-info"></i>Terms & Condition
					</a>
				</li>
			</ul>

			<div class="mt-auto"></div>
			<div class="navbar-user d-md-flex" style="overflow: hidden;" id="sidebarUser">

				<hgroup class="text-center navbar-heading " style="margin: -30px;">
					<a href="logout.php"><button class="btn btn-link" style="color:#f7dfb1; ">Logout</button></a>
					<h6 style="margin: -1px; color: white;">
					&copy; 2024 <a style="color:#f7dfb1;" href="https://www.rhspasig.com/" target="_blank">RHS</a> LMS.<br> All rights reserved.	
					</h6><br><!--
					<h6 class="">
					<a style="color:#f7dfb1;" href="termsandpolicy.php"  style="color:#f7dfb1;">Terms & Condition</a><br>
					<a style="color:#f7dfb1;" href="termsandpolicy.php"  style="color:#f7dfb1;">Privacy Policy</a>
					</h6> -->
				</hgroup>
			</div>
		</div>
	</div>
</nav>