<html>

<head>
	<style>
	.divStyle {
		border-radius: 5px;
		padding: 20px; 
	}
	
	hr {
		border: 0;
		height: 1px;
		background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
		background-image:    -moz-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
		background-image:     -ms-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
		background-image:      -o-linear-gradient(left, rgba(0,0,0,0), rgba(0,0,0,0.75), rgba(0,0,0,0));
	}
	
	input {
	  font-family: Arial;
	  font-size: 14px;
	}

	input[type=text], input[type=password] {
	  margin: 5px;
	  padding: 0 10px;
	  width: 200px;
	  height: 34px;
	  color: #404040;
	  background: white;
	  border: 1px solid;
	  border-color: #c4c4c4 #d1d1d1 #d4d4d4;
	  border-radius: 2px;
	  outline: 5px solid #eff4f7;
	  -moz-outline-radius: 3px; // Can we get this on WebKit please?
	  @include box-shadow(inset 0 1px 3px rgba(black, .12));

	  &:focus {
		border-color: #7dc9e2;
		outline-color: #dceefc;
		outline-offset: 0; // WebKit sets this to -1 by default
	  }
	}

	select {
		padding:3px;
		margin: 0;
		-webkit-border-radius:4px;
		-moz-border-radius:4px;
		border-radius:4px;
		-webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
		-moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
		box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
		background: #f8f8f8;
		color:#888;
		border:none;
		outline:none;
		display: inline-block;
		-webkit-appearance:none;
		-moz-appearance:none;
		appearance:none;
		cursor:pointer;
	}
	
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		select {padding-right:18px}
	}

	label {position:relative}
	label:after {
		content:'<>';
		font:11px "Consolas", monospace;
		color:#aaa;
		-webkit-transform:rotate(90deg);
		-moz-transform:rotate(90deg);
		-ms-transform:rotate(90deg);
		transform:rotate(90deg);
		right:8px; top:2px;
		padding:0 0 2px;
		border-bottom:1px solid #ddd;
		position:absolute;
		pointer-events:none;
	}
	label:before {
		content:'';
		right:6px; top:0px;
		width:20px; height:20px;
		background:#f8f8f8;
		position:absolute;
		pointer-events:none;
		display:block;
	}
	
	.container {
        width: 950px;
        clear: both;
		margin:0 auto;
    }
    .container input {
        width: 100%;
        clear: both;
    }

	p {
		
		font-weight: bold;
		font-size: 20px;
		text-decoration: underline;
	}
	
	input[type=submit]{
		width:60px; /*same as the height*/
		height:60px; /*same as the width*/
		background-color:#35b128;
		border:1px solid #35b128; /*same colour as the background*/
		color:#fff;
		font-size:1em;
		-webkit-border-radius: 50px;
		-moz-border-radius: 50px;
		border-radius: 50px;
		-webkit-box-shadow: 0 0 10px rgba(0,0,0, .75);
		-moz-box-shadow: 0 0 10px rgba(0,0,0, .75);
		box-shadow: 2px 2px 15px rgba(0,0,0, .75);
		float: right;
	}
	
	input[type=submit]:hover{
		background:#1a5814;
		border:1px solid #1a5814;
		-webkit-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
		-moz-box-shadow: 0px 0px 5px rgba(0,0,0, .75);
		box-shadow: 0px 0px 5px rgba(0,0,0, .75);
	}
	
	h2 {
		margin: 1em 0 .6em 0;
		padding: 0 0 0 20px;
		font-weight: normal;
		color: Black;
		font-family: Arial;
		text-shadow: 0 -1px 0 rgba(10,20,30,0.4);
		position: relative;
		font-size: 30px;
		line-height: 40px;
		text-align: center;
		border: 1px dashed #ddd;
		box-shadow: 0 0 0 3px #fff, 0 0 0 5px #ddd, 0 0 0 10px #fff, 0 0 2px 10px #eee;
		background-color:#cde364;
	}
	
	</style>
</head>

<body>

<div class="container">


<div class="divStyle" id="school">
<h2> Add New School </h2>
<form action="?" method="POST">
<p>School Name: </p>
<input type="text" name="schoolName" />
<input type="submit" name="schoolSubmit" value="Submit">
</form>
</div>

<hr>

<div class="divStyle" id="Course">
<h2> Add New Course </h2>
<form action="?" method="POST">
<p>Select School:</p>
<label>
	<select name="schoolSelect" >
	
		<option selected> *None* </option>
        
		<?php
			require 'dbConnection.php';
			
			$sql = "select * from School";
			$result = mysql_query($sql);

			if (!$result) {
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}

			while ($row = mysql_fetch_row($result)) {
				
				echo "<option value=\"{$row[0]}\" > {$row[1]} </option>";

			}
			mysql_close($conn);
		
		?>
        
    </select>
</label>


<br>

<p>Choose Level:</p>
<label>
	<select name="levelSelect">
        <option selected> *None* </option>
        <option value="Undergraduate"> Undergraduate </option>
    </select>
