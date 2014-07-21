<?php
	echo "Enter Board Name: ";
	$board = fgets(STDIN);
	$board = trim(preg_replace('/\s\s+/', ' ', $board));
	echo "Enter Thread ID #: ";
	$id = fgets(STDIN);
	$id = trim(preg_replace('/\s\s+/', ' ', $id));
	$thread = file_get_contents('http://a.4cdn.org/'.$board.'/thread/'.$id.'.json');
	$json = json_decode($thread, true);
	$i = 0;
	$img = $json['posts'][0]['images'];
	$rep = $json['posts'][0]['replies'];
	$sub = $json['posts'][0]['sub'];
	while($i<$rep) {
		$fln = $json['posts'][$i]['filename'];
		$ext = $json['posts'][$i]['ext'];
		$mfn = $json['posts'][$i]['tim'];
		$image_link = 'http://i.4cdn.org/'.$board.'/'.$mfn.$ext;
		if(strlen($image_link) > 21) {
		if(strlen($sub) > 0){
			if (!file_exists($board."/".$sub)) {
		    mkdir($board."/".$sub, 0777, true);
			}
			copy($image_link, "./".$board."/".$sub."/".$fln.$ext);
		} else {
			$no = $json['posts'][0]['no'];
			if (!file_exists($board."/".$no)) {
					    mkdir($board."/".$no, 0777, true);
						}
		}
		copy($image_link, "./".$board."/".$no."/".$fln.$ext);
		echo ' - "'.$fln.'"'." saved."."\n";
		}
		$i++;
	}
?>