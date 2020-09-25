<?php
    require('pinkvilla-fashion-ajax.php');
    $api_url = 'http://www.pinkvilla.com/photo-gallery-feed-page';
    $api_response = getApiResponse($api_url);
    $decoded_response = json_decode($api_response);
    $pinkvilla_url = 'http://www.pinkvilla.com/';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Fashion page of Pinkvilla" />
		<meta name="keywords" content="fashion, pinkvilla, bollywood fashion, music fashion" />
		<title>Fashion | Pinkvilla.com</title>
		<!--link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" /-->
		<link href="./custom.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="./custom.js" type="text/javascript"></script>
	</head>
	<body class="fashion-page">
		<div id="main-content">
			<div class="main-wrapper container-fluid">
                <div class="container-data">
                <?php
                    $html = '';
                    foreach ($decoded_response->nodes as $key => $node) {
                        $title = $node->node->title;
                        $image_path = $node->node->field_photo_image_section;
                        $nid = $node->node->nid;
                        $path = $node->node->path;
                        $html .= '<div data-item="' . $key . '" class="fashion-data mb-1" data-nid="' . $nid . '"><div class="wrapper">';
                        $html .= '<div class="row mb-1"><div class="img-container "><a href="' . $pinkvilla_url . $path . '" target="_blank" rel="noreferrer"><img src="'  . $pinkvilla_url . $image_path . '" alt="' . $title . '" title="' . $title . '"/></a></div></div>';
                        $html .= '<div class="row title-container"><div class="title"><a href="' . $pinkvilla_url . $path . '" class="title-link" target="_blank" rel="noreferrer" title="' . $title . '"><b>' . $title . '</b></a></div></div>';
                        $html .= '</div></div>';
                    }
                    echo $html;
                ?>
                </div>
                <div class="bottom" data-page="0">Loading more data ...</div>
			</div>
		</div>
	</body>
</html>
