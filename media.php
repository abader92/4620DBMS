<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<a href="browse.php"><img src="http://i.imgur.com/3Qyvyb7.png" alt="MeTube Icon" style="width:160;height:96"></a>

<body>
<?php
if(isset($_GET['id'])) {
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	//updateMediaTime($_GET['id']);
	
	$filename=$result_row[0];   ////0, 4, 2
	$filepath=$result_row[4]; 
	$type=$result_row[2];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row[4];
		echo '<img src="'.$filepath.'"/>';
	}
	else //view movie
	{	
?>
	<!-- <p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p> -->
	<p>Viewing Video:<?php echo $result_row[4];?></p>

<!-- This is our logout button -->
<a href='logout.php'  style="color:#000000;">Log Out</a>
	      
    <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[4];?>">
	<!-- echo $result_row[2].$result_row[1];  -->
		

<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<!---<embed type="application/x-mplayer2" src="<?php echo $filepath;  ?>" name="MediaPlayer" width=320 height=240></embed>--->

<div style="text-align:center"> 
<video id="video1" width="384" height="288" autoplay>
	<source src="<?php echo $filepath;  ?>" type="video/mp4">
</video>
  <br>
  <button onclick="playPause()">Play/Pause</button> 
  <button onclick="makeBig()">Big</button>
  <button onclick="makeSmall()">Small</button>
  <button onclick="makeNormal()">Normal</button>
</div> 

<script> 
var myVideo = document.getElementById("video1"); 

function playPause() { 
    if (myVideo.paused) 
        myVideo.play(); 
    else 
        myVideo.pause(); 
} 

function makeBig() { 
    myVideo.width = 560; 
} 

function makeSmall() { 
    myVideo.width = 320; 
} 

function makeNormal() { 
    myVideo.width = 420; 
} 
</script>

</object>
              
<?php
	}
}
else
{
?>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>
</body>
</html>
