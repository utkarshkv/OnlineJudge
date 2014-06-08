<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<title>Jadavpur University Online Judge</title>


<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

$(document).ready(function(){
   $(".LoginLink").click(function () {
      $('#login').slideToggle(1000);
   });
});

$(document).ready(function(){
   $(".login-button").click(function () {
      $('#login').slideToggle(1000);
   });
});
 /*$(document).ready(function(){
$(":submit").click(function(e){
 e.preventDefault();
 alert( $("textarea[name=textEditor]").val());
});
})*/;

</script>


<link rel="stylesheet" type="text/css" href="ui.css">

</head>

<?php
session_start(); //session start don't know where to destroy

$ques_code=$_SESSION['code']; /*question code from previous page*/

require_once('appvars.php');
require_once('connectvars.php');



/*$query="select q_code from question_code_submission where q_num='".$ques_code."' ";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$temp_name=mysqli_query($dbc, $query);
$code_name=$temp_name->fetch_object()->q_code;
mysqli_close($dbc);*/



/***************PDO PHP to prevent sql injections****************/


$host_name='localhost';
$dbname='onj';
$dbuser='root';
$dbpass='12345';

try{
	$host="mysql:host=".$host_name.";dbname=".$dbname; 
	$dbh = new PDO($host, $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$S=$dbh->prepare("SELECT q_code FROM question_code_submission WHERE q_num = :id");
	$S->bindParam(':id', $ques_code);
	$S->execute();
	$temp_name=$S->fetch();
	$code_name=$temp_name['q_code'];
}
catch (PDOException $e) {
    echo $e->getMessage();
}

/***END***/





// FILE UPLOAD
if (!empty($_FILES['fileupload']['name'])) 
{
	echo 'hello';
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $fileupload = mysqli_real_escape_string($dbc, trim($_FILES['fileupload']['name']));
    $fileupload_type = $_FILES['fileupload']['type'];
    $fileupload_size = $_FILES['fileupload']['size']; 
	

    if (!empty($fileupload)) 
    {
	    
        if ((($fileupload_type == 'text/plain') || ($fileupload_type == 'c')) && ($fileupload_size > 0) && ($fileupload_size <= GW_MAXFILESIZE))
        {
            if ($_FILES['fileupload']['error'] == 0)
            {      
                $target = GW_UPLOADPATH . $fileupload;
				$file_c='test_code.c';
				$file_cpp='test_code.cpp';
				$lan_val=$_POST['language'];
				if($lan_val==='C(gcc-4.8.1)')
				{
					$target = GW_UPLOADPATH.$file_c;
					if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
					{
						$temp='test_code.c';
						$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
						mysqli_query($dbc, $query);
						
						$query_count="SELECT COUNT(*) from ".$code_name."";
						$result=mysqli_query($dbc, $query_count);
						$c = mysqli_fetch_row($result);
						$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
						mysqli_query($dbc,$query_submit);
						
						header("Location: codes/compile_c_4.8.php");
					}
				}
				else if($lan_val==='C99 strict(gcc-4.8.1)')
				{
					$target = GW_UPLOADPATH.$file_c;
					if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
					{
						$temp='test_code.c';
						$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
						mysqli_query($dbc, $query);
						
						$query_count="SELECT COUNT(*) from ".$code_name."";
						$result=mysqli_query($dbc, $query_count);
						$c = mysqli_fetch_row($result);
						
						$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
						mysqli_query($dbc,$query_submit);
						
						header("Location: codes/compile_c99.php");
					}
				}
				else if($lan_val==='C++(gcc-4.3.2)')
				{
					$target = GW_UPLOADPATH.$file_cpp;
					if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
					{
						$temp='test_code.cpp';
						$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
						mysqli_query($dbc, $query);
						
						$query_count="SELECT COUNT(*) from ".$code_name."";
						$result=mysqli_query($dbc, $query_count);
						$c = mysqli_fetch_row($result);
						
						$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
						mysqli_query($dbc,$query_submit);
						
						header("Location: codes/compile_cpp.php");
					}
				}
				else if($lan_val==='C++(gcc-4.8.1)')
				{
					$target = GW_UPLOADPATH.$file_cpp;
					if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
					{
						$temp='test_code.cpp';
						$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
						mysqli_query($dbc, $query);
						
						$query_count="SELECT COUNT(*) from ".$code_name."";
						$result=mysqli_query($dbc, $query_count);
						$c = mysqli_fetch_row($result);
						
						$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
						mysqli_query($dbc,$query_submit);
						
						header("Location: codes/compile_cpp.php");
					}
				}
				else if($lan_val==='C++11(gcc-4.8.1)')
				{
					$target = GW_UPLOADPATH.$file_cpp;
					if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
					{
						$temp='test_code.cpp';
						$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
						mysqli_query($dbc, $query);
						
						$query_count="SELECT COUNT(*) from ".$code_name."";
						$result=mysqli_query($dbc, $query_count);
						$c = mysqli_fetch_row($result);
						
						$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
						mysqli_query($dbc,$query_submit);
						
						header("Location: codes/compile_cpp11.php");
					}
				}
                $fileupload = "";
                mysqli_close($dbc);
            }
        }  
        else 
        {        
            echo '<p class="error">The file must be a CPP or C file not greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
            echo $fileupload_type.'<br />';
            echo $fileupload_size;
        }

        @unlink($_FILES['fileupload']['tmp_name']);
    }
    else
        echo '<div class="error">Either insert your source code in the textarea below or choose a file to upload.</div>';
}
else if(isset($_POST['submit_']))     /*checks if submit button is clicked */
{


	/****************************PHP SESSIONS TO RETRIVE THE CONTENT OF TEXT AREA AND PRINT THE SAME IN THE REDIRECTED PAGE*************************/
	
	/*if(!empty($_POST['textEditor']))   		//checks if textEditor is non-empty 
	{
		$msg=$_POST['textEditor'];     		//retrieve the content of textarea 
		$temp=1;								//temporary variable 
		$_SESSION['temp']=$msg;				//php sessions
		header("Location: output.php");   	// header to particular location with the session 
	}*/
	
	/************************************END****************************************/
	
	
	
	
	
	/********** TEXT EDITOR CONTENT PRINT*************/
	
	$file='codes/test_code.c';
	if(!empty($_POST['textEditor']))
	{
		$msg=$_POST['textEditor'];
		$ret=file_put_contents($file, $msg);
		$target = GW_UPLOADPATH;
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if(isset($_POST['language']))
		{
				$lan_val=$_POST['language'];
				if($lan_val==='C(gcc-4.8.1)')
				{
					$temp='test_code.c';
					$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
					mysqli_query($dbc, $query);
					
					$query_count="SELECT COUNT(*) from ".$code_name."";
					$result=mysqli_query($dbc, $query_count);
					$c = mysqli_fetch_row($result);
						
					$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
					mysqli_query($dbc,$query_submit);
					
					header("Location: codes/compile_c_4.8.php");
				}
				else if($lan_val==='C99 strict(gcc-4.8.1)')
				{
					$temp='test_code.c';
					$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
					mysqli_query($dbc, $query);
					
					$query_count="SELECT COUNT(*) from ".$code_name."";
					$result=mysqli_query($dbc, $query_count);
					$c = mysqli_fetch_row($result);
						
					$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
					mysqli_query($dbc,$query_submit);
					
					header("Location: codes/compile_c99.php");
				}
				else if($lan_val==='C++(gcc-4.3.2)')
				{
					rename("codes/test_code.c", "codes/test_code.cpp");
					$temp='test_code.cpp';
					$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
					mysqli_query($dbc, $query);
					
					$query_count="SELECT COUNT(*) from ".$code_name."";
					$result=mysqli_query($dbc, $query_count);
					$c = mysqli_fetch_row($result);
						
					$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
					mysqli_query($dbc,$query_submit);
					
					header("Location: codes/compile_cpp.php");
				}
				else if($lan_val==='C++(gcc-4.8.1)')
				{
					rename("codes/test_code.c", "codes/test_code.cpp");
					$temp='test_code.cpp';
					$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
					mysqli_query($dbc, $query);
					
					$query_count="SELECT COUNT(*) from ".$code_name."";
					$result=mysqli_query($dbc, $query_count);
					$c = mysqli_fetch_row($result);
						
					$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
					mysqli_query($dbc,$query_submit);
					
					header("Location: codes/compile_cpp.php");
				}
				else if($lan_val==='C++11(gcc-4.8.1)')
				{
					rename("codes/test_code.c", "codes/test_code.cpp");
					$temp='test_code.cpp';
					$query="INSERT INTO ".$code_name." (upload_date,fileupload) VALUES (NOW(), '$temp')";
					mysqli_query($dbc, $query);
					
					$query_count="SELECT COUNT(*) from ".$code_name."";
					$result=mysqli_query($dbc, $query_count);
					$c = mysqli_fetch_row($result);
						
					$query_submit="UPDATE question_code_submission SET q_subm = ".$c[0]." WHERE q_code = '$code_name'";
					mysqli_query($dbc,$query_submit);
					
					header("Location: codes/compile_cpp11.php");
				}
		}			
		$file="";
		mysqli_close($dbc);
		if(file_exists($file))
			unlink($file);
	}
}
?>

<body class="body">

		<div class="header_base">
				<a href="#" class="LoginLink">Student Login/Register</a>
	    </div>
		<div id="login">
				<p class="student-login">Student Login</p>
				<input type="text" class="input" onfocus="if(this.value == 'Username ') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Username '; }" name="s" value="Username ">
				<input type="text" class="inputpassword" onfocus="if(this.value == 'Password ') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Password '; }" name="s" value="Password ">
				<a href="#"><img src="login-button.gif" class="login-button"></img></a>
		</div>


		<div class="container">
				<img class="logo" alt="Jadavpur University" src="l.png" align="top"><p class="ju" >Jadavpur University<br /> Online Judge</p>
				<!--<div class="header_curve">-->
						<!--<img class="trust" src="badge.png" alt="e-trust"></img>-->
				<!--</div>-->

				<div class="insideContainer">
						<font face="Verdana"></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please insert your source code:</font>
						<?php
							echo '<div class="code_div">'.$code_name.'</div>';
						?>
						<div class="text_editor_container">
									<a id="bold" class="font-bold">B</a>&nbsp;&nbsp;&nbsp;<a id="italic" class="italic">I</a>&nbsp;&nbsp;&nbsp;&nbsp;
									<select id="fonts">
											<option value="Arial">Arial</option>
											<option value="Comic Sans MS">Comic Sans MS</option>
											<option value="Courier New">Courier New</option>
											<option value="Monotype Corsiva">Monotype</option>
											<option value="Tahoma">Tahoma</option>
											<option value="Times">Times</option>
									</select>
									</br>
									<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
											<textarea name="textEditor" rows="20" cols="60" style="resize:none;"></textarea></br></br>
											<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />&nbsp;
											<label for="fileupload"><font face="verdana"><font size="2px">File Upload:</font></label>
											<input type="file" id="fileupload" name="fileupload" />
											<input type="submit" name="submit_" value="Submit" />
									</br></br>
									<font face="Verdana"><font size="2px">&nbsp;&nbsp;Language:</font> <font color="red">*</font>
									<select name="language" class="selectLanguage">
											<option value="C(gcc-4.8.1)">C(gcc-4.8.1)</option>
											<option value="C99 strict(gcc-4.8.1)">C99 strict(gcc-4.8.1)</option>
											<option value="C++(gcc-4.3.2)">C++(gcc-4.3.2)</option>
											<option value="C++(gcc-4.8.1)">C++(gcc-4.8.1)</option>
											<option value="C++11(gcc-4.8.1)">C++11(gcc-4.8.1)</option>
											<option value="Text(pure text)">Text(pure text)</option>
									</select> 
									</form>         
						</div>
                </div>
        </div>
		<p class="footer">Copyright 2014 &#169; Jadavpur University. All Rights Reserved</p>
</body>

</html>
