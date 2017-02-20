<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/videoplayer.css">
<script language="javascript" src="/scripts/js/videoplayer.js">
</script>
<title>Acano Recordings Player Portal</title>
</head>
<body class="vidPlayer">
<center><div id="videoPlayer" name="videoPlayer" class="videoPlayer">VIDEO PLAYER WINDOW</div></center>
<center><div id="videoListHeader" name="videoListHeader" class="videoListHeader"><table><th><td width="370">ID</td><td width="215">FILENAME</td><td width="75">DATE</td><td width="70">ACTION</td></th></table></div></center>
<center><div id="videolList" name="videoList" class="videoList" style="background-color: grey; width: 800px; height: 280px; overflow: auto;"><?php $f=t; include 'vidList.php'; ?></div></center>
</body>
</html>
