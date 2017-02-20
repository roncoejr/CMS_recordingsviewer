<?php

	header("Cache-Control: no-cache; must revalidate");	
	$v_selection = $_GET["s"];
	echo("<videos count=\"1\"><video id=\"$v_selection\">$v_selection</video></videos>");
?>
