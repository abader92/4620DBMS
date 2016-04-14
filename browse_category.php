<?php
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browse by Category</title>
</head>

<body>

<!-- Database query (grabs all media with the associated category) -->
<?php
  //Query based upon how the user selects the category
  $query = "SELECT * from category As c
                     join media As m
                     on c.mediaid = m.mediaid 
                     Where c.category = ";
  $result = mysql_query( $query );
  if (!$result) {
    die("Could not query the media table in the database: <br> />". mysql_error());
  }   
?>

<div style="background:#1766b5;color:#ffffff; width:132px;">Category Browse</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
		  while ($result_row = mysql_fetch_row($result))
		    $username = $result_row[0];
                    $mediaid = $result_row[1];
                    $category = $result_row[2];
                    $filename = $result_row[3];
                    $filenpath = $result_row[7];
                ?>
		<tr valign="top">
			<td>
				<?php 
				  echo $mediaid;
				?>
			</td>

			<td>
				<?php $link = "media.php?id="; ?>
				<a href="media.php?id=<?php echo $mediaid;?>" target="_blank" ><?php echo $filename;?></a>

			</td>
			<td>
				<a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[7];?>);">Download</a>
			</td>
		</tr>
		<?php
		  }
		?>
	</table>
</div>
</body>
</html>
