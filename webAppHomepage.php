<!DOCTYPE html>
<html>	
	<head>
		<title>Clique Finder</title>
		<link rel="stylesheet" href = "homepage.css">
	</head>
	
	<body>
	<header>
		<ul class="topHeader">
			<li><a href "#">Help</a></li>
			<li><a href "#">Sign In to Clique Finder</a></li>
			<li><a href "#">Create an Account</a></li>
		</ul>
	</header>
		<p>Clique Finder</p>
		<ul class = "navMenu">
			<li><a href "webAppAllColleges.php">All Colleges</a></li>
			<li><a href "#">Divison 1</a></li>
			<li><a href "#">Divison 2</a></li>
			<li><a href "#">Divison 3</a></li>
			<li><a href "#">NAIA</a></li>
		</ul>
		<div class="search-bar">
			<input type = "text" placeholder = "Type to search...">
		</div>
		<ul class = "filterList">
			<p>Filter</p>
				<li>Location</li>
					<ul class = "locationList"><!--
						<li>Northeast</li>
						<li>Southwest</li>
						<li>West</li>
						<li>Southeast</li>
						<li>Midwest</li>-->
					</ul>
				<br><li>Enrollment</li>
					<ul class = "enrollmentList"><!--
						<li>greater than 50,000</li>
						<li>49,999-30,000</li>
						<li>29,999-15,000</li>
						<li>15,000-5,000</li>
						<li>less than 5,000</li>-->
					</ul>
				<br><li>Tuition</li>
		</ul>
		
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
    }
    //echo "Connected successfully";
    
    $sql = "SELECT * FROM college";
        
    //$newresult = $conn->query($sql);
    $testResult = mysqli_query($conn, $sql);
    ?>
	<div class="collegeList">
		<p>Popular</p>
		<?php while ($row = mysqli_fetch_array($testResult)):;?>
			<ul class="colleges">
				<li><?php echo $row[1];?></li>			
			</ul>
		<?php endwhile;?>
	</div>
	</body>
	
</html>