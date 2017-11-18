<?php
	session_start();
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

		<?php
		if (isset($_SESSION[LOGGED_ON]))
		{
			$pics = scandir("./pics/");
			$pics = array_slice($pics, 2);
			$pics = array_reverse($pics);
			echo '

			<div id="global">
				<div id="gauche">
					<div class="filters">
						<input type="radio" name="filter" value="blanka" id="blanka" checked/>
						<label><img src="./filters/blanka.png" alt="missing" class="filtersize" /></label>
						<input type="radio" name="filter" value="gouki" id="gouki"/>
						<label><img src="./filters/gouki.png" alt="missing" class="filtersize" /></label>
						<br>
						<input type="radio" name="filter" value="phoenix" id="phoenix"/>
						<label><img src="./filters/phoenix.png" alt="missing" class="filtersize" /></label>
						<input type="radio" name="filter" value="marine" id="marine"/>
						<label><img src="./filters/marine.png" alt="missing" class="filtersize" /></label>
					</div>
					<video id="video"></video>
					<button type="submit" class="cambutton" id="startbutton">Prendre une photo</button>
					<img id="photo" />
					<canvas id="canvas" style="display:none;"></canvas>
				</div>
				<div id="droite">';
					foreach ($pics as $value)
					{
						$value = explode(' ', $value);
						if ($_SESSION[LOGGED_ON] == $value[0])
						{
							$value = implode(' ', $value);
							echo "<div class='del'>
									<img class='gallery' src='./pics/" . $value . "'/>
									<div class='delbutton'><a href='index.php'><img src='./ressources/delicon.png' style='width:4vw;height=4vw;'/></a>
									</div>
								</div>";
						}
					}
				 echo '</div>
			</div>

				';

		}
		?>

		<div class="footer">
		</div>
	</body>
</html>

<?php
if ($_SESSION[LOGGED_ON])
{
?>

<script>
(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
	  context	   = canvas.getContext('2d'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
	  filter	= document.querySelector('#blanka'),

			width = (window.innerWidth / 5 ) ;
			height = window.innerHeight;
			// width = 320,
			// height = 320;

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

	function takepicture()
	{
		context.drawImage(video, 0, 0, width, height);
		var data = canvas.toDataURL("image/png");
		var tmp = new Image();

		tmp.src = data;

		// Debut Ajax
		var xml = new XMLHttpRequest()
		xml.open('POST', 'datastorage.php', true);
		xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xml.send("filter=" + document.querySelector('input[name="filter"]:checked').value + "&data=" + data);
		// Fin Ajax

		xml.onload = function()
		{
			var response = xml.responseText;
			photo.src = response;
			console.log(response);
		}

   }

  startbutton.addEventListener('click', function(ev)
  {
	takepicture();
  }, false);

})();
</script>
<?php
}
?>
