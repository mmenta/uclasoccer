<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>

<html>
<head>
        <title>UCLA Soccer: Home of the 2013 NCAA National Champions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Welcome to the home of the 2013 NCAA National Champions. UCLA Soccer is your source for the latest on our women's soccer staff, team and camps.">
		<meta name="keywords" content="Ucla women's soccer,Ucla womens soccer,Ucla women soccer,Amanda Cromwell,Ucla soccer,Cromwell ucla,Ucla bruins soccer,Ucla soccer camp,Ucla soccer camps,Ucla,Ucla bruins,College soccer">                
		<meta name="viewport" content="width=1200, initial-scale=2.0, maximum-scale=1"/>
        <link rel="stylesheet" type="text/css" media="all" href="/css/layout.css" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
</head>

<body id="<?php echo $Model->page();?>">

<?php
include('views/partials/header.php');

if( $Model->page() != 'home' ) {
	include('views/partials/subpage-header.php');
}

require('views/' . $route);

include('views/partials/footer.php');
?>

</body>

<script src="/scripts/lib/head.min.js"></script>
<script src="/scripts/main.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49090400-1', 'uclasoccer.com');
  ga('send', 'pageview');

</script>

</html>
