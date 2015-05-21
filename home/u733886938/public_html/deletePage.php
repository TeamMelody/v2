<html>

<head>
	<style>
	
		hr {
			border: 0;
			height: 1px;
			background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
			background-image:    -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
			background-image:     -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
			background-image:      -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
		}
	
		h2 {
			font-family: Arial;
			text-shadow: 0 -1px 0 rgba(10,20,30,0.4);
			text-align: center;
		}
		
		table { padding:0; margin:0 auto; }
		th { font-weight:bold; font-size:11px; border-right:1px solid #C1DAD7; border-bottom:1px solid #C1DAD7; border-top:1px solid #C1DAD7; letter-spacing:2px; text-transform:uppercase; text-align:left; padding:6px 6px 6px 12px; background:#CAE8EA;}
		td { border-right:1px solid #C1DAD7; border-bottom:1px solid #C1DAD7; background:#fff; padding:8px 8px 8px 12px; color:#4f6b72; }

		input[type=submit]{
			font-family: Arial;
			font-size: 14px;
			font-weight: bold;
			color: #FFFFFF;
			padding: 5px 5px;
			margin: 0 5px;
			text-decoration: none;
			border: solid 1px #720000;
			background-color: #d25454;
		}
		
		input[type=submit]:hover{
			background:#c72a2a;
			border:1px solid #c72a2a;
			-webkit-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
			-moz-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
			box-shadow: 0px 0px 5px rgba(0,0,0, .75);
		}
		
		
	</style>
	
	
</head>

<body>


        
<?php
	require 'dbConnection.php';
	
	$sql = "select * from School";
	$result = mysql_query($sql);

	if (!$result) {
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
	echo "<table border='1'>
	<tr>
	<th>School ID</th>
	<th>School Name</th>
	<th> Delete </th>
	</tr>";
	
	while ($row = mysql_fetch_row($result)) {
		
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td> <form action=\"?\" method=\"post\"> <input type=\"hidden\" name=\"delete_school\" value=\"$row[0]\" /> <input type=\"submit\" name=\"schoolSubmit\" value=\"Delete\" /> </form> </th> </td>";
		echo "</tr>";
	}
	mysql_close($conn);
?>
 
<br> <h2>Delete School<h2> <hr> <br>
		
<?php
	require 'dbConnection.php';
	
	$sql = "select Name, Level, CourseTitle, CourseCode from Course JOIN School on Course.SchoolID = School.SchoolID;";
	$result = mysql_query($sql);

	if (!$result) {
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	echo "<table border='1'>
	<tr>
	<th>School Name</th>
	<th>Level</th>
	<th>Course Title</th>
	<th> Delete </th>
	</tr>";
	
	while ($row = mysql_fetch_row($result)) {
		
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td>" . $row[2] . "</td>";
		echo "<td> <form action=\"?\" method=\"post\"> <input type=\"hidden\" name=\"delete_course\" value=\"$row[3]\" /> <input type=\"submit\" name=\"courseSubmit\" value=\"Delete\" /> </form> </th> </td>";
		echo "</tr>";
	}
	mysql_close($conn);
?>
		
<br> <h2>Delete Course <h2> <hr> <br>    

		
<?php
	require 'dbConnection.php';
	
	
	$sql = "select ModuleTitle, Description, CourseTitle, Module.ModuleCode from Module JOIN CourseModule JOIN Course ON Module.ModuleCode = CourseModule.ModuleCode AND CourseModule.CourseCode = Course.CourseCode;";
	$result = mysql_query($sql);

	if (!$result) {
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	echo "<table border='1'>
	<tr>
	<th>Module Title</th>
	<th>Description</th>
	<th>Course Title</th>
	<th> Delete </th>
	</tr>";
	
	while ($row = mysql_fetch_row($result)) {
		
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td>" . $row[2] . "</td>";
		echo "<td> <form action=\"?\" method=\"post\"> <input type=\"hidden\" name=\"delete_module\" value=\"$row[3]\" /> <input type=\"submit\" name=\"moduleSubmit\" value=\"Delete\" /> </form> </th> </td>";
		echo "</tr>";
	}
	mysql_close($conn);
?>

<br> <h2>Delete Module<h2> <hr> <br>

<?php
	require 'dbConnection.php';
	
	
	$sql = "select KeySkills.KSID, KeySkills.Description, Course.CourseTitle from KeySkills JOIN CourseKeySkills JOIN Course ON KeySkills.KSID = CourseKeySkills.KSID AND CourseKeySkills.CourseCode = Course.CourseCode;";
	$result = mysql_query($sql);

	if (!$result) {
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	echo "<table border='1'>
	<tr>
	<th>Key Skills Title</th>
	<th>Description</th>
	<th>Course Title</th>
	<th> Delete </th>
	</tr>";
	
	while ($row = mysql_fetch_row($result)) {
		
		echo "<tr>";
		echo "<td>" . $row[0] . "</td>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td>" . $row[2] . "</td>";
		echo "<td> <form action=\"?\" method=\"post\"> <input type=\"hidden\" name=\"delete_skill\" value=\"$row[0]\" /> <input type=\"submit\" name=\"skillSubmit\" value=\"Delete\" /> </form> </th> </td>";
		echo "</tr>";
	}
	mysql_close($conn);
?>

<br> <h2>Delete Key Skills <h2> <hr> <br>

<?php

	require 'dbConnection.php';
	
	if($_POST['schoolSubmit']) {
		 
		$schoolName = $_POST['delete_school'];
		if( $schoolName )
			mysql_query("Delete FROM `u733886938_mel`.`School` where schoolID = '$schoolName';");
		
		mysql_close($conn);
	}
	
	
	if($_POST['courseSubmit']) {
		
		$course = $_POST['delete_course'];
		
		if($course) 
			mysql_query("Delete FROM `u733886938_mel`.`CourseModule` WHERE `CourseCode` = $course;");
		
		
		mysql_close($conn);
		
		include 'dbConnection.php';

		if( $course ) 
			mysql_query("Delete FROM `u733886938_mel`.`CourseKeySkills` WHERE `CourseCode` = '$course';");
		
		
		mysql_close($conn);
		
		include 'dbConnection.php';

		if( $course ) 
			mysql_query("Delete FROM `u733886938_mel`.`Module` WHERE ModuleCode in (Select ModuleCode from CourseModule where `CourseCode` = '$course';");
		
		
		mysql_close($conn);
		
		include 'dbConnection.php';

		if( $course ) 
			mysql_query("Delete FROM `u733886938_mel`.`KeySkills` WHERE KSID in (Select KSID from CourseKeySkills where `CourseCode` = '$course';");
		
		mysql_close($conn);
		
		include 'dbConnection.php';

		if( $course ) 
			mysql_query("Delete FROM `u733886938_mel`.`Course` WHERE `CourseCode` = '$course';");
		
		mysql_close($conn);
	}
	
	if($_POST['moduleSubmit']) {
		
		$module = $_POST['delete_module'];
		
		if($module) 
			mysql_query("Delete FROM `u733886938_mel`.`CourseModule` WHERE `Module` = $module;");
		
		
		mysql_close($conn);
		
		include 'dbConnection.php';

		if( $module ) 
			mysql_query("Delete FROM `u733886938_mel`.`Module` WHERE `ModuleCode` = '$module';");
		
		mysql_close($conn);
	}
	
	if($_POST['skillSubmit']) {
		
		$skill = $_POST['delete_skill'];
		
		if($skill) 
			mysql_query("Delete From `u733886938_mel`.`CourseKeySkills` WHERE `KSID` = $skill;");
		
		mysql_close($conn);
		
		
		include 'dbConnection.php';

		if( $skill ) 
			mysql_query("Delete from `u733886938_mel`.`KeySkills` WHERE `KSID` = $skill;");
	
		
		mysql_close($conn);
	}
	
	

?>



	
</body>

</html>