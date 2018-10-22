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

table {
	border-spacing: 0;
}

th {
	border-top: 2px solid black;
	text-align: center;
}

td, th {
	border-left: 1px solid black;
	border-bottom: 1px solid black;
	padding: 5px 8px;
	margin: 0;
}

td {
	text-align: left;
}

table tr>*:last-child {
	border-right: 1px solid black;
} 

</style>
</head>
<body>
<?=$mdHtml?>
</body>
</html>