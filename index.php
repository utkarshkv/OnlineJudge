<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Judge</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Online Judge: Upload ur file</h2>

<?php
require_once('appvars.php');
require_once('connectvars.php');

if (isset($_POST['submit'])) 
{
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $fileupload = mysqli_real_escape_string($dbc, trim($_FILES['fileupload']['name']));
    $fileupload_type = $_FILES['fileupload']['type'];
    $fileupload_size = $_FILES['fileupload']['size']; 

    if (!empty($fileupload)) 
    {
        if ((($fileupload_type == 'text/x-c++src') || ($fileupload_type == 'c')) && ($fileupload_size > 0) && ($fileupload_size <= GW_MAXFILESIZE))
        {
            if ($_FILES['fileupload']['error'] == 0)
            {        // Move the file to the target upload folder
                $target = GW_UPLOADPATH . $fileupload;
                if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target))
                {
                    $query = "INSERT INTO online (upload_date, fileupload) VALUES (NOW(), '$fileupload')";
                    mysqli_query($dbc, $query);

                    Header("Location: codes/compile.php");

                    $fileupload = "";

                    mysqli_close($dbc);
                }
                else
                    echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
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
        echo '<p class="error">Please enter all of the information to add your high score.</p>';
}
?>

<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
<label for="fileupload">File Upload:</label>
<input type="file" id="fileupload" name="fileupload" />
<hr />
<input type="submit" value="Add" name="submit" />
</form>
</body>
</html>
