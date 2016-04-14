<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id){
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message){ }
 	);
} 
</script>
</head>


<!-- This is the top line -->
<body>
<p style="text-align:left;">
<a href="browse.php"><img src="http://i.imgur.com/3Qyvyb7.png" alt="MeTube Icon" style="width:160;height:96"></a><span style="float:right;">
Welcome <?php echo $_SESSION['username'];?></span></p>



<hr>
<!-- This is our search bar -->
<p><strong> Search Here </strong></p>
	<form name="form1" method="post" action="searchresults.php">
		<input name="search" type="text" size="40" maxlength="50" required/>
		<input type="submit" name="Submit" value="Search"/><br><hr>
	</form>
<!-- This is our logout button -->
<a href='logout.php'  style="color:#000000;">Log Out</a>

<!-- This is our browse button 
<a href='browse_category.php' style="color:#000000;">Browse</a>
**will be a dropdown listing all categories or something I assume-->
	
<!-- This is our upload media button -->
<a href='media_upload.php'  style="color:#000000;">Upload File</a>
<div id='upload_result'>
<?php 
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0){		
		echo upload_error($_REQUEST['result']);
	}
?>
</div>
<br/><br/>



<?php

	$query = "SELECT * from media"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
    
    <div style="background:#1766b5;color:#ffffff; width:132px;">Uploaded Media</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
            //filename, username, type, mediaid, path
			while ($result_row = mysql_fetch_row($result)){ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
		?>
        	 <tr valign="top">			
			<td>
					<?php 
						echo $mediaid;  //mediaid
					?>
			</td>
                        

			<td>
			<?php	$link="media.php?id="; ?>
            	            <a href="media.php?id=<?php echo $mediaid;?>" target="_blank" ><?php echo $filename;?></a> 
				
 
                        </td>
                        <td>
            	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                        </td>
		</tr>
        	<?php
			}
		?>
	</table>

   </div>

</body>
</html>
