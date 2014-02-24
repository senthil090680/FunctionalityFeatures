<html>
<head>
<script type="text/javascript" src="jquery-1.7.1.js"></script>
<script type="text/javascript" src="ajaxfileupload.js"></script>
<script type="text/javascript" src="jquery.simplemodal.js"></script>
<script type="text/javascript" src="jquery.simplemodal-1.3.4.js"></script>


<script type="text/javascript">
	
	function iframeclick() {
		$(" <div />" ).attr("id","backColor").appendTo($( "body" ));
			var src		=	'http://www.jobtardis.in';
			var htmlid	=	'152';
			$.modal(' <iframe id="'+htmlid+'" src="' + src + '" height="450" width="830" style="border:none; overflow:auto;">', {
			escClose    :	false,
			closeHTML:'<a href="#" class="closeIcon" title="Close" style="float:right;padding-bottom:-40px;" onclick="closeIframe(\''+htmlid+'\')"><img src="images/pop-close-small.png" /></a>',
			containerCss:{
			backgroundColor:"#fff",
			borderColor:"#fff",
			height:450,
			padding:0,
			width:830
			},
			overlayClose:false
		});
	}

</script>

</head>


<body>


<button onclick="iframeclick();" >Iframe Popup </button>

</body>

</html>