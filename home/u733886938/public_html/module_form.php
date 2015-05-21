<html>

<head>

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="./js/sweetalert.min.js"></script>
	
	<script>
	
		function unique(list) {
			var result = [];
			$.each(list, function(i, e) {
				if ($.inArray(e, result) == -1) result.push(e);
			});
			return result;
		}
	
	</script>
	
	
    <script>
	
	function FadeInOutCourses(id, checked) {

		$.ajax({
			type: 'post',
			url: 'courseFadeIn.php',
			data: { "id": id },
			success: function (data) {
				
				var array = data.split(',');
				var i;
					
				if (checked) {
					
					//alert("true = " + id + "  " + array.length + "\n" + data);
					
					for(i=0; i<array.length-1; i++){
					
						document.getElementById(array[i]).style.fontSize  = '10px';
					}
					//alert('array: ' + array + '  ' + array.length);
					
					var mediumCount = 0;
					var mediumList = [];
					$('.coursesSelection').each(function(){
						
						if (this.style.fontSize == '17px'){
							mediumCount++;
							mediumList.push(this.id);
						}
					});
					
					
					if(mediumCount == 1) {
							
						$('.checkBoxSelection').each(function(){
						
							if(this.checked == false) {
								
								this.disabled = true;
							}
							
						});
						
						//alert('You have found a suitable course \n' + document.getElementById(mediumList[0]).getAttribute('name'));
						swal(document.getElementById(mediumList[0]).getAttribute('name'), "According to selected modules, this seems to be a suitable course!\nYou can unselect modules to get other suggestions too.", "success");
						
						
						//location.reload();
					}
					
					
				}else {
					
					var all = [];
					$('.coursesSelection').each(function(){
						
						all.push(this.id);
						
					});
					
					
					var medium = $.grep(all, function(el){return $.inArray(el, array) == -1});
					
					var i;
					for(i=0; i<medium.length; i++){
					
						document.getElementById(medium[i]).style.fontSize  = '17px';
					}
					
					
					
					
				}
				

			}
		});
	}
	
	</script>
	
	
	<script>
		$(document).ajaxStart(function(){
          $("#loadingDiv").css("display","block");
        });
        $(document).ajaxComplete(function(){
          $("#loadingDiv").css("display","none");
        });
	</script>
	
	
	<script>
		var globalModulesList = "";
	</script>
	
	
	<script>
	
	
	function checkCheckboxState(id, checked, labelID) {
		
		if (checked) {
			
			$.ajax({
				type: "POST",
				url: 'module_disable.php',
				data: { "id": id },
				success: function(data) {
					
					var array = data.split(',');
					var i;
					for(i=0; i<array.length-1; i++){
					
						document.getElementById(array[i]).disabled = true;
					}
					
					FadeInOutCourses(id, true);	//make irrelevant courses smaller
				}
			});
			
		} else {
		//01715090445
			var uniqueIDs = [];
			
			$('.checkBoxSelection').each(function()
			{
				if (this.checked) {
					
					var currID = this.id;
					
					$.ajax({
						type: "POST",
						url: 'module_disable.php',
						data: { "id": currID },
						success: function(data) {
							globalModulesList += data;
						},
						async: false
					});
					
					FadeInOutCourses(currID, false);
				}
				
			});
			
			var array = globalModulesList.split(","); array.pop(); globalModulesList = "";
			
			var arrayCopy = unique(array); var i; var allChecks = [];
			$('.checkBoxSelection').each(function(){
				allChecks.push(this.id);
			});

			var mediumCheck = $.grep(allChecks, function(el){return $.inArray(el, arrayCopy) == -1});

			for(i=0; i<mediumCheck.length; i++){
			
				document.getElementById(mediumCheck[i]).disabled = false;
			}
			
			
			
			if( array.length == 0) {
				$('.checkBoxSelection').each(function(){
					this.disabled = false;
				});
				$('.coursesSelection').each(function(){
					this.style.fontSize = '17px';
				});
			} 
		}
	}
    </script>
	
	<script>
	
	function toggle(descpID) {
		
		$( '[name="'+descpID+'"]' ).slideToggle( "slow" );
	}
	
	</script>
	
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/facebook.css"> -->
	
	<style>
	
	#background {
		
		background-image: url("./images/SkillsMixer_0017_SELECT-BY-MODULE.png");
		background-repeat: no-repeat;
		width: 1024px;
		height: 768px;
		display: block;
		margin-left: auto;
		margin-right: auto;
		margin: 0 auto;
	}
	
	
	#moduleCourseListdiv{
		
		position: relative;
		top: 25%;
		left: 5%;
		height: 550px;
		width: 92.5%;
		overflow: auto;
	}
	

	#moduleListdiv{
	 
		width: 50%;
	}
	
	#coursesListdiv{
		
		position: absolute; 
		top: 0px; 
		right: 2%;
	}
	
	.descriptionClass {
		
		border-radius: 25px;
		border: 2px solid #8AC007;
		padding: 10px;
		text-align: justify;
		text-justify: inter-word;
		background-color: #FFFFFF;
	}
	
	body {
		
		font-family: Arial;
		font-size: 17px;
		font-style: normal;
		
	}
	</style>
	
	
  </head>
<body>

<div id="background">


<div id='loadingDiv' style="display:none; position:absolute; top: 50%; left: 50%">
    <img src='http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_3.gif' /> <p style="color: #FDBB30"> Loading... </p>
</div> 

<div id="moduleCourseListdiv">

<div id="moduleListdiv">

<img src="./images/SkillsMixer_0015_MODULE.png">

<br> <br>

<form>

<?php
require 'dbConnection.php';

$sql = "select ModuleCode, ModuleTitle, Description from Module";
$result = mysql_query($sql);

if (!$result) {
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
   
echo "<input class=\"checkBoxSelection\" type=\"checkbox\" name=\"moduleGroup[]\" id=\"{$row[0]}\" value=\"{$row[0]}\" onchange=\"checkCheckboxState(this.id, this.checked, '{$row[1]}')\" /> <label id=\"{$row[1]}\" onclick=\"toggle('{$row[0]}')\" > {$row[1]} </label> <p class=\"descriptionClass\" name=\"{$row[0]}\" style=\"display: none;\"> {$row[2]} </p> </br>";
}

mysql_close($conn);
?>

</form>
</div>

<div id="coursesListdiv"> 

<img src="./images/SkillsMixer_0016_COURSE.png">

<?php
require 'dbConnection.php';

$sql = "select CourseCode, CourseTitle from Course";
$result = mysql_query($sql);

if (!$result) {
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    
	echo "<p style=\"font-size: 17px;\" class=\"coursesSelection\" id=\"{$row[0]}\" name=\"{$row[1]}\" > {$row[1]} </p> ";

}
mysql_close($conn);
?>
</div>
</div>
</div>

</body>

</html>