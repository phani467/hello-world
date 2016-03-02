<?php

$news_url = file_get_contents("http://www.reddit.com/r/news/.json");
$json =json_decode($news_url, true);


$children = $json ["data"]["children"];
//echo print_r($children);

function array_value_recursive($key, array $arr){
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) array_push($val, $v);
    });
    return count($val) > 1 ? $val : array_pop($val);
}


$titlearray = array_value_recursive('title', $children);

$urlarray = array_value_recursive('url', $children);
//echo $titlearray;

// for ($i = 0; $i < count($titlearray); ++$i) {
//        echo $titlearray[$i]."<br/>";
//    }
//  for ($i = 0; $i < count($urlarray); ++$i) {
//        echo $urlarray[$i]."<br/>";
//    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Reddit News</title>
	<style>
	body{
		background: #CEE3F8;
	}
	.content{
    margin: 0 auto;
    width: 960px;
	}

	.heading{
    padding: 12px;
    margin: 0;
    text-align: center;
    color: #105EAD;
	}

	.news p{
	border: 1px solid #105EAD;
	padding: 12px;
    color: #105EAD;
	}

	.news a{
    display: block;
	}

	</style>
</head>
<body>
<div class="content">
<h3 class="heading">Reddit News</h3>
	<div class="news">
	<?php
		for ($i = 0; $i < count($children); ++$i) {
		echo "<p>".$titlearray[$i]."<a href='$urlarray[$i]'>".$urlarray[$i]."</a></p>";
		}

	?>
	</div>

	
</div>

</body>
</html>

