<!DOCTYPE html>
<html>	
	<head>
		<title>CliqueFinder - Find your college</title>
		<link rel="stylesheet" href = "homepage.css">
		<link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "webApp";
    
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} ?>
	
	<!-- Header -->
	<header>
		<ul class="topHeader">
			<li><a href "#">Help</a></li>
			<li><a href "#">Sign In</a></li>
			<li><a href "#">Create an Account</a></li>
		</ul>
	</header>
	
	<!-- Title -->
	<div class="cliqueFinder">
		<p>CliqueFinder</p>
	</div>
	
	<!-- Create Search Bar -->
	<div class="search-bar">
		<form action="" method="POST">
			<input  type = "text"   name = "id" placeholder = "Search">
			<button type = "submit" name = "search" value = "search-data"><i class="fa fa-search"></i></button>				
		</form>
	</div>
	
	<!-- Create Filters -->
	<form action="" method="POST">
		<ul class = "filterList">
			<li>Location</li>
			<ul class = "locationList">
				<div><br>
					<li><input type ="checkbox">Northeast</li>
					<li><input type ="checkbox">Southwest</li>
					<li><input type ="checkbox">West</li>
					<li><input type ="checkbox">Southeast</li>
					<li><input type ="checkbox">Midwest</li>
				</div>
			</ul>
			<br><li>Division</li>
			<ul class = "enrollmentList">
				<div><br>
					<li><input type ="checkbox" name = "division[]" value = "Division 1">Division 1</li>
					<li><input type ="checkbox" name = "division[]" value = "Division 2">Division 2</li>
					<li><input type ="checkbox" name = "division[]" value = "Division 3">Division 3</li>
					<li><input type ="checkbox" name = "division[]" value = "NAIA">NAIA</li>
				</div>
			</ul>
			<br><li>Conference</li>
			<ul class = "conferenceList">
				<div><br>
					<li><input type ="checkbox" name = "conference[]" value = "Mid-American">Mid-American</li>
					<li><input type ="checkbox" name = "conference[]" value = "The American">The American</li>
					<li><input type ="checkbox" name = "conference[]" value = "Great Midwest">Great Midwest</li>
					<li><input type ="checkbox" name = "conference[]" value = "Horizon">Horizon</li>
					<li><input type ="checkbox" name = "conference[]" value = "Atlantic 10">Atlantic 10</li>
					<li><input type ="checkbox" name = "conference[]" value = "Big Ten">Big Ten</li>
					<li><input type ="checkbox" name = "conference[]" value = "Big East">Big East</li>						
				</div>
			</ul>
			<br><li>Tuition</li>
			<ul class = "tuitionList">
				<div><br>
					<li><input type ="checkbox" name = "tuition[]" value = "65000">more than $65,000</li>
					<li><input type ="checkbox" name = "tuition[]" value = "50000">$64,999-$50,000</li>
					<li><input type ="hidden"	name = "hidden[]"  value = "65000"></li>
					<li><input type ="checkbox" name = "tuition[]" value = "35000">$49,999-$35,000</li>
					<li><input type ="hidden"	name = "hidden[]"  value = "50000"></li>
					<li><input type ="checkbox" name = "tuition[]" value = "20000">$34,999-$20,000</li>
					<li><input type ="hidden"	name = "hidden[]"  value = "35000"></li>
					<li><input type ="checkbox" name = "tuition[]" value = "10000">$19,999-$10,000</li>
					<li><input type ="hidden"	name = "hidden[]"  value = "20000"></li>
					<li><input type ="checkbox" name = "tuition[]" value = "0" >less than $10,000</li>
				</div>
			</ul><br>
		<input type="submit" class = "submitFilterButton" name = "filter" value= "Apply Filter"> 
		<br></ul>
	</form>	
	
	<!-- Create List of Colleges -->	
	<div class="collegeList">
		
		<!-- If Search Button pressed -->
		<?php if(isset($_POST['search'])) {
		$name = $_POST['id'];
				
			// if search bar has something in it search thru database
			if ($_POST['id'] != NULL){
				?><p>Results</p>
			
				<!-- Create Back Button-->
				<a href="http://localhost/webApp/webAppHomepage.php" style="background-color:#fcfcfc">Back</a>
			
				<!-- Output searched data --><?php 
				$searchQuery 			= "SELECT * FROM college WHERE college_name = '$name'";
				$searchQuery_run 		= mysqli_query($conn, $searchQuery);	
			
				while($row = mysqli_fetch_array($searchQuery_run)) { ?>
					<form action="" method="POST">
					<ul class="colleges">
						<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
						<li><?php echo $row["college_name"];?></li>
					</ul> <?php
				}
	
			// else output all colleges 
			} else {	
			?><p>All Colleges</p><?php
				$allCollegesQuery		= "SELECT * FROM college ORDER BY college_name asc";
				$allCollegesQuery_run 	= mysqli_query($conn, $allCollegesQuery);
			
				while ($row = mysqli_fetch_array($allCollegesQuery_run)):;?>
					<ul class="colleges">
						<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
						<li><?php echo $row["college_name"];?></li>
					</ul> <?php endwhile;
			}
			
		// If submit filters button pressed			
		} else if (isset($_POST['filter'])) {
			?><p>Results</p><?php
			
			// if a division is selected 		
			if(!empty($_POST['division'])){
			foreach($_POST['division'] as $division) {
				$divisionQuery		= "SELECT * FROM college WHERE divison = '$division' ORDER BY college_name asc";
				$divisionQuery_run	=  mysqli_query($conn, $divisionQuery);
				
				while($row = mysqli_fetch_array($divisionQuery_run)) { ?>
					<ul class="divisionColleges">
						<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
						<li><?php echo $row["college_name"];?></li>
					</ul> <?php 
					}
				}
			}
			
			// if a conference is selected 		
			if(!empty($_POST['conference'])){
			foreach($_POST['conference'] as $conference) {
				$conferenceQuery		= "SELECT * FROM college WHERE conference = '$conference' ORDER BY college_name asc";
				$conferenceQuery_run	=  mysqli_query($conn, $conferenceQuery);
				
				while($row = mysqli_fetch_array($conferenceQuery_run)) { ?>
					<ul class="conferenceColleges">
						<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
						<li><?php echo $row["college_name"];?></li>
					</ul> <?php 
					}
				}
			}
			
			// if a tuition is selected 		
			if(!empty($_POST['tuition'])){
			foreach($_POST['tuition'] as $tuition) {
				$tuitionQuery		= "SELECT * FROM college WHERE tuition > '$tuition' && tuition < '$hidden' ORDER BY college_name asc";
				$tuitionQuery_run	=  mysqli_query($conn, $tuitionQuery);
				
				while($row = mysqli_fetch_array($tuitionQuery_run)) { ?>
					<ul class="tuitionColleges">
						<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
						<li><?php echo $row["college_name"];?></li>
					</ul> <?php 
					}
				}
			}
			
		// output all colleges when page is first loaded
		} else {
			?><p>All Colleges</p><?php 
			$allCollegesQuery		= "SELECT * FROM college ORDER BY college_name asc";
			$allCollegesQuery_run 	= mysqli_query($conn, $allCollegesQuery);
			
			while ($row = mysqli_fetch_array($allCollegesQuery_run)):;?>
				<ul class="colleges">
					<li><img src="<?php echo $row["img"];?>" height="160" width="300"/></li>
					<li><?php echo $row["college_name"];?></li>
				</ul> <?php endwhile; 
		} ?>
	</div>
</body>	
</html>