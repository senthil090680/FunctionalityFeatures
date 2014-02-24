<?php
session_start();

include('ps_pagination.php');

require_once ("dbfunctions_jt.php");
$user_type=$_SESSION['curr_user']['user_type'];
$user_id=$_SESSION['curr_user']['user_id'];
$link= dblink();
if(isset($_POST['keyword']) || isset($_SESSION["videocv_keyword"]))
{
	$keyword=$_POST['keyword'];
	
	if($keyword=="")
	{
		$keyword=$_SESSION["videocv_keyword"];
	}
} 
if($_REQUEST['or'])
	{
		$orBy = $_REQUEST['or'];
		$orType = $_REQUEST['ty'];
	}
	else
	{	
		$orBy = "videoAdId";
		$orType = "DESC";
	}

	if($orType == 'DESC')
	{
		$orNext = 'ASC';
		$orImg = "images/down.png";
	}
	else
	{
		$orNext = 'DESC';
		$orImg = "images/up.png";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>World's First Knowledge Auction Job Portal | Jobtardis.in</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/global.js" ></script>		
<script language="javascript" src="js/jobcategory.js" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


<link rel="stylesheet" type="text/css" href="css/home-page-only.css" />
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


<script type="text/javascript" src="js/accordion.js">
/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

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

.urbangreymenu{
width: 300px; /*width of menu*/
}

.urbangreymenu .headerbar{
font: bold 13px Verdana;
color: white;
background: #175ca5; /*last 2 values are the x and y coordinates of bullet image*/
margin-bottom: 0; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 7px 0 7px 7px; /*31px is left indentation of header text*/
margin-top:1px;
}

.urbangreymenu .headerbar a{
text-decoration: none;
color: white;
display: block;
}

.urbangreymenu ul{
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 0; /*bottom spacing between each UL and rest of content*/
}

.urbangreymenu ul li{
/*padding-bottom: 2px; bottom spacing between menu items*/
}

.urbangreymenu ul li a{
font: normal 12px Arial;
color: black;
background: #cccccc;
display: block;
padding: 5px 0;
line-height: 17px;
padding-left: 8px; /*link text is indented 8px*/
text-decoration: none;
}

.urbangreymenu ul li a:visited{
color: black;
}

.urbangreymenu ul li a:hover{ /*hover state CSS*/
color: white;
background: black;
}
a.package{
	background-color:#cccccc;
}
a.package:hover{
	background-color:#f8f3a8;
	background-color:transparent;
}

</style>

<link href="css/showContent.css" rel="stylesheet" type="text/css" />
<link href="jobtardis.css" rel="stylesheet" type="text/css" />


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
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/svideocv.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="<?=$baseUrl?>search_wowcad.php">Video CV</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/repuindex.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.repuindex.com/">Repuindex</a>
		<div class="cleard"></div>
	</div>
	<div align="left" class="slidemenu">
		<a class="fleft" href="#"><img width="19" height="19" border="0" alt="" src="img/wowcv.gif" /></a><a class="fleft mgnl10 clr36 jt_bg1" href="http://www.wow-cv.com/">Wow Video AD</a>
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
<body>
<?php

if(!empty($_POST['keyword']))
{
	$keyword=$_POST['keyword'];
}

if(!empty($_GET['keyword']))
{
	$keyword=$_GET['keyword'];
}
$_SESSION['videocv_keyword']=$keyword;
$all_keyword=$keyword;
$spl_key_tab = preg_replace('/[^a-zA-Z0-9+]/', ' ', $all_keyword);  
$keyword=trim($spl_key_tab);
/*$query_view="SELECT Distinct wsv.dtstamp,wsv.keyword,wsv.user_id,wsf.filename,wsv.title,js.fname,
			 js.lname,ju.city,ju.country FROM wow_savevideoscript wsv
				inner join wow_saveuserfileinfo wsf
				on wsf.user_id=wsv.user_id
				inner join jt_js_details js
				on js.user_id=wsv.user_id
				inner join jt_userdetails ju
				on ju.user_id=wsv.user_id
				WHERE ( MATCH (wsv.keyword,wsv.videoscript,wsv.title)
			AGAINST ('$keyword' IN BOOLEAN MODE) ) and wsf.filetype='flv'";
			$query_view .= " ORDER BY ".$orBy." ".$orType;*/

$query_view="SELECT videoAdId,user_id, title, description, keyword, contactDetails, template, voiceover,
f_family,f_size,f_color,f_style,voiceover_country,voiceover_sex,
images1,images2,images3,images4,location_path,swffile_path1,swffile_path2,swffile_path3,swffile_path4,swffile_path5,
swffile_path6,swffile_path7,swffile_path8,swffile_path9,swffile_path10,imgname1,imgname2,imgname3,imgname4,imgname5,imgname6,imgname7,imgname8,imgname9 FROM videoAd 
				WHERE keyword = '$keyword'";
			$query_view .= " ORDER BY ".$orBy." ".$orType;
$result_view=mysql_query($query_view,$link);

$cnt=mysql_num_rows($result_view);
?>
<!--- Main Part Start here -->
<div align="center">
	<div align="center" class="container">
	<!--- Header Part Start here -->
	  	  <?php include_once("../header_new.php");?>
	<!--- Header Part End here -->	
	<!--- Business Part Start here -->
	  <div align="left" class="container fleft mgnt10">
		 
		<div class="fleft busnwdt">
			<div class="fleft"><img src="img/jt-busntopbg.gif" width="992" height="4" /></div>
			<div class="bgclr1 busnwdt fleft">
				<div class="busnn-head"></div><div class="cleard"></div>
				<div class="fleft" style="width:516px;">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="50%" style="padding:10px;" valign="top">
  <table width="420" border="0" align="right" cellpadding="0" cellspacing="0">
    <tr>
      <td>
        <div name="keyword_form" id="keyword_form">
		<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="title"> WOW Video Ad Search Results</td>
  </tr>
    <tr>
  <td>
  <form  method="post" action="search_wowvAd.php">
<table width="850" cellpadding="4">
<td width="485" class="blueContent_b"><div align="right">Search : </div></td>
<td width="502" class="darkGreyContent">
<div class="textBoxDiv_small" style="float:left">
<input type="text" name="keyword" id="keyword" class="txtBox_small" value="<?echo $all_keyword;?>" /><input type="submit" value="Search" />
</div>
<div class="comments"> E.g. php+java+sap~mysql </div></td>
</tr></table></form>
</td></tr>
<tr>								
	<td align="center">
	<?php
	if($keyword!="")
	{
	?>
	<table > 
		<tr>
			<td width="285" class="blueContent_b" align="left" ><div>Showing results for: "<?php echo $all_keyword; ?>"</div></td>
			<td width="200" class="blueContent_b" align="right" ><div>Total results: <?php echo $cnt; ?></div></td>
			
		</tr>
	</table>
	</td>								
</tr>
  <tr align="center">
    <td  colspan="3">
    
    <table width="990" border="0" cellspacing="0" cellpadding="0">
  <tr>
 
	
    <td  width="745" valign="top" align="left">
<?php

if($cnt>0)
	{
	
		$page_links=mysql_num_rows($result_view)/10;
		 if(mysql_num_rows($result_view)%10>0)
		 {
			 $page_links=$page_links+1;
		 }
		$pager = new PS_Pagination($link, $query_view, 10,  $page_links, "keyword=$keyword"."&or=".$orBy."&ty=".$orType);
		$pager->setDebug(true);
		$rs = $pager->paginate();
		if(!$rs) die(mysql_error());
		if($page_links>=2)
			echo $pager->renderFullNav();
		echo "<br />\n";
		$page_num=0;
	/*****************pagination***************/
?>
			
<table border='0' cellpadding="0" cellspacing="0" style="background-image:url(../../images/blueBar.png);background-repeat:repeat-x;width:745px;">

  <tr>
  
  <td width="167" height="30" class="whiteContent_b" style="padding-left:5px">Video Ads</td>
   <td width="370" height="30" class="whiteContent_b">Details</td>
   <td width="172" height="30" class="whiteContent_b"><a href="search_wowvAd.php?or=dtstamp&keyword=<?php echo $all_keyword; ?>&ty=<?php echo $orNext;?>" title="Order by Date" class="whiteContent_bu">Date</a><?php echo imgRes($orBy,"dtstamp");?></td>
   </tr>

<?php
$z=0;
$imgpath        =       '';
while($row_view = mysql_fetch_assoc($rs))
{
    if($row_view[imgname1]){
        $imgpath    =   $row_view[imgname1].';'.$row_view[swffile_path1];
    } if($row_view[imgname2]){
        $imgpath    .=   ','.$row_view[imgname2].';'.$row_view[swffile_path2];
    } if($row_view[imgname3]){
        $imgpath    .=   ','.$row_view[imgname3].';'.$row_view[swffile_path3];
    } if($row_view[imgname4]){
        $imgpath    .=   ','.$row_view[imgname4].';'.$row_view[swffile_path4];
    } if($row_view[imgname5]){
        $imgpath    .=   ','.$row_view[imgname5].';'.$row_view[swffile_path5];
    } if($row_view[imgname6]){
        $imgpath    .=   ','.$row_view[imgname6].';'.$row_view[swffile_path6];
    } if($row_view[imgname7]){
        $imgpath    .=   ','.$row_view[imgname7].';'.$row_view[swffile_path7];
    } if($row_view[imgname8]){
        $imgpath    .=   ','.$row_view[imgname8].';'.$row_view[swffile_path8];
    } if($row_view[imgname9]){
        $imgpath    .=   ','.$row_view[imgname9].';'.$row_view[swffile_path9];
    } 
    $swfpathArr     =       explode(',',$swfpath);
    $imgfileArr     =       explode(',',$imgpath);
    /*echo "<pre>";
    print_r($imgfileArr);
    echo "</pre>";*/
$z++;    
    //Start of Image foreach for multiple images in same keyword
    foreach($imgfileArr as $imgValue) {
      //echo $imgValue."34232";
            $twopath        =   explode(';',$imgValue);
		if ($z % 2) 
		{
		  $css="oddCss";
		} 
		else 
		{
		  $css="evenCss";
		}  
			$user_id=$row_view['user_id'];
		$query_in="select ws.filename from wow_video_reference wv
					inner join wow_saveuserfileinfo ws
					on ws.reference_id=wv.referer_id
					where wv.user_id='$user_id' and ws.filetype='flv'";
					$result_in=mysql_query($query_in,$link);
					
					$own_filename=$row_view['filename'];
					
					$own_thumb=str_replace(".flv",".jpg",$own_filename);
					$ref_cnt=mysql_num_rows($result_in);
				?>
				<tr>
					
					<td class='greyContent <?php echo $css; ?> '>
                    <div class="playbutton" style="position:absolute;cursor:pointer" onclick="window.location='http://www.jobtardis.in/new/playback.php?filename=<?php echo $twopath[1]; ?>'"></div>
                    <a href="http://www.jobtardis.in/new/playback.php?filename=<?php echo $twopath[1]; ?>">
                    
                    <img src="http://www.jobtardis.in/new/JT_V_Ad/<?php echo $twopath[0]; ?>"  height="90" width="140" hspace="10" vspace="10" class="imageBorder_wowcv" /></a><br />
				<?php if($ref_cnt>0)
					  {
				?>
					<b>Video Reference: </b><?php echo $ref_cnt; ?> 
				<?php
					}
				?>  </td>
					<td class='greyContent <?php echo $css; ?> '> 
					
					<?php 
					$country_city=ucfirst($row_view['city']);	

					if($country_city!="")	

					{		
						if($row_view['country']!="")
						{
							$country_city=$country_city.", ".ucfirst($row_view['country']);
						}

					}	

					else	

					{		

						$country_city=ucfirst($row_view['country']); 	

					}
					
					
					echo "<b>Description: </b>".ucfirst($row_view['description']). "<br/>"."<b>Contact Details: </b>".ucfirst($row_view['contactDetails'])." ".$row_view['lname'];
					if($country_city!="")
					{
						"<br/>"."<b>Location: </b>".$country_city;
					}
					?><br />
<?php
								if(mysql_num_rows($result_in)>0)
								{
									while($row_in = mysql_fetch_assoc($result_in))
									{
										$ref_filename=$row_in['filename'];
					
										$ref_thumb=str_replace(".flv",".jpg",$ref_filename);
										?>
                                        <!--div class="playbutton_small" style="position:absolute;cursor:pointer" onclick="window.location='http://www.jobtardis.in/playback.php?filename=<?php echo $row_view['filename']; ?>'"></div-->
										<a href="http://www.jobtardis.in/playback.php?filename=<?php echo $row_in['filename']; ?>"><img src="http://www.jobtardis.in/wowcv/uploadedImage/<?php echo $ref_thumb; ?>" height="35" width="60" hspace="0" vspace="10" class="imageBorder_wowcv" /></a>
									<?php
									} }
									   ?> </td>
                    <td class='greyContent <?php echo $css; ?> '>Created on:<?php echo date("d-M-Y", strtotime($row_view['dtstamp']))?></td>
				</tr>
				
					<?php
						
	
} //End of Image foreach for multiple images in same keyword
			}

?>
</table>
<?php //Display the link to first page: First
if($page_links>=2)
{
		echo $pager->renderFullNav();
	}
	}
	else
	{
	?>

<br />
		<table align="center" width="600" cellpadding="0" cellspacing="0" border="0">
		  <tr><td style="padding-left:100px;"><span class="blueTitle">Your search  returned no results.</span><br /><br />

              <span class="content_b">Suggestions</span>
<ul style="padding-left:15px;padding-top:5px;margin:0;"><li class="greyContent">Make sure all words are spelled correctly.</li>
<li class="greyContent">Try different or related keywords.</li>
<li class="greyContent">Try more general keywords.</li>
<li class="greyContent">Try fewer keywords</li></ul></td>
		</tr></table><br>
<?php
	}
	
	?>

</td>
<td width="245" valign="top" align="left"><div id="personal_ads_div_even"></div></td>
  </tr>
</table>
<?php
}

?>
</td>

  </tr>
</table>
</div>	</td>
      </tr>
  </table>	</td>
    
  </tr>
</table>
				
				</div>
				
				
				
		  </div>
		
		</div>
		<div class="jtbusnrgtbg fleft"></div>
		  
		  
	  </div>  <div class="cleard"></div> <br clear="all"/>
	<!--- Business Part End here -->
	</div>	
</div>
<!--- Main Part Start here -->

<!--- Footer Part here-->
<?php include("footer.php");?>
<!--Footer Part here -->
</body>
</html>
<?php
	function imgRes($orBy, $currentField)
	{
		global $orImg;
		if($orBy == $currentField)
		{
			echo '<img src="'.$orImg.'" border=0 />';
		}
		else
		{
			return '';
		}
	}
	?>
