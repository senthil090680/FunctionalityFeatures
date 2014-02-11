<html>
<head>
<title>Check For Valid Email</title>
</head>
<body>
<h1>
<?php
// Function to check whether a given hostName is a valid email
// domain address.
function myCheckDNSRR($hostName, $recType = '')
{
	if(!empty($hostName)) {
		if( $recType == '' ) $recType = "MX";
		exec("nslookup -type=$recType $hostName", $result);
		// check each line to find the one that starts with the host
		// name. If it exists then the function succeeded.
		foreach ($result as $line) {
			if(eregi("^$hostName",$line)) {
				return true;
			}
		}
		// otherwise there was no mail handler for the domain
		return false;
	}
	return false;
}

// If you are running this test on a Windows machine, you'll need to
// uncomment the next line and comment out the checkdnsrr call:
//if (myCheckDNSRR("joemarini.com","MX"))
if (checkdnsrr("joemarini.com","MX"))
	echo "yup - valid email!";
else
	echo "nope - invalid email!";
?>
</h1>
</body>
</html>