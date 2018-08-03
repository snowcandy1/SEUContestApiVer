<?php include 'checkToken.php'; 
date_default_timezone_set('PRC');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title; ?></title>
<script src="/static/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<?php if(!isset($notResizable)) { ?>
<script src="/static/js/doc.resize.js" type="text/javascript"></script>
<?php } ?>
<link rel="stylesheet" href="https://cdn.bootcss.com/semantic-ui/2.2.13/semantic.min.css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css"> 
<script src="https://cdn.bootcss.com/semantic-ui/2.2.13/semantic.min.js"></script>
<?php
foreach ($csslist as $css) {
	echo '<link rel="stylesheet" href="/static/css/'.$css.'">'."\r\n";
}
?>

</head>
<body>
<div class="ui inverted menu"> 
   <a class="header item" href="/">SEU</a> 
   <a class="item" href="/">首页</a> 
   <a class="item" href="/test">测试</a>
   <a class="item" href="/settings"><?=$Loginfo['username']?></a>
</div>