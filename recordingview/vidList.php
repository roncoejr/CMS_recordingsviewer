<?php
function getVideosCreateArray() {

$col_count = 0;
$my_dir = './recordings/spaces/';
$my_spaces = new DirectoryIterator($my_dir);
$meta_pattern = '/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/';
$vidArray = array();


foreach($my_spaces as $theDir) {
	if(strlen($theDir->getfilename()) > 2){
		$my_dir2 = $my_dir . $theDir;
		$tmp_theDir = $theDir->getfilename();
		$my_files = new DirectoryIterator($my_dir2);
			foreach($my_files as $file) {
				if(strlen($file) > 2) {

					if (preg_match_all($meta_pattern, $file, $matches)) {
						$m_index = $matches[0][0];
						$vidArray["$m_index"] = array("vidYear" => $matches[1][0], "vidMonth" => $matches[2][0], "vidDay" => $matches[3][0], "vidFile" => $matches[0][0] . "-0400.mp4", "vidDir" => $tmp_theDir, "vidParentDir" => $my_dir2);
					}
				}
			}
	}
}
return ($vidArray);
}

function displayVideos() {
header("Content-Type:text/html");

print("<html><head><title>Video Review Portal</title></head><body>");

$col_count = 0;
$my_dir = './recordings/spaces/';
$my_spaces = new DirectoryIterator($my_dir);
$meta_pattern = '/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/';

print("<table border=\"1\"><tr><th></th><th></th></tr>" . PHP_EOL);
foreach($my_spaces as $theDir) {
	if(strlen($theDir->getfilename()) > 2){
		print("<tr><td colspan=\"2\" style=\"background-color: blue; color: white; height: 20px; font-size: 18pt;\">" . $theDir . "</td></tr>" . PHP_EOL);
		$my_dir2 = $my_dir . $theDir;
		$my_files = new DirectoryIterator($my_dir2);
			foreach($my_files as $file) {
				if(strlen($file) > 2) {
				print("<td>" . PHP_EOL);
					if($col_count >= 0 && $col_count <= 4) {
						print("<td>" . PHP_EOL);
					}
					else {
						print("<tr><td>" . PHP_EOL);
					}


					print("<video width=\"320\" height=\"280\" controls>" . PHP_EOL);
					print("<source src=\"" . $my_dir2 . "/" . $file . "\" " . "type=\"video/mp4\">" . PHP_EOL);
					print("</video>" . PHP_EOL);
					// print("<br>" . $file);

					if (preg_match_all($meta_pattern, $file, $matches)) {
						print("<table><tr><td align=\"RIGHT\">YEAR:</td><td>" . $matches[1][0] . "</td><td><button type=\"button\" name=\"btn_profile\" id=\"btn_profile\">PROFILE</button></td></tr><tr><td align=\"RIGHT\">MONTH:</td><td>" . $matches[2][0] . "</td></tr><tr><td align=\"RIGHT\">DAY:</td><td>" . $matches[3][0] . "</td></tr><tr><td align=\"RIGHT\">HOUR:</td><td>" . $matches[4][0] . "</td></tr><tr><td align=\"RIGHT\">MINUTE:</td><td>" . $matches[5][0] . "</td></tr><tr><td align=\"RIGHT\">SECOND:</td><td>" . $matches[6][0] . "</td></tr></table>");
					}
					else {
						print("<br>A matching error occurred");
					}


					if($col_count++ >= 0 && $col_count < 4) {
						print("</td>" . PHP_EOL);
					}
					else {
						print("</td></tr>" . PHP_EOL);
						$col_count = 0;
					}
				}
	}
	$col_count = 0;
	print("</tr>" . PHP_EOL);
	}
}
print("</table>" . PHP_EOL);

print("</body></html>");
}

function displayVideosXML() {

$xml_version = "1.0";
$xml_encoding = "UTF-8";
$video_count = 0;
$video_xmldescrip = "";

/*// print("<?xml version='" . $xml_version . "' encoding='" . $xml_encoding . "'?>"); */
header("Content-Type: text/xml");

$my_dir = './recordings/spaces/';
$my_spaces = new DirectoryIterator($my_dir);
$meta_pattern = '/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/';

	foreach($my_spaces as $theDir) {
		if(strlen($theDir->getfilename()) > 2) {
			$my_dir2 = $my_dir . $theDir;
			$my_files = new DirectoryIterator($my_dir2);
			foreach($my_files as $theVideo) {
				if(strlen($theVideo) > 2) {
					if(preg_match_all($meta_pattern, $theVideo, $matches)) {
						$vid_year = $matches[1][0];
						$vid_day = $matches[3][0];
						$vid_month = $matches[2][0];
						$vid_hour = $matches[4][0];
						$vid_minute = $matches[5][0];
						$vid_second = $matches[6][0];
					}
					$video_xmldescrip = $video_xmldescrip . "<video><id>" . $theDir . "-" . $matches[0][0] . "</id><filename>" . $theVideo . "</filename><year>" . $vid_year . "</year><month>" . $vid_month . "</month><day>" . $vid_day . "</day><hour>" . $vid_hour . "</hour><minute>" . $vid_minute . "</minute><second>" . $vid_second . "</second></video>";
					++$video_count;
				}
			}
		}
	}


print("<videos total=\"" . $video_count . "\">");
print($video_xmldescrip);
print("</videos>");
}

function displayVideosJSON() {


$xml_version = "1.0";
$xml_encoding = "UTF-8";
$video_count = 0;
$video_jsondescrip = "";

/*// print("<?xml version='" . $xml_version . "' encoding='" . $xml_encoding . "'?>"); */
header("Content-Type: application/json");

$my_dir = './recordings/spaces/';
$my_spaces = new DirectoryIterator($my_dir);
$meta_pattern = '/^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/';

	foreach($my_spaces as $theDir) {
		if(strlen($theDir->getfilename()) > 2) {
			$my_dir2 = $my_dir . $theDir;
			$my_files = new DirectoryIterator($my_dir2);
			foreach($my_files as $theVideo) {
				if(strlen($theVideo) > 2) {
					if(preg_match_all($meta_pattern, $theVideo, $matches)) {
						$vid_year = $matches[1][0];
						$vid_day = $matches[3][0];
						$vid_month = $matches[2][0];
						$vid_hour = $matches[4][0];
						$vid_minute = $matches[5][0];
						$vid_second = $matches[6][0];
					}
					$video_jsondescrip = $video_jsondescrip . "{\"id\" : \"" . $theDir . "-" . $matches[0][0] . "\",\"filename\" : \"" . $theVideo . "\", \"year\" : \"" . $vid_year . "\", \"month\" : \"" . $vid_month . "\", \"day\" : \"" . $vid_day . "\",\"hour\" : \"" . $vid_hour . "\",\"minute\" : \"" . $vid_minute . "\",\"second\" : \"" . $vid_second . "\"},";
					++$video_count;
				}
			}
		}
	}


print("{");
print($video_jsondescrip);
print("}");
}


function displayVideosTABLE() {

$video_count = 0;
$video_table = "";

/*// print("<?xml version='" . $xml_version . "' encoding='" . $xml_encoding . "'?>"); */
header("Content-Type: text/html");


			$my_videos = getVideosCreateArray();
			rsort($my_videos);
			foreach($my_videos as $vidKey => $vidValue) {
			$video_table = $video_table . "<tr><td>" . $vidValue['vidDir'] . "-" . $vidValue['vidYear'] . $vidValue["vidMonth"] . $vidValue["vidDay"] . "</td><td>" . $vidValue['vidFile'] . "</td><td>" . $vidValue['vidMonth'] . "-" . $vidValue['vidDay'] . "-" . $vidValue['vidYear'] . "</td><td><button type=\"button\"onclick=\"parent.parent.playVideo('" . $vidValue['vidParentDir'] . "/" . $vidValue['vidFile'] . "'); return false;\">PLAY</button></td></tr>";
					++$video_count;
			}


print("<html><head><title>Video Catalog</title></head><body>" . PHP_EOL);
print("<table border=\"0\" cellpadding=\"2\" class=\"vidPlayer\">" . PHP_EOL);
// print("<tr><th>ID</th><th>FILENAME</th><th>DATE</th><th>ACTION</th></tr>" . PHP_EOL);
print($video_table);
print("</body></html>" . PHP_EOL);
}

function selectDisplayVideo($m_selection) {
//	header("Content-Type: text/xml");
	echo($m_selection);
}

?>

<?php
if(empty($f)) {
	$f = $_GET["f"];
}

switch ($f) {

	case "x":
		displayVideosXML();
		break;
	case "j":
		displayVideosJSON();
		break;
	case "t":
		displayVideosTABLE();
		break;
	case "s":
		selectDisplayVideo($_GET["s"]);
		break;
	case "p":
	default:
		displayVideos();

}

?>
