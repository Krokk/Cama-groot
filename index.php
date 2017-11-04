<?php
session_start();
$_SESSION["message"] = '';
?>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">

		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
			<a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
			<div class="box1">
			<?php
			if (isset($_SESSION[LOGGED_ON]))
			{
				echo '<a href="profile.php"><button class="signed" style="padding-left: 0px;type="button" name="profile">' . $_SESSION[LOGGED_ON] ."</button></a>";
				echo '<a href="logout.php"><button class="button" type="button" name="Logout">Log out</button></a>';
			}
			else
			{
				echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
				echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up"> Register</button></a>';
			}
			?>
			</div>
		</div>
		<div class="main">
<<<<<<< HEAD
			<?php
			if (isset($_SESSION[LOGGED_ON]))
			{
			echo '<center>';
            echo '<video id="video" style="align:center"></video>';
            echo '<div><button id="startbutton">Prendre une photo</button></div>';
			echo '<canvas id="canvas"></canvas>';
			echo '</center>';
			}
=======
		<?php
		if (isset($_SESSION[LOGGED_ON]))
		{
			echo '<center>
			<video id="video"></video>
			<button class="cambutton" id="startbutton">Prendre une photo</button>
			<canvas id="canvas"></canvas></center>';
		}
>>>>>>> a3db44c827e31bf0374e5865e61a5dfdd1dba3e3
		?>
		</div>
		<div class="footer">
		</div>
		</div>
		<div class="footer">
		</div>
	</body>
</html>

<<<<<<< HEAD
=======

>>>>>>> a3db44c827e31bf0374e5865e61a5dfdd1dba3e3
<?php
if ($_SESSION[LOGGED_ON])
{
?>
<<<<<<< HEAD
<script type="text/javascript">  
=======
<script type="text/javascript">
>>>>>>> a3db44c827e31bf0374e5865e61a5dfdd1dba3e3
(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
<<<<<<< HEAD
=======
	  context	   = canvas.getContext('2d'),
>>>>>>> a3db44c827e31bf0374e5865e61a5dfdd1dba3e3
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

<<<<<<< HEAD
  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
	console.log(data);
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();
</script>
<?php
}
?>
=======
	function takepicture()
	{
		var data = new Image();
		var xml = new XMLHttpRequest();

		canvas.width = width;
		canvas.height = height;
		context.drawImage(video, 0, 0, width, height);
		data.src = canvas.toDataURL();

		xml.onreadystatechange = function()
		{
			if (xml.readyState == 4 && (xml.status == 200 || xml.status == 0))
			{
				console.log(xml.response);
				//if (xml.response)
			}
		}

		console.log(data);
		xml.open('POST', 'datastorage.php', true);
		xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xml.send("data=" + data);

		//console.log(data);
	    //photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
	//ev.preventDefault();
	takepicture();
  }, false);

})();

</script>
<?php
}
?>
>>>>>>> a3db44c827e31bf0374e5865e61a5dfdd1dba3e3