</label>



<br>

<p>Course Title: </p>
<input type="text" name="courseName" />
<input type="submit" name="courseSubmit" value="Submit">
</form>
</div>

<hr>









<div class="divStyle" id="Module">
<h2> Add New Module </h2>

<form action="?" method="POST">

<p>Select Course:</p>
<label>
	<select name="courseSelect_mod">
        <option selected> *None* </option>
        
		<?php
			require 'dbConnection.php';
			
			$sql = "select CourseCode, CourseTitle from Course";
			$result = mysql_query($sql);

			if (!$result) {
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}

			while ($row = mysql_fetch_row($result)) {
				
				echo "<option value=\"{$row[0]}\" > {$row[1]} </option>";

			}
			mysql_close($conn);
		
		?>
    </select>
</label>
<br>
<p>Module Code: </p>
<input type="text" name="moduleCode" /> <br>

<p>Module Title: </p>
<input type="text" name="moduleTitle" /> <br>

<p>Module Description: </p>
<input type="text" name="moduleDesc" /> <br>

<p>Year:</p>
<input type="text" name="moduleYear" /> 
<input type="submit" name="moduleSubmit" value="Submit">
</form>
</div>









<hr>

<div class="divStyle" id="KeySkills">
<h2> Add New Key Skill </h2>

<form action="?" method="POST">

<p>Select Course:</p>
<label>
	<select name="courseSelect_skills">
        <option selected> *None* </option>
        <?php
			require 'dbConnection.php';
			
			$sql = "select CourseCode, CourseTitle from Course";
			$result = mysql_query($sql);

			if (!$result) {
				echo 'MySQL Error: ' . mysql_error();
				exit;
			}

			while ($row = mysql_fetch_row($result)) {
				
				echo "<option value=\"{$row[0]}\" > {$row[1]} </option>";

			}
			mysql_close($conn);
		
		?>
    </select>
</label>
<br>

<p>Skill Name:</p> 
<input type="text" name="skillTitle" /> <br>

<p>Skill Description: </p>
<input type="text" name="skillDesc" /> <br>


<input type="submit" name="skillSubmit" value="Submit">
</form>
</div>

<hr>

<?php

	require 'dbConnection.php';
	
	if($_POST['schoolSubmit']) {
		 
		$schoolName = $_POST['schoolName'];
		if( $schoolName )
			mysql_query("INSERT INTO  `u733886938_mel`.`School` ( `SchoolID` , `Name` ) VALUES ( NULL ,  '$schoolName' );");
		else
			echo "alert('Please enter school name first');";
		
	}
	
	
	if($_POST['courseSubmit']) {
		
		$school = $_POST['schoolSelect'];
		$level = $_POST['levelSelect'];
		$course = $_POST['courseName'];
		
		if($school && $level && $course) 
			mysql_query("INSERT INTO  `u733886938_mel`.`Course` ( `CourseCode` , `SchoolID` , `Level` , `CourseTitle` ) VALUES ( NULL ,  '$school',  '$level',  '$course' );");
		else
			echo "alert('Please enter school/level/course name first');";
	}
	
	if($_POST['moduleSubmit']) {
		
		$course = $_POST['courseSelect_mod'];
		$code = $_POST['moduleCode'];
		$title = $_POST['moduleTitle'];
		$desc = $_POST['moduleDesc'];
		$year = $_POST['moduleYear'];
		
		if($code && $title && $desc && $year) 
			mysql_query("INSERT INTO  `u733886938_mel`.`Module` ( `ModuleCode` , `ModuleTitle` , `Description` , `Year` ) VALUES ( '$code' ,  '$title',  '$desc',  '$year' );");
		else
			echo "alert('Please enter module code/title/description/year first');";

		mysql_close($conn);
		
		
		include 'dbConnection.php';

		if( $course && $code ) 
			mysql_query("INSERT INTO  `u733886938_mel`.`CourseModule` ( `CourseCode` , `ModuleCode` ) VALUES ( '$course', '$code' );");
		else
			echo "alert('Please enter course/module name first');";
	
	}
	
	if($_POST['skillSubmit']) {
		
		$course = $_POST['courseSelect_skills'];
		$title = $_POST['skillTitle'];
		$desc = $_POST['skillDesc'];
		
		if($title && $desc ) 
			mysql_query("INSERT INTO  `u733886938_mel`.`KeySkills` ( `KSID` , `Description` ) VALUES ( '$title',  '$desc' );");
		else
			echo "Please enter skill code/title/description/year first";

		mysql_close($conn);
		
		
		include 'dbConnection.php';

		if( $course && $title ) 
			mysql_query("INSERT INTO  `u733886938_mel`.`CourseKeySkills` ( `CourseCode` , `KSID` ) VALUES ( '$course', '$title' );");
		else
			echo "$course $title";
	}
	
	
	mysql_close($conn);

?>

</div>

</body>

</html>