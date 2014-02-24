<?php 
session_start();
include("../dbfunctions_jt.php");
require_once ("../get_country_file.php");
$link=dblink();

if(!empty($_SESSION['curr_user']['user_id']))
{
    header("location:/JT_V_Ad/wowvads-welcomepage.php");
	exit;
}

if($_POST)
{
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	$category=$_POST['category'];
	$sess_url = $_POST['session_url'];
	
	$link=dblink();
	
	if($category=="login")
	{
		if(($user_name=="")||($password==""))
		{
			$_SESSION['err_msg'] = "Username and password not allowed to be empty";
			header("location:http://www.jobtardis.in/new/JT_V_Ad/checkusertype.php");
			exit;					
		}
		
		$query="SELECT * FROM jt_login WHERE username='$user_name' and BINARY pass_word='$password'";
		$result=mysql_query($query,$link);
		$res=mysql_fetch_array($result);
		if(mysql_num_rows($result)>0) 
		{
			if($res['curr_status']=='Inactive')
			{
				$_SESSION['err_msg'] = "Please activate your account";
				header("location:http://www.jobtardis.in/new/JT_V_Ad/checkusertype.php");
				exit;
			}
			else if($res['curr_status']=='Active')
			{
				$_SESSION['curr_user']['user_id']=$res['user_id'];
				$_SESSION['curr_user']['username']=$res['username'];
				$_SESSION['curr_user']['email']=$res['email'];
				$_SESSION['curr_user']['user_type']=$res['user_type'];
				$_SESSION['curr_user']['curr_status']=$res['curr_status'];
				$_SESSION['curr_user']['plan']=$res['plan'];
				$_SESSION['curr_user']['session_id']=session_id();
				$user_session_id = $_SESSION['curr_user']['session_id'];						
				//$_SESSION['plan']="Platinum";
				
				if($res['user_type']=="1")
				{					
					$query_js="SELECT fname FROM jt_js_details WHERE user_id='$res[user_id]' ";
					$result_js=mysql_query($query_js,$link);
					$row_js=mysql_fetch_array($result_js);
					$_SESSION['curr_user']['fname']=$row_js['fname'];

					if(isset($_POST['remember']))
					{
						setcookie("cookiejtusername", $_SESSION['curr_user']['username'], time()+60*60*24*100, "/");
						setcookie("cookiejtuserpass", $password, time()+60*60*24*100, "/");
					}
					
					insert_user($res['user_id'],$user_session_id,$res['now_login_date']);	
					insert_alert($res[user_id]);
					
					if($sess_url != "")
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");
						exit;
					}
					else
					{
                                                header("location:search_wowvAd.php");
						//header("location:../index.php");
						exit;	
					}
				}
				else if($res['user_type']=="2" || $res['user_type']=="21" || $res['user_type']=="22" || $res['user_type']=="23")
				{
					$query_emp="SELECT company_name,contact_person FROM jt_empdetails WHERE user_id='$res[user_id]'";
					$result_emp=mysql_query($query_emp,$link);
					$row_emp=mysql_fetch_array($result_emp);
					$_SESSION['curr_user']['company_name']=$row_emp['company_name'];
					$_SESSION['curr_user']['contact_person']=$row_emp['contact_person'];
					$_SESSION['curr_user']['user_id']= $res[user_id];

					if(isset($_POST['remember']))
					{
						setcookie("cookiejtusername", $_SESSION['curr_user']['username'], time()+60*60*24*100, "/");
						setcookie("cookiejtuserpass", $password, time()+60*60*24*100, "/");;
					}
					
					insert_user($res['user_id'],$user_session_id,$res['now_login_date']);	
					insert_alert_emp($res[user_id]);
					
					if($sess_url != "")
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");
						exit;
					}
					else
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");	
						exit;						
					}
				}
				else if($res['user_type']=="4")
				{
				$query_emp="SELECT company_name,contact_person FROM jt_empdetails WHERE user_id='$res[user_id]'";
					$result_emp=mysql_query($query_emp,$link);
					$row_emp=mysql_fetch_array($result_emp);
					$_SESSION['curr_user']['company_name']=$row_emp['company_name'];
					$_SESSION['curr_user']['contact_person']=$row_emp['contact_person'];

					if(isset($_POST['remember']))
					{
						setcookie("cookiejtusername", $_SESSION['curr_user']['username'], time()+60*60*24*100, "/");
						setcookie("cookiejtuserpass", $password, time()+60*60*24*100, "/");
					}
					
					insert_user($res['user_id'],$user_session_id,$res['now_login_date']);	
					insert_alert_emp($res[user_id]);
					
					if($sess_url != "")
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");
						exit;
					}
					else
					{
						header("location:myaccount_ser.php");	
						exit;						
					}
				
				}
				else 
				{
					//echo "aaaa";
					$query_emp="SELECT company_name,contact_person FROM jt_empdetails WHERE user_id='$res[user_id]'";
					$result_emp=mysql_query($query_emp,$link);
					$row_emp=mysql_fetch_array($result_emp);
					$_SESSION['curr_user']['company_name']=$row_emp['company_name'];
					$_SESSION['curr_user']['contact_person']=$row_emp['contact_person'];

					if(isset($_POST['remember']))
					{
						setcookie("cookiejtusername", $_SESSION['curr_user']['username'], time()+60*60*24*100, "/");
						setcookie("cookiejtuserpass", $password, time()+60*60*24*100, "/");
					}
					
					insert_user($res['user_id'],$user_session_id,$res['now_login_date']);
					insert_alert_emp($res[user_id]);	
					if($sess_url != "")
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");
						exit;
					}
					else
					{
						header("location:/JT_V_Ad/wowvads-welcomepage.php");	
						exit;
					}						
				}
			}	
			else 
				{
				$_SESSION['err_msg'] = "Contact Administrator";
				header("location:http://www.jobtardis.in/new/JT_V_Ad/checkusertype.php");
				exit;
				}			
		}
		else
		{
			$_SESSION['err_msg'] = "Invalid username or password";
			header("location:http://www.jobtardis.in/new/JT_V_Ad/checkusertype.php");
			exit;
		}	 
	} 
}
else
{

	if(isset($_SESSION['files_url']) && $_SESSION['files_url'] != "")
	{

		$user_id=$_SESSION['curr_user']['user_id'];
		$user_type=$_SESSION['curr_user']['user_type'];
		
		
			$session_url = $_SESSION['files_url'];
			unset($_SESSION['files_url']);
		
		
	
	}
	else
	{
	
			
		if($_SESSION['curr_user']['user_type'] == 1)
		{
			header("location:../index.php");
			exit;
		}
		if($_SESSION['curr_user']['user_type'] == "2" || $_SESSION['curr_user']['user_type'] == "21" || $_SESSION['curr_user']['user_type'] == "22" || $_SESSION['curr_user']['user_type'] == "23")
		{
			header("location:/JT_V_Ad/wowvads-welcomepage.php");
			exit;
		}
		if($_SESSION['curr_user']['user_type'] == "3" || $_SESSION['curr_user']['user_type'] == "31" || $_SESSION['curr_user']['user_type'] == "32" || $_SESSION['curr_user']['user_type'] == "33")
		{
			header("location:/JT_V_Ad/wowvads-welcomepage.php");
			exit;
		}
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<Title>Jobtardis.in Login.</title>
<meta name="description" content="Find the best jobs in Jobtardis.in, post resume, search resume, post job, job post, resume search, recruitment, jobseeker, employment, Career Opportunities, Jobs, find a job, Job Portal, job search, resume Search, Job Bid, Career Opportunity, job portals, job site, job search engine, resume search engine, free resume search, resume uploading�/>
<meta name="keywords" content="Find the best jobs in Jobtardis.in, post resume, search resume, post job, job post, resume search, recruitment, jobseeker, employment, Career Opportunities, jobs, , find a job, Job Portal, job search, resume Search, Job Bid, Career Opportunity, job portals, job site, job search engine, resume search engine, free resume search, resume uploading�/>

<link href="css/style.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="../css/home-page-only.css" />
<!--<link rel="stylesheet" type="text/css" href="css/jobtardis.css" />
<link type="text/css" rel="stylesheet" href="http://www.jobtardis.in/jtt/css/jtt.css" />
<script language="javascript" src="js/global.js" type="text/javascript"></script>
<script language="javascript" src="js/jobcategory.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="abtUsRes/accordianCSS.css" />
<link rel="stylesheet" type="text/css" href="abtUsRes/document.css" />
<link rel="stylesheet" type="text/css" href="abtUsRes/jquery.bubblepopup.v2.3.1.css" />-->
<link rel="stylesheet" type="text/css" href="abtUsRes/jquery.tooltip.css" />
<link rel="stylesheet" type="text/css" href="abtUsRes/tabMenuCSS.css" />
<link rel="stylesheet" type="text/css" href="abtUsRes/toolTip.css" />
<script type="text/javascript" src="abtUsRes/ddaccordion.js"></script>
<script type="text/javascript" src="abtUsRes/elements.js"></script>
<script type="text/javascript" src="abtUsRes/jquery.bubblepopup.v2.3.1.min.js"></script>
<script type="text/javascript" src="abtUsRes/jquery.dimensions.js"></script>
<script type="text/javascript" src="abtUsRes/jquery.js"></script>
<script type="text/javascript" src="abtUsRes/jquery.tooltip.js"></script>
<script type="text/javascript" src="abtUsRes/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="abtUsRes/pngfix.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/imagetick.js"></script>

<script language="javascript">
			function readCookie(name)
			{
				var cookieValue = "";
				var search = name + "=";
				if(document.cookie.length > 0)
				{ 
					offset = document.cookie.indexOf(search);

					if (offset != -1)
					{ 
						offset += search.length;
						end = document.cookie.indexOf(";", offset);
						if (end == -1) end = document.cookie.length;
						cookieValue = unescape(document.cookie.substring(offset, end));
					}
				}
				return cookieValue;
			}

			function rememberme()
			{
				if(document.getElementById("remember").checked == true)
				{
					if(readCookie("cookiejtusername"))
					{
						document.getElementById("user_name").value = readCookie("cookiejtusername");
						document.getElementById("password").value = readCookie("cookiejtuserpass");		
					}
				}
				else
				{
					document.getElementById("user_name").value = "";
					document.getElementById("password").value = "";
				}	
			}
			
			function login()
			{
				var user_name=document.getElementById('user_name').value;
				var password=document.getElementById('password').value;
				if(user_name == "")
				{
					alert("User name not allowed to be empty");
					document.getElementById('user_name').focus();
					return false;
				}
				if(password == "")
				{
					alert("Password not allowed to be empty");
					document.getElementById('password').focus();
					return false;
				}
				//var params="category=login&user_name="+user_name+"&pwd="+password;
				//postdata("logindb.php", params, "login");
			}

			function postdata(url, params, action)
			{
				var xmlHttp;
				if(window.XMLHttpRequest){ // For Mozilla, Safari, ...
					var xmlHttp = new XMLHttpRequest();
				}
				else if(window.ActiveXObject){ // For Internet Explorer
					var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlHttp.open('POST', url, true);
				xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xmlHttp.onreadystatechange = function(){
					if (xmlHttp.readyState == 4){
						updatepage(xmlHttp.responseText, action);
					}
				}
				xmlHttp.send(params);
			}
			
			function updatepage(msg, action)
			{
				if(msg=="success js")
				{
					window.location='../myaccount_js.php';
				}
				else if(msg=="success emp")
				{
					window.location='wowvads-welcomepage.php';
				}
				else if(msg=="success rec")
				{
					window.location='wowvads-welcomepage.php';
				}
				else if(action=="emp_networkme")
				{
					window.location="arw/networkme/profile.php";
				}
				else
					alert(msg);
			}

			//trim function
			function trim(str) 
			{
				var chars = " " || "\\s";
				var ltrm=str.replace(new RegExp("^[" + chars + "]+", "g"), "");
				return ltrm.replace(new RegExp("[" + chars + "]+$", "g"), "");
			}
			
			function trim_msg(myString)
			{
				return myString.replace(/^s+/g,'').replace(/s+$/g,'')
			}
			
			function check_network()
			{
				var user_id='<?php echo $user_id; ?>';
				var user_type='<?php echo $user_type; ?>';
				if(user_id=="")
				{
					alert("Sorry,Please Login First");
				}
				else if(user_type == "1")
				{
					alert("Sorry you dont have permission");
				}
				else if(user_type != "1")
				{
					var params="";
					params="category=emp_networkme";
					postdata("emp_networkmedb.php",params,"emp_networkme");					
				}
			}
		</script>
        
        
        
        
        <script type="text/javascript" src="js/imagetick.js"></script>


<script type="text/javascript">
function showmenu(elmnt)
{
document.getElementById(elmnt).style.visibility="visible";
}
function hidemenu(elmnt)
{
document.getElementById(elmnt).style.visibility="hidden";
}
function likeMe()
{
	var curval = document.getElementById("jtLike").innerHTML;
	var curval_new = parseInt(curval)+1;
	document.getElementById("jtLike").innerHTML = curval_new;
	var img= new Image();
    img.src= "http://www.jobtardis.in/jtlike.php?curval="+curval_new;
}
</script>


<script type="text/javascript">
ddaccordion.init({
	headerclass: "headerbar", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<style type="text/css">
<!--

#hiddenDiv {
height: 150px;
width: 150px;
border: 2px solid #363a3a;
position:absolute;
top:60%;
left:47%;
margin-left:-100px;
margin-top:150px;
z-index:700;
}
#hiddenDiv1 {
height: 150px;
width: 150px;
border: 2px solid #363a3a;
position:absolute;
top:50%;
left:50%;
/* margin-left:-100px; */
margin-top:-100px;
z-index:700;
background-color:#fff;
}

-->

.jt_bg1:hover {
    color: #FF0000;
}


</style>


<div class="fleft sdmenu">
<div align="left" onmouseout="hidemenu('slidemenu')" onmouseover="showmenu('slidemenu')" class="fleft wdt50">
<a href="javascript:;"><img width="32" height="33" border="0" alt="Jobtardis" src="img/jt_slide.png" /></a>
<div id="slidemenu" class="fleft bgclr1" style="visibility: hidden;">
	<div id="sildearrw"><img width="7" height="11" alt="sidearrow" src="img/sidearrow.png" /></div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/live.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>livejobboard.php">Live Job Board</a>
		<div class="cleard"></div>
	</div>
		<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/jobbid.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>bidding/js_bid_search.php">Job Bid</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/network.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>login.php">Network Me</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/jobtv.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>newsroom.php">Job TV</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/ticker.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>Resumeticker.php">Ticker</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/testmaker.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>quiz_search.php">Test Maker</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/svideocv.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>search_wowcv.php">Video CV</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/repuindex.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.repuindex.com/">Repuindex</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/wowcv.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.wow-cv.com/">Wow CV</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/wowwords.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.wowwords.org/">Wow Words</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/help.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>aboutUs.php">Help</a>
		<div class="cleard"></div>
	</div>
	<div align="left" style="border-bottom:0px;" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/customer.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.jobtardis.in/livezilla/chat.php">Customer Support</a>
		<div class="cleard"></div>
</div>
</div>
</div>
</div>






		
</head>
<body onLoad="rememberme();">
<!--- Main Part Start here -->
<div align="center">
	<div align="center" class="container">
	<!--- Header Part Start here -->
<?php include('../header.php');?>
	<!--- Header Part End here -->	
	<!--- Business Part Start here -->
	  <div align="left" >
		<div class="jtbusnlftbg fleft"></div>  
		<div class="fleft busnwdt">
			<div class="fleft"><img src="img/jt-busntopbg.gif" width="992" height="4" alt="" /></div>
			<div class="bgclr1 busnwdt fleft">
				<div class="busnn-head"  style="padding:6px;">Login Here</div><div class="cleard"></div><table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td style="padding-top:10px;">
														<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr>
															<!--	<td width="250" class="formTitle">login credentials </td>-->
																<td width="630" class="errorMsg">
																	<?php
																	if(isset($_SESSION['err_msg']) && $_SESSION['err_msg'] !="")
																	{
																		echo $_SESSION['err_msg'];
																		unset($_SESSION['err_msg']);
																	}
																	?>
																</td>
															</tr>
															<tr>
																<td colspan="2" class="formBox">
																	<table width="90%" border="0" align="center" cellpadding="6" cellspacing="0">
																		<form action="checkusertype.php" method="post" onSubmit="return login()">
																			<input type="hidden" name="category" id="category" value="login">
																			<tr>
																				<td width="25%" class="whiteContent_b"><div align="right" class="greyContent_b"><span class="star" style="cursor:auto">*</span> User Name: </div></td>
																				<td width="75%"><div class="textBoxDiv" style="float:left">
																				<input name="user_name" type="text" id="user_name" class="txtBox" />
																				</div>
																				<div class="comments">Please enter the username.</div>						</td>
																			</tr>
																			<tr>
																				<td width="25%" class="whiteContent_b"><div align="right" class="greyContent_b"><span class="star" style="cursor:auto">*</span> Password:</div></td>
																				<td width="75%" class="darkGreyContent"><div class="textBoxDiv" style="float:left">
																				<input name="password" type="password" id="password" class="txtBox" />
																				</div>
																				<div class="comments">Please enter the password.	</div>						</td>
																			</tr>
																			<tr>
																				<td width="25%" align="right" class="whiteContent_b"><input name="remember" type="checkbox" id="remember" checked onClick="rememberme();"/></td>
																				<td width="75%" class="darkGreyContent">
																				<div class="greyContent_b">Remember Me?</div>
																				</td>
																			</tr>
																			<tr>
																				<td class="whiteContent_b">&nbsp;</td>
																				<td class="darkGreyContent">
																					<a href='forgot_password.php' class="greyContent_smallU">Forgot Password</a><br />
																					<a class="rpxnow greyContent_smallU" onclick="return false;" href="https://jobtardis.rpxnow.com/openid/v2/signin?token_url=http%3A%2F%2Fwww.jobtardis.in%2Fopenid%2Frpx.php">Login using Social Network Sites</a><br />
																					<a href="reactivation_user.php" class="greyContent_smallU">Resend Activation Link</a>
																				</td>
																			</tr>
																			<tr>
																				<td class="whiteContent_b">&nbsp;</td>
																				<td class="darkGreyContent">
																					<?php
																					if($session_url != "")
																					{
																						?>
																						<input name="session_url" type="hidden" id="session_url" value = "<?php echo $session_url;?>"/>
																						<?php
																					}
																					?>
																					<input name="submit" type="image" class="button2" value="Login" src="img/login.gif" style="i"  />
																					                                                                                    <a href="http://www.jobtardis.in/register-jobseeker.php"><img alt="Login" src="img/register.gif" border="0" /></a>
																				</td>
																			</tr>                     
																		</form>					  
																	</table>
																</td>
															</tr>
														</table>			
													
													</td>
												</tr>
											</table>
				
				 
		  </div>
			
				
				
			</div>
		
		</div>
	</div>  <br clear="all"/>
	<!--- Business Part End here -->
	</div>	
</div>
<!--- Main Part Start here -->

<!---  Footer Part here-->
<? include('../footer.php');?>
<!--Footer Part here -->
</body>
</html>
<?php 
}
function insert_user($user_id, $user_session_id, $now_login_date)
{
	$ip=$_SERVER['REMOTE_ADDR'];
	$link = dblink();
	$query="SELECT * FROM jt_user_login_details WHERE user_id='$user_id'";
	$result=mysql_query($query,$link);
	$res=mysql_fetch_array($result);
	if(mysql_num_rows($result)>0) 
	{
		$sql="UPDATE jt_user_login_details SET user_ip='$ip',user_session_id='$user_session_id',now_login_date=CURRENT_TIMESTAMP WHERE user_id='$user_id'";
		mysql_query($sql,$link);
	}
	else
	{
		$sql="INSERT INTO jt_user_login_details (user_id, user_ip,user_session_id,now_login_date)VALUES('".$user_id."','".$ip."','".$user_session_id."',CURRENT_TIMESTAMP)";
		mysql_query($sql,$link);
	}
	$country=get_country($ip);
	$sqle="INSERT INTO jt_user_logged_status (user_id, user_ip,user_session_id,country)VALUES('".$user_id."','".$ip."','".$user_session_id."','".$country."')";
	mysql_query($sqle,$link);
}

function insert_alert($user_id)
{
	$link = dblink();
	$query="SELECT * FROM jt_alert WHERE user_id='$user_id'";
	$result=mysql_query($query,$link);
	if(mysql_num_rows($result)==0) 
	{
	
		$sql="INSERT INTO jt_alert(user_id) values('$user_id')";
		mysql_query($sql,$link);
	}  
}
	
function insert_alert_emp($user_id)
{
	$link = dblink();
	$query="SELECT * FROM jt_alert WHERE user_id='$user_id'";
	$result=mysql_query($query,$link);
	if(mysql_num_rows($result)==0) 
	{
		$sql="INSERT INTO jt_alert(user_id) values('$user_id')";
		mysql_query($sql,$link);
	}  
}
?>