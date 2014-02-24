<?php
session_start();
if(empty($_SESSION['curr_user']['user_id']))
{
	echo "<script>window.location='http://www.jobtardis.in/login.php' </script>";
	exit;
} 

include("../dbfunctions.php");

$link=dblink_combined();	

$user_id=$_SESSION['curr_user']['user_id'];
$user_type=$_SESSION['curr_user']['user_type'];
$cnt=$_SESSION['ad']['count'];

$query_camp = "select * from jt_ad_campaign where user_id = '".$user_id."'";
$res_camp = mysql_query($query_camp,$link);
$cnt_ad = mysql_num_rows($res_camp);

//To get whether the user has credits or not...
$query_info = "select * from jt_ad_info where user_id = '".$user_id."'";
$result_info = mysql_query($query_info, $link);
$rs_info = mysql_fetch_array($result_info);
if(mysql_num_rows($result_info) <= 0)
{
	header("location:http://www.jobtardis.in/personal_ad/personal_ad.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>:: Jobtardis ::</title>
		<style type="text/css">
			<!--
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			-->
		</style>
		<link href="arwcss.css" rel="stylesheet" type="text/css">
		<!-- pagination-->
		<script>
			window.onload = function() {
			//SANAjax('Listing','1');
			};
			////////////////////// AJAX
 
			var HttPRequest = false;
			var Curr_Page=1;

			var Curr_Params=1;
 
			function pagination_SANAjax(Mode,Page,params) 
			{
				Curr_Page=Page;

				Curr_Params=params;
				
				HttPRequest = false;
				if (window.XMLHttpRequest) { // Mozilla, Safari,...
					HttPRequest = new XMLHttpRequest();
					if (HttPRequest.overrideMimeType) {
						HttPRequest.overrideMimeType('text/html');
					}
				} 
				else if (window.ActiveXObject) 
				{ // IE
					try {
						HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try {
							HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {}
					}
				} 
	 
				if (!HttPRequest) {
					alert('Cannot create XMLHTTP instance');
					return false;
				}
	 
				var url = 'ad_viewdb.php';
				var pmeters = 'mode=' + Mode + '&Page='+Page+ ' & ' + params;
				
				
				HttPRequest.open('POST',url,true);	 
				HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				HttPRequest.setRequestHeader("Content-length", pmeters.length);
				HttPRequest.setRequestHeader("Connection", "close");
				HttPRequest.send(pmeters);	 
	 
				HttPRequest.onreadystatechange = function()
				{	 
					if(HttPRequest.readyState == 3)  // Loading Request
					{
						//document.getElementById("show").innerHTML = '<img src="loader.gif" align="center" />';
					}
	 
					if(HttPRequest.readyState == 4) // Return Request
					{
						var response = HttPRequest.responseText;
						
						document.getElementById("show").innerHTML = response;
						document.getElementById('keyword_show').style.display="none";
						document.getElementById('publish_ad').style.display="none";
						document.getElementById('dashdiv').innerHTML="Wow Ad Dashboard";
					}	 
				} 
			}
		</script>
		<!-- pagination-->
		<script language="javascript">
			var url="";
			var user_id="<?php echo $_SESSION['curr_user']['user_id']; ?>";
			var max_limit = "<?php echo $rs_info['amount_rem'];?>";

			function savefn()
			{
				var email =trim(document.getElementById('email').value);
				var campname = encodeURIComponent(document.getElementById('name').innerHTML);
				var daily_limit = trim((document.getElementById("daily_limit").value===undefined)?document.getElementById("daily_limit").innerHTML:document.getElementById("daily_limit").value);
				var campaign_limit = trim((document.getElementById("campaign_limit").value===undefined)? document.getElementById("campaign_limit").innerHTML:document.getElementById("campaign_limit").value);
				var start_date = document.getElementById('from').value;
				var end_date = document.getElementById('to').value;
				var title = encodeURIComponent(trim(document.getElementById('title').value));
				var line1 = encodeURIComponent(trim(document.getElementById('line1').value));
				var line2 = encodeURIComponent(trim(document.getElementById('line2').value));
				var key_url = trim(document.getElementById('key_url').value);
				var adurl = key_url.slice(0,7);
				if(adurl == "http://")
				{
					key_url = key_url.slice(7);
				}
				else
				{
					key_url = trim(document.getElementById('key_url').value);
				}
				var status = document.getElementById('status').value;
				var climitnew = new Number(campaign_limit+'').toFixed(parseInt(2));
				campaign_limit = parseFloat(climitnew);
				
				var dlimitnew = new Number(daily_limit+'').toFixed(parseInt(2));
				daily_limit = parseFloat(dlimitnew);
				//daily_limit = parseFloat(daily_limit);
				//campaign_limit = parseFloat(campaign_limit);
				
				if(isNaN(daily_limit))
				{
					alert("Daily limit cannot be empty. It should be an integer.");
					document.getElementById('daily_limit').focus();
					return ;
				}
				else if(daily_limit<50)
				{
					alert("Daily limit should not be less than Rs.50");
					document.getElementById('daily_limit').focus();
					return ;
				}
				else if(daily_limit > max_limit)
				{
					alert("Daily limit should not exceed your account balance");
					document.getElementById('daily_limit').focus();
					return ;
				}
				/*
				else if ((String(daily_limit).indexOf(".")) < (String(daily_limit).length-3)) 
				{
					alert("Daily limit can only be 2 decimal places at most");
					document.getElementById('daily_limit').focus();
					return false;
				}
				*/
				else if(isNaN(campaign_limit))
				{
					alert("Campaign limit cannot be empty. It should be an integer.");
					document.getElementById('campaign_limit').focus();
					return ;
				}	
				else if(campaign_limit<300)
				{
					alert("Campaign limit should not be less than Rs.300");
					document.getElementById('campaign_limit').focus();
					return ;
				}
				else if(campaign_limit > max_limit)
				{
					alert("Campaign limit should not exceed your account balance");
					document.getElementById('campaign_limit').focus();
					return ;
				}
				/*
				else if ((String(campaign_limit).indexOf(".")) < (String(campaign_limit).length-3)) 
				{
					alert("Campaign limit can only be 2 decimal places at most");
					document.getElementById('campaign_limit').focus();
					return false;
				}
				*/
				else if(daily_limit > campaign_limit)
				{
					alert("Daily limit should not be greater than campaign limit");
					document.getElementById('daily_limit').focus();
					return ;
				}
				else if(title == "")
				{
					alert("Title cannot be empty");
					document.getElementById('title').focus();
					return ;
				}
				else if(line1 == "")
				{
					alert("Ad Line1 cannot be empty");
					document.getElementById('line1').focus();
					return ;
				}
				else if(line2 == "")
				{
					alert("Ad Line2 cannot be empty");
					document.getElementById('line2').focus();
					return ;
				}
				else if(key_url=="")
				{
					alert("Url cannot be empty");
					document.getElementById('key_url').focus();
					return;				
				}
				var params="category=Update&user_id=" + user_id + "&email="+email+"&campaign_limit="+campaign_limit+"&daily_limit="+daily_limit+"&endtime="+end_date+"&campname="+campname+ "&status=" + status+"&title="+title+"&line1="+line1+"&line2="+line2+"&key_url="+key_url+"&starttime="+start_date;	
				postdata(url + "ad_viewdb.php", params, "Update");
			}

			function edit(user_id,campname)
			{	
				var params="category=Edit&user_id="+user_id+"&campname="+campname;
				postdata(url + "ad_viewdb.php", params, "Edit");
				key_viewfn(user_id, campname);
			}

			function deletefn (user_id,campname)
			{
				var del_conf = confirm("Do you really want to delete this Ad?");
				
				if(del_conf == true)
				{
					var params="category=Delete&user_id="+user_id+"&campname="+campname;
					postdata(url + "ad_viewdb.php", params, "Delete");
				}
				else
				{
					window.location = "http://www.jobtardis.in/personal_ad/ad_view.php";
				}
			}

			function view()
			{	
				var params="category=View&user_id=" + user_id;				
				pagination_SANAjax('Listing','1',params);
				//postdata(url + "ad_viewdb.php", params, "View");
			}

			function preview(campname)
			{	
				var params="category=Preview&user_id=" + user_id+"&campname="+campname;
				postdata(url + "ad_viewdb.php", params, "Preview");
			}

			function key_savefn()
			{
				var daily_limit=parseFloat(trim(document.getElementById("daily_limit").value===undefined ? document.getElementById("daily_limit").innerHTML : document.getElementById("daily_limit").value));
					
				var keyword=trim(document.getElementById('keyword').value);
				var bid=trim(document.getElementById('bid').value);
				var bid_min = trim(document.getElementById('bid_min').value);
				var bid_max = trim(document.getElementById('bid_max').value);
				var tblid=trim(document.getElementById('tblid').value);
				var campname=document.getElementById('campname_hidden').value;		
				
				bid = Math.floor(bid*100)/100;
				bid = bid.toFixed(2);
				
				bid_min = Math.floor(bid_min*100)/100;
				bid_min = bid_min.toFixed(2);
				
				bid_max = Math.floor(bid_max*100)/100;
				bid_max = bid_max.toFixed(2);
				
				if(keyword == "")
				{
					alert("Keyword cannot be empty");
					document.getElementById('keyword').focus();
					return true;
				}
				else if(parseFloat(bid) == "")
				{
					alert("Bid cannot be empty");
					document.getElementById('bid').focus();
					return true;
				}
				else if(parseFloat(bid) < parseFloat(bid_min))
				{
					alert("The keyword bid must have atleast Rs."+bid_min);
					document.getElementById('bid').focus();
					return true;
				}
				else if(parseFloat(bid) > parseFloat(bid_max))
				{
					alert("The keyword bid should not exceed Rs."+bid_max);
					document.getElementById('bid').focus();
					return true;
				}
				else if(parseFloat(bid) >= parseFloat(daily_limit))
				{
					alert("The keyword bid must be smaller than daily campaign limit");
					document.getElementById('bid').focus();
					return true;
				}	

				//document.getElementById('list').style.display="block";
				if(tblid=="")
				{
					var params="category=key_insert&user_id=" + user_id + "&cname=" + campname + "&keyword="+keyword+"&bid="+bid;
					document.getElementById('tblid').value="";
					postdata(url + "ad_createdb.php", params, "key_insert");
				}
				else
				{
					var params="category=key_update&keyword="+keyword+"&bid="+bid+"&tblid="+tblid;
					document.getElementById('tblid').value="";
					postdata(url + "ad_createdb.php", params, "key_update");
				}
			}

			function key_editfn(key, clock, tblid, campname)
			{				
				document.getElementById('keyword').value=key;
				document.getElementById('bid').value=clock;
				document.getElementById('tblid').value=tblid;
				document.getElementById('campname_hidden').value=campname;
				if(key != "")				
				{
					var params = "category=GetLimit&key_search="+key;
					postdata(url + "ad_viewdb.php", params, "GetLimit");
				}
				else	
				{	
					document.getElementById("key_limit").innerHTML = "Minimum limit is Rs.30.00 and Maximum limit is Rs.100.00";
				}
			}

			function key_viewfn(user_id, campname)
			{
				var params="category=key_view&cname=" + campname + "&user_id=" + user_id;
				postdata(url + "ad_createdb.php", params, "key_view");
			}

			function key_deletefn(tblid)
			{
				var del_fn = confirm("Do you really want to delete this keyword?");
				
				if(del_fn == true)
				{
					document.getElementById('tblid').value=tblid;
					var params="category=key_delete&tblid="+tblid;
					postdata(url + "ad_createdb.php", params, "key_delete");
				}
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

			function checkad(ad_cnt)
			{
				/*
				if(ad_cnt>0)
				{
					var ad_conf = confirm("Only one free ad permitted, Are you ready to pay and use our service?");
					
					if(ad_conf == true)
					{
						window.location = "http://www.jobtardis.in/personal_ad/payment/confirmpayment.php";
					}
					else
					{
						//window.location = "http://www.jobtardis.in/personal_ad/ad_view.php";
					}
				}
				else
				{
					*/
					window.location = "http://www.jobtardis.in/personal_ad/ad_create.php";					
				//}
			}
		
			function updatepage(msg, action)
			{ 	
				if(action=="Edit")
				{
					document.getElementById('show').innerHTML=msg
					document.getElementById('dashdiv').innerHTML="Edit Wow Ad";
					document.getElementById('publish_ad').style.display="inline";
				}
				else if(action=="Update")
				{
					alert(msg);
					view();	
				}
				else if(action=="Delete")
				{		
					//document.getElementById('show').innerHTML=msg;
					alert(msg);
					window.location = "http://www.jobtardis.in/personal_ad/ad_view.php";
					//view();
				}
				else if(action=="View")
				{
					document.getElementById('keyword_show').style.display="none";
					document.getElementById('publish_ad').style.display="none";
					document.getElementById('show').innerHTML=msg;
					document.getElementById('dashdiv').innerHTML="Wow Ad Dashboard";
				}
				else if(action=="status")
				{
					alert(msg);
					pagination_SANAjax('Listing',Curr_Page,Curr_Params);
					//view();
				}
				else if(action=="Preview")
				{
					document.getElementById('show').innerHTML=msg;
					document.getElementById('keyword_show').style.display="none";
					document.getElementById('publish_ad').style.display="none";
					document.getElementById('dashdiv').innerHTML="Preview Wow Ad";
				}
				else if(action=="key_delete" || action=="key_update" || action=="key_insert")
				{
					campname=document.getElementById('campname_hidden').value;
					
					key_viewfn(user_id, campname);
					//alert(msg);
					document.getElementById('list').style.display="block";
					
					document.getElementById('tblid').value="";
					document.getElementById('keyword').value="";
					document.getElementById('bid').value="";
					//document.getElementById('email').value="";
				}
				else if(action=="key_view")
				{
					document.getElementById('keyword_show').style.display = "inline";
					get_limit();
					document.getElementById('list').innerHTML=msg;
					document.getElementById("key_limit").innerHTML = "Minimum limit is Rs.30.00 and Maximum limit is Rs.100.00";
				}
				else if(action == "GetLimit")
				{
					if(msg == "" || msg == "~")
					{
						document.getElementById("key_limit").innerHTML = "Minimum limit is Rs.30.00 and Maximum limit is Rs.100.00";
						document.getElementById("bid_min").value = 30.00;
						document.getElementById("bid_max").value = 100.00;
					}
					else
					{
						bidcost = msg.split("~");
						document.getElementById("key_limit").innerHTML = "Minimum limit is Rs."+bidcost[0]+" and Maximum limit is Rs."+bidcost[1];
						document.getElementById("bid_min").value = bidcost[0];
						document.getElementById("bid_max").value = bidcost[1];
					}					
				}
				else
					alert(msg);
			}

			function roundNumber(field, number, decimals) { 
				// Arguments: number to round, number of decimal places
				var newnumber = new Number(number+'').toFixed(parseInt(decimals));
				field.value =  parseFloat(newnumber); // Output the result to the form field (change for your purposes)
			}
			
			function numbersonly(e) 
			{	
				var unicode=e.charCode? e.charCode : e.keyCode;	
				if((unicode < 48 || unicode > 57) && (unicode!=8 && unicode!=9 && unicode!=16 && unicode!=35 && unicode!=36 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=46))
				{		
					return false; 	
				}
			}

			function numbers_date(e) 
			{	
				var unicode=e.charCode? e.charCode : e.keyCode;	
				if((unicode < 48 || unicode > 57) && (unicode!=8 && unicode!=9 && unicode!=16 && unicode!=35 && unicode!=36 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=46 && unicode!=45))
				{		
					return false; 	
				}
			}

			function rexpem(em)
			{
				var emailpattern = /^[a-zA-Z0-9._-]+@[A-Za-z0-9.-]+\.[a-zA-Z]{2,4}$/;
				return emailpattern.test(em);
			}
			
			function trim(str)
			{
				var chars = " " || "\\s";
				var ltrm=str.replace(new RegExp("^[" + chars + "]+", "g"), "");
				return ltrm.replace(new RegExp("[" + chars + "]+$", "g"), "");
			}
			var url="";

			var user_id="<? echo $user_id; ?>";
			var user_type="<? echo $user_type; ?>";
			var ad_type="<? echo $_SESSION['ad']['type']; ?>";
			if(ad_type=='Free')
			{
				ad_maxchar = 20;
				ad_title = 15;
			}	
			else	
			{
				ad_maxchar=20;
				ad_title = 15;
			}
			
			function limitchar(curr_objid, maxchar, rem_obj)
			{
				var curr_obj=document.getElementById(curr_objid);
				var charleft=maxchar - curr_obj.value.length;

				if(charleft <= 0)
				{
					var charleft_currobj=0;					
					curr_obj.value=curr_obj.value.substr(0, maxchar);
					charleft=0;
				}				
			}
			
			function preview_show()
			{
				var title = trim(document.getElementById('title').value);
				var line1 = trim(document.getElementById('line1').value);
				var line2 = trim(document.getElementById('line2').value);
				var key_url = trim(document.getElementById('key_url').value);

				if(title != "")
					document.getElementById('prev_title').innerHTML=title;
				else
					document.getElementById('prev_title').innerHTML="Title Comes Over here";
					
				if(line1 != "")
					document.getElementById('prev_line1').innerHTML=line1;
				else
					document.getElementById('prev_line1').innerHTML="Ad Line 1 comes over here";
					
				if(line2 != "")
					document.getElementById('prev_line2').innerHTML=line2;
				else
					document.getElementById('prev_line2').innerHTML="Ad Line 2 comes over here";
					
				if(key_url != "")
				{
					var key_slice = key_url.slice(0,25);
					document.getElementById('prev_url').innerHTML = key_slice;
				}
				else
					document.getElementById('prev_url').innerHTML="www.jobtardis.in";
			}
			
			function change_status(user_id, status, campname)
			{
				var stat_conf = confirm("Do you really want to change the Ad status?");
			
				if(stat_conf == true)
				{
					if(status=="Live") 
						status="Pause";
					else 
						status="Live";
						
					var params="category=status&user_id="+user_id+"&campname="+campname+"&status="+status;			
					postdata("ad_viewdb.php", params, "status");
				}		
			}
			function view_dashboard()
			{
				alert("Published successfully");
				view();
			}
			
			function get_limit()
			{				
				var keyword_limit = document.getElementById('keyword').value;
				if(keyword_limit != "")				
				{
					var params = "category=GetLimit&key_search="+keyword_limit;
					postdata(url + "ad_viewdb.php", params, "GetLimit");
				}
				else	
				{	
					document.getElementById("key_limit").innerHTML = "Minimum limit is Rs.30.00 and Maximum limit is Rs.100.00";
				}
			}
		</script>
	</head>
	<body>
		<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td style="background-image:url(../images/bg.png);background-repeat:no-repeat;background-color:#eeeded;">
					<table width="100%" border="0" align="center" cellspacing="0">
						<tr>
							<td><?php include_once('../header.php'); ?></td>
						</tr>
						<tr>
							<?php include_once('../new/js_menu.php'); ?>
						</tr>
						<link rel="stylesheet" href="base/jquery.ui.all.css">
						<script src="jquery.js"></script>
						<script src="ui/jquery.ui.core.js"></script>
						<script src="ui/jquery.ui.widget.js"></script>
						<script src="ui/jquery.ui.datepicker.js"></script>
						<link rel="stylesheet" href="demos.css">
						<script type="text/javascript">
							function date_fn()
							{
								$(function() 
								{
									var dates = $('#from, #to').datepicker({
										defaultDate: "+1w",
										changeMonth: true,
										numberOfMonths: 1,
										minDate : 0,
										maxDate : "+3Y",
										onSelect: function(selectedDate) 
										{
											var option = this.id == "from" ? "minDate" : "maxDate";
											var instance = $(this).data("datepicker");
											var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
											dates.not(this).datepicker("option", option, date);
										}
									});
								});
							}
						</script>
						<tr>
							<td height="480" valign="top">
								<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td>&nbsp;</td>
									</tr>
									<!--  <tr>
									<td class="title">personal ads </td>
									</tr> -->
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
												  <td style="padding-top:10px;">
														<div style="clear:both;">			
															<div style="float:left; height:30px; padding-left:45px;" >
																<table border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td><img src="../images/btnLeft.png" width="13" height="28" /></td>
																		<td style="background-image:url(../images/btnBG.png)"><a href='http://www.jobtardis.in/personal_ad/personal_ad.php?personal_ad=payment' class='whiteContent'> Buy Credits </a></td>
																		<td><img src="../images/btnRight.png" width="13" height="28" /></td>
																	</tr>
																</table>
															</div>
															<div style="float:right; height:30px; padding-right:25px;vertical-align:middle" class="greyContent">
																Your current Balance : Rs.<?php echo (($rs_info['amount_rem'] != "")?$rs_info['amount_rem']:"0.00");?> 
																</div>
																<div style="float:left;margin-left:500px;" align="right">
																<table border="0" align="right" cellpadding="0" cellspacing="0">
																  <tr>
																	<td><img src="../images/btnLeft.png" width="13" height="28" /></td>
																	<td style="background-image:url(../images/btnBG.png)"><a href='#' class='whiteContent' onclick='checkad(<?php echo $cnt_ad;?>);'> Create Ad </a></td>
																	<td><img src="../images/btnRight.png" width="13" height="28" /></td>
																  </tr>
																</table>											
															</div>				
														</div>
														<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td class="wowAdBox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td width="5%">&nbsp;</td>
                                                                    <td><table border="0" cellspacing="0" cellpadding="0">
                                                                      <tr>
                                                                        <td><img src="images/personalAd_03.png" width="11" height="24" alt="" /></td>
                                                                        <td width="200" background="images/personalAd_04.png" class="whiteContent_b"><div align="center" id="dashdiv">Dashboard</div></td>
                                                                        <td><img src="images/personalAd_05.png" width="11" height="24" alt="" /></td>
                                                                      </tr>
                                                                    </table></td>
                                                                    <td><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
																		<tr>
																			<td width="25%" class="greyContent"><img src="../images/icon_live.png" alt="live"  hspace="5">Live</td>
																			<td width="25%" class="greyContent"><img src="../images/icon_incomplete.png" alt="incomplete" width="20" height="20" hspace="5">Incomplete</td>
																			<td width="25%" class="greyContent"><img src="../images/icon_pause.png" alt="pause" width="20" height="20" hspace="5">Pause</td>
																			<td width="25%" class="greyContent"><img src="../images/icon_awaiting.png" alt="awaiting" width="20" height="20" hspace="5">Awaiting</td>
																		</tr>
																	</table></td>
                                                                  </tr>
                                                                </table></td>
                                                              </tr>
                                                              <tr>
                                                                <td style="padding-top:15px;">
																<div id="show"></div>
																	<div id='keyword_show' name='keyword_show' style="display:none">
																		<table width="50%" cellpadding="4" cellspacing="0">
																			<tr>
																				<td width="15%" class="greyContent">Keyword:</td>
																				<td width="35%"><input type="text" id="keyword" onKeyUp='get_limit();' name="keyword" class="txtBox" maxlength="30"></td>
																			</tr>
																			<tr>
																				<td width="15%" class="greyContent">Bid click (INR):</td>
																				<td width="35%">
																					<input type="text" id="bid" name="bid" class="txtBox" onblur="extractNumber(this,2,true);"
 onkeyup="extractNumber(this,2,true);"
 onkeypress="return blockNonNumbers(this, event, true, true);"/><br/>
																					<input type="hidden" id="bid_min" name="bid_min">
																					<input type="hidden" id="bid_max" name="bid_max">
																					<span class="greyContent_small"><div id="key_limit">&nbsp;</div></span>
																				</td>
																			</tr>
																			<tr>
																				<td>&nbsp;</td>
																				<td width="35%"><input name="button" type="button" class="mediumButton" onClick="javascript:key_savefn();" value="Save Keyword" /></td>
																			</tr>
																		</table>	
																		<div id='list'> </div>
																	</div>
																	<br/>
																	<input type="hidden" name="tblid" id="tblid" value="">
																	<input type="hidden" name="campname_hidden" id="campname_hidden" value="">
																	<input type="button" class="button" value="Publish Ad" onclick='view_dashboard();' style="margin:5px;" id="publish_ad" name="publish_ad">
																	<br/>
																</td>
                                                              </tr>
                                                            </table></td>
                                                          </tr>
                                                        </table>
														<div align="right" style="padding:10px;"><br/>
														    <?php 
					if($_SESSION['curr_user']['user_type'] == "1")
					{
						echo "<br/><a href='http://www.jobtardis.in/myaccount_js.php' class='greyContent_u'> Back to My Account</a>"; 
					}
					else if($_SESSION['curr_user']['user_type'] == "2" || $_SESSION['curr_user']['user_type'] == "21" || $_SESSION['curr_user']['user_type'] == "22" || $_SESSION['curr_user']['user_type'] == "23")
					{
						echo "<br/><a href='http://www.jobtardis.in/myaccount_emp.php' class='greyContent_u'>Back to My Account</a>";
					}
					else
					{
						echo "<br/><a href='http://www.jobtardis.in/myaccount_rec.php' class='greyContent_u'>Back to My Account</a>";
					}
					?>
												        </div></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php require_once('../new/footer.php'); ?>
					</table>
				</td>
			</tr>
		</table>
		<script language="javascript"> view();</script>
	</body>
</html>