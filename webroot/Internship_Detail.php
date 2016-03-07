<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<?php $posname = $_GET["posname"]; ?>
<title><?php echo $posname; ?></title>
<style type="text/css">
.auto-style1 {
    text-align: right;
}
</style>
</head>

<body style="width: 610px; height: 700px">
<?php
$ID = $_GET["id"];
$ORGN = $_GET["orgName"];

include '../include/db_connect.php';

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Unable to select database" . mysql_connect_error());
}
$sql="SELECT * FROM internship WHERE IntershipId = $ID";
$result=mysqli_query($conn, $sql);
$num=mysqli_num_rows($result); 


//if($num < 1 ) {
//echo "0 results";
//}else {
        $i=0;
		while($row = mysqli_fetch_assoc($result)) {
		$intshpid = $row['IntershipId'];
		$pos = $row['PositionTitle'];
		$desc = $row['Description'];
		$orgid = $row['OrganizationId'];
        $state = $row['LocationState'];
        $zip = $row['LocationZip'];
        $posted = $row['DatePosted'];
		$sdate = $row['StartDate'];
		$edate = $row['EndDate'];
		$slots = $row['SlotsAvailable'];
		$last = $row['LastUpdated'];
		
		$i++;
}

$sql2="SELECT * FROM organization WHERE OrganizationId = $orgid";
$result2=mysqli_query($conn, $sql2);
$num=mysqli_num_rows($result2);
        $i=0;
    	while($row = mysqli_fetch_assoc($result2)) {
		$orgn = $row['OrganizationName'];
        $i++;
    	}
mysqli_close($conn);


$pid = $ID-1;
$nid = $ID+1;
#$prev= "http://electronat.com/Internship_Detail.php?id=$pid";
#$next= "http://electronat.com/Internship_Detail.php?id=$nid";
$prev= "Internship_Detail.php?id=$pid";
$next= "Internship_Detail.php?id=$nid";

$orgPage= "Organization_detail.php?id=$orgid";

?>
<h1><?php echo $pos; ?></h1>
<div>
	<table style="width: 100%" cellspacing="1">
		<tr>
			<td style="height: 45px; width: 275px" class="auto-style1">Organization: </td>
			<td style="height: 45px"> 
			<form action="" method="post" name="Organization" style="width: 229px">
            <a href='<?php echo $orgPage; ?>'><?php echo $orgn ?></a> 
            </form>
			</td>
		</tr>
		<tr>
			<td style="width: 275px; height: 45px" class="auto-style1">Position Title: </td>
			<td style="height: 45px"> 
			<form action="" method="post" name="Position Title" style="width: 229px">
<?php echo $pos; ?></form>
			</td>
		</tr>
		<tr>
			<td style="width: 275px" class="auto-style1">Posted Date: </td>
			<td> 
			<form action="" method="post" name="postedDate" style="width: 229px">
<?php echo $posted; ?></form>
			</td>
		</tr>
		<tr>
			<td style="width: 275px" class="auto-style1">Start & End Date: </td>
			<td> 
			<form action="" method="post" name="Slots" style="width: 228px">
<?php echo $sdate." to ". $edate ?></form>
			</td>
		</tr>
		<tr>
			<td style="width: 275px" valign="top" class="auto-style1">Location:</td>
			<td>
            <?php echo $state."  ". $zip ?>
			&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 275px" class="auto-style1" valign="top">Description:</td>
			<td> 
<form action="" method="post" name="Description" style="width: 451px; height: 236px">
			<?php echo $desc; ?></form>
			</td>
		</tr>
		<tr>
			<td style="width: 275px" class="auto-style1">&nbsp;last updated: </td>
			<td> 
			<form action="" method="post" name="last updated" style="width: 146px">
<?php echo $last; ?>
</form>
			</td>
		</tr>
	</table>
</div>
<p>
<form method="post">
	<input name="prev_button" type="button" value="prev" onClick="location.href='<?php echo $prev ?>'" />
    <input name="next_button" type="button" value="next" onClick="location.href=' <?php echo $next ?> '" />&nbsp;&nbsp;&nbsp;
	<input name="list_view" style="width: 96px" type="button" value="list view" onClick="location.href=' Internship_List.php?id=<?php echo $ID ?> '"/></form>
</p>

</body>

</html>
