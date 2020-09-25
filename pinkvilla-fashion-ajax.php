<?php

$api_url = 'http://www.pinkvilla.com/photo-gallery-feed-page';
if (isset($_GET['page']) && !empty($_GET['page'])) {
	$api_url .= '/page/' . $_GET['page'];
}
$api_response = getApiResponse($api_url);
if (isset($_GET['page'])) {
	header('Content-Type', 'application/json');
	echo $api_response;
}
else {
	return json_decode($api_response);
}


/**
 * Function to get API response
 * @param $api_url
 *   API url
 *
 * @return $result
 *   API Result
 */
function getApiResponse($api_url) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $api_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($curl);
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	if ($httpcode == 200) {
		return $result;
	}
	else {
		return false;
	}
}
