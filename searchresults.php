<?php
	include "dbconnect.php";

	if(isset($_POST['search'])){
		$searchq = $_POST['search'];
		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

		$query = mysql_query("SELECT * FROM media WHERE filename LIKE '%$searchq%' OR type LIKE '%$searchq%'") or die("Could not find");
		$count = mysql_num_rows($query);
		if($count == 0){
			$output = 'There were no search results';
		}
		else{
			while($row = mysql_fetch_array($query)){
				$filename = $row['filename'];
				$type = $row['type'];
				$path = $row['path'];

				$output .= '<div> '.$filename.' '.$type.' '.$path.'</div>';
			}
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Engine - Search</title>
<!--<link href="search.css" type="text/css" rel="stylesheet" />-->

</head>

<body>
	<center>
	<form action='searchresults.php' method='post'>
		<input type='text' name='search' placeholder='Search' /> 
		<input type='submit' value='Search' />
	</form>
    </center>
    <br/>
    
<?php
	print("$output");


// disconnect
mysql_close();
?>
</body>
</html>
