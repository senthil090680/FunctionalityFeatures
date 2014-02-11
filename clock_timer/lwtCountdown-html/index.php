<?php 
$dayfrom	=	2;	
$yearfrom   =	2012;
$monthfrom	=   8;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<script language="Javascript" type="text/javascript" src="js/jquery-1.4.1.js"></script>
	<script language="Javascript" type="text/javascript" src="js/jquery.lwtCountdown-1.0.js"></script>
	<script language="Javascript" type="text/javascript" src="js/misc.js"></script>
	<link rel="Stylesheet" type="text/css" href="style/main.css"></link>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>test</title>
</head>

<body>

	<div id="container">

		<h1>UNDER CONSTRUCTION</h1>
		<h2 class="subtitle">Stay tuned for news and updates.</h2>

		<!-- Countdown dashboard start -->
		<div id="countdown_dashboard">
			<div class="dash weeks_dash">
				<span class="dash_title">weeks</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash days_dash">
				<span class="dash_title">days</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash hours_dash">
				<span class="dash_title">hours</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash minutes_dash">
				<span class="dash_title">minutes</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

			<div class="dash seconds_dash">
				<span class="dash_title">seconds</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>

		</div>
		<!-- Countdown dashboard end -->

		<div class="dev_comment">
			This is a place holder for your comments.<br/>
			This page has been tested with <br />IE 6, IE 7, IE 8, FF 3, Safari 4, Opera 9, Chrome 4
		</div>

		<div class="subscribe">
			<form action="" method="POST" id="subscribe_form">
				<input type="text" name="email" id="email_field" class="faded" value="your@email.com" /> <input type="submit" id="subscribe_button" value="Stay updated" />
			</form>
		</div>

			<button onclick="set_by_date()">set_by_date()</button>
				<button onclick="set_by_offset()">set_by_offset()</button>

		<script language="javascript" type="text/javascript">
			/*jQuery(document).ready(function() {
				$('#countdown_dashboard').countDown({
					targetDate: {
						'day': 		<?php echo $dayfrom; ?>,
						'month': 	<?php echo $monthfrom; ?>,
						'year': 	<?php echo $yearfrom; ?>,
						'hour': 	11,
						'min': 		0,
						'sec': 		0
					}
				});*/



				// Initiate Countdown
				jQuery(document).ready(function() {
					$('#countdown_dashboard').countDown({
						targetOffset: {
							'day': 		0,
							'month': 	0,
							'year': 	0,
							'hour': 	0,
							'min': 		0,
							'sec': 		0
						}
					});
				});

				// Set by specific date/time
				function set_by_date() {
					$('#countdown_dashboard').stopCountDown();
					$('#countdown_dashboard').setCountDown({
						targetDate: {
							'day': 		15,
							'month': 	1,
							'year': 	2011,
							'hour': 	12,
							'min': 		0,
							'sec': 		0
						}
					});
					$('#countdown_dashboard').startCountDown();
				}

				// Set by date/time offset
				function set_by_offset() {
					$('#countdown_dashboard').stopCountDown();
					$('#countdown_dashboard').setCountDown({
						targetOffset: {
							'day': 		1,
							'month': 	1,
							'year': 	0,
							'hour': 	1,
							'min': 		1,
							'sec': 		1
						}
					});
					$('#countdown_dashboard').startCountDown();
				}

				
				$('#email_field').focus(email_focus).blur(email_blur);
				$('#subscribe_form').bind('submit', function() { return false; });
			});
		</script>
	
	</div>


</body>

</html>
