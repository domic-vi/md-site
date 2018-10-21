<!DOCTYPE html>
<html lang="ru">
<head>
<title>MD-site - <?=trim($uri, '/')?></title>
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<style>
* {
	font-family: 'Play', sans-serif;
}

body {
	font-size: 11pt;
}
pre>code {
	background-color: #eee;
	border: 1px solid gray;
	padding: 10px;
	display: inline-block;
}
</style>
</head>
<body>
<?=$mdHtml?>
</body>
</html>