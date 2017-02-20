function initReqObject(reqObject) {

	reqObject = new XMLHttpRequest();

}

function playVideo(vidSelection) {
	var xmlHttp = new XMLHttpRequest();

	// initReqObject(xmlHttp);


	m_url = "./vidList.php";
	m_params = "f=s&s=" + vidSelection;

	// alert(m_url+'?'+m_params);

	xmlHttp.open("GET", m_url+'?'+m_params, true);
	

	xmlHttp.onreadystatechange = function() {

		document.getElementById("videoPlayer").innerHTML = document.getElementById("videoPlayer").innerHTML + "<br>Starting";

		if(xmlHttp.readyState == 4) {
			m_selection = "readyState is now: 4, status: " + xmlHttp.status + "<br>";
			if(xmlHttp.status == 200) {

			// var m_selection = JSON.parse(xmlHttp.responseText);
			m_selection = xmlHttp.responseText;
			// alert(xmlHttp.responseText);
			// alert("Ready State: " + xmlHttp.readyState + "<br>Status: " + xmlHttp.status);
			document.getElementById("videoPlayer").innerHTML = document.getElementById("videoPlayer").innerHTML + "<br>Got here #1<br>";
			processVideoMeta(m_selection.trim());
			document.getElementById("videoPlayer").innerHTML = document.getElementById("videoPlayer").innerHTML + "<br>Got here #2<br>";
		}
		} else {
			// alert("Ready State: " + xmlHttp.readyState + "<br>Status: " + xmlHttp.status);
		}

	} 
	xmlHttp.send(null);

	// document.getElementById("videoPlayer").innerHTML = document.getElementById("videoPlayer").innerHTML + xmlHttp.responseText;

}

function processVideoMeta(m_selection) {

//	document.getElementById("videoPlayer").innerHTML = document.getElementById("videoPlayer").innerHTML + m_selection;
	document.getElementById("videoPlayer").innerHTML = "<video controls autoplay><source src=\"" + m_selection + "\" type=\"video/mp4\"></video>";


}
