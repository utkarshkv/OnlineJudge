<?php
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT fileupload from online ORDER BY upload_date DESC LIMIT 1";
$data=mysqli_query($dbc,$query) or die('Error sending query to the server..!!');
$row=mysqli_fetch_array($data);
$filename = $row['fileupload'];
echo '<p>Output:</p>';
$cmd='g++ '.$filename.' 2>&1';
$output = shell_exec($cmd);
echo $output;
//if($output == ""){
    $output = shell_exec('./a.out < submin.txt');
    echo $output;
//}
?>
