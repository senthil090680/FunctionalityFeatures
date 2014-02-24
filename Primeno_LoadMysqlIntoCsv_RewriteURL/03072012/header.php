<?php 

////////////if link page is not included then it directlly get it 

$host="77.92.87.194";

$dbase="jobtarin_india";

$user="jobtarin_india";

$pwd="Q]O%PsU,}ch@";

$mylink=mysql_connect($host, $user, $pwd);

mysql_select_db($dbase);

require_once ("get_country_file.php");

$baseUrl ="http://www.jobtardis.in/";

function visit_fn($usr_id,$link,$user_type)

{

	$ip=$_SERVER['REMOTE_ADDR'];

	$country=get_country($ip);

	$city=get_city($ip);

	if($usr_id!="")

	{

		$query_select="SELECT username from jt_login where user_id='$usr_id'";

		$result_select=mysql_query($query_select,$link);

		$rs=mysql_fetch_array($result_select);

		$username=$rs['username'];

		$query_ins="INSERT INTO visit_site(username,ip,country,user_type,city)values('$username','$ip','$country','$user_type','$city')";

	}	

	else

	{

		$query_ins="INSERT INTO visit_site(ip,country,city)values('$ip','$country','$city')";

	}

	

	mysql_query($query_ins,$link);

}

$user_id=$_SESSION['curr_user']['user_id'];

$user_type=$_SESSION['curr_user']['user_type'];



////////////////add to visitor

	visit_fn($user_id,$mylink,$user_type);

	?>



<link href="<?=$baseUrl?>css/style.css" rel="stylesheet" type="text/css" />



<script language="javascript" src="<?=$baseUrl?>js/global.js" type="text/javascript"></script>		



<script language="javascript" src="<?=$baseUrl?>js/jobcategory.js" type="text/javascript"></script>



<script language="javascript" type="text/javascript">



function ClearText(id)



{



  document.getElementById(id).value="";



}



function Fill(id)



{



 if(document.getElementById(id).value=="")



 {



  document.getElementById(id).value='Type your skills';



 }



}







function Fills(id)



{



 if(document.getElementById(id).value=="")



 {



  document.getElementById(id).value='Type your city name';



 }



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

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25826610-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<style>

.b_box:hover{height:5px; z-index:100}

</style>

<div align="center">



	<div align="center" class="container">



	<!--- Header Part Start here -->



	  <div align="left" class="container">



		<div align="left" class="container fleft">



			<div align="left" class="mgnt10 fleft"><a href="<?=$baseUrl?>index.php"><img src="<?=$baseUrl?>img/jt-logo.gif" width="179" height="77" border="0" alt="" /></a>

            <table width="179"  border="0" background="#175ca5" style="color:#fff; margin-top:-21px; font-size:14px;">

  <tr>

    <td><marquee scrollamount="3">

				Jobtardis - It's more like a big globe of wibbly-wobbly, timey-wimey stuff Don't blink, I say don't blink. Apply for a Job Now.<span style="padding-left:100px;">Jobs??!!!! "ohh Yes"</span><span style="padding-left:100px;">Brand Me Resume Me Job Me</span>	

				<span style="padding-left:100px;">For the past 30 years there were many innovations in IT, but not in jobsites? Here is the job portal with innovations.</span><span style="padding-left:100px;">Who's here and there, and a bit everywhere, but the question should be "when", not "where" for Who.</span><span style="padding-left:100px;">Give up?  You're just starting to get it.  Who's stuck first in the JOBTARDIS, trying to get to home base -- the 4th dimension?  Why? Go to 4th dimension to go to 5th dimension.</span><span style="padding-left:100px;">Exterminate old job!!</span>

				<span style="padding-left:100px;">Remove the boring old job from your career. </span><span style="padding-left:100px;">"Regenerate" - New Job is here!</span><span style="padding-left:100px;">World's first Interactive Jobsite! Travel in Jobspace! </span><span style="padding-left:100px;">No Vacancies ... in Mars!</span><span style="padding-left:100px;">Alien's? Humanoids? Green Faces? Martians? No offence, Do not apply.</span><span style="padding-left:100px;">Here is a job waiting for you.</span><span style="padding-left:100px;">Yesterday midnight someone posted a job.</span>

				<span style="padding-left:100px;">One stop shop for your job search.</span><span style="padding-left:100px;">Search for a better jobsite ends here. There is no need to visit any other jobsite after registering with Jobtardis.</span><span style="padding-left:100px;">End of the Exiting Jobsites!</span><span style="padding-left:100px;">Who is wise? He who learns from everyone. Who is powerful? He who governs his passion. Who is rich? He who is content. Who is that?  It is none other than “You”.</span><span style="padding-left:100px;">All our job dreams can come true--if we have the courage to pursue them! Click Now..</span><span style="padding-left:100px;">There is a way to do it better...find it!</span><span style="padding-left:100px;">If opportunity doesn't knock, build a door "jobtardis way".</span><span style="padding-left:100px;">Who built the Egyptian pyramids? Hey wiki take care of the question. I need a job now.</span><span style="padding-left:100px;">It is time to fill the pocket of your pyjamas with dollars. Come join us and enjoy the life.</span>				

			</marquee>

</td>

  </tr>

</table>

            </div>



			<div class="fright">



            	<div class="headactiven fleft"><div id="headactiven"><a href="<?=$baseUrl?>index.php">Home</a></div></div>



				<div class="headactiven fleft"><div id="headactiven"><a href="<?=$baseUrl?>livejobboard.php">Live Job Board</a></div></div>



				<div class="headactiven fleft mgnl5"><!-- LiveZilla Chat Button Link Code (ALWAYS PLACE IN BODY ELEMENT) --><div style="text-align:center;width:117px;"><a href="javascript:void(window.open('http://www.jobtardis.in/livezilla/chat.php','','width=590,height=610,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))"><img src="http://www.jobtardis.in/livezilla/image.php?id=09&amp;type=inlay" width="117" height="19" border="0" alt="LiveZilla Live Help"></a></div><!-- http://www.LiveZilla.net Chat Button Link Code --><!-- LiveZilla Tracking Code (ALWAYS PLACE IN BODY ELEMENT) --><div id="livezilla_tracking" style="display:none"></div><script type="text/javascript">
var script = document.createElement("script");script.type="text/javascript";var src = "http://www.jobtardis.in/livezilla/server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)",1);</script><noscript><img src="http://www.jobtardis.in/livezilla/server.php?request=track&amp;output=nojcrpt" width="0" height="0" style="visibility:hidden;" alt=""></noscript><!-- http://www.LiveZilla.net Tracking Code --></div>



				<div class="headactiven fleft mgnl5"><div><a href="<?=$baseUrl?>jtFactor.php">David vs Goliath</a></div></div>



				<div class="headactiven fleft mgnl5"><div><a href="#" onClick="window.open('scrollingImage.html','scrollingImg','width=650,height=600')">What is Jobtaridis</a></div></div>



				<div class="headactiven fleft mgnl5"><div><a href="<?=$baseUrl?>business.php">Business with Us</a></div></div>



				<div class="headactiven fleft mgnl5"><div><a href="<?=$baseUrl?>castrology.php">Career Astrology</a></div></div>



				<div class="cleard"></div>



				<div class="fright jtface">



				 <ul>

<li style="margin-right:5px"><a href="javascript:void(0);"

NAME="JT Network Window" title=" Join the JT Network "

onClick=window.open("jt_network.php","Ratting","width=500,height=300,0,status=0,");><img src="images/jt.jpg" width="67" height="20" border="0" alt=""/></a> <div class="fb-like" style="width:40px; height:18px; float:left; overflow:hidden; background-image:url(images/jt_count_bg.png); color:#175CA5; font-size:11px; margin-left:5px">

<?php $selectq="Select counter from jt_counter where by_whom='jtindia'";

$result_select=mysql_query($selectq,$link);

		$rs=mysql_fetch_array($result_select);

		$counter=$rs['counter'];

		?><div id="jtLike" class="jtLike" align="center"><? 

		echo $counter; ?></div></div></li>

				 <li><div class="tweetbox" style="width:65px; height:30px; float:left; overflow:hidden;">

    <a href="https://twitter.com/jobtardis_tweet" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false"></a>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    </div></li>



				 <li><div class="linkedinbox" style="width:78px; height:30px; float:left; overflow:hidden;">

   <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>



<script type="IN/FollowCompany" data-id="2312779" data-counter="none"></script>



    </div></li>



				 <li><div class="googlebox" style="width:85px; height:30px; float:left; overflow:hidden;">

<link rel="canonical" href="<?=$baseUrl?>" />



<g:plusone></g:plusone>







    <script type="text/javascript">



      window.___gcfg = {



        lang: 'en-US'



      };







      (function() {



        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;



        po.src = 'https://apis.google.com/js/plusone.js';



        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);



      })();



    </script>     

    </div></li>



				 <li><div class="facebookbox" style="width:86px; height:30px; float:left; overflow:hidden;">

  <div id="fb-root"></div>



<script>(function(d, s, id) {



  var js, fjs = d.getElementsByTagName(s)[0];



  if (d.getElementById(id)) return;



  js = d.createElement(s); js.id = id;



  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";



  fjs.parentNode.insertBefore(js, fjs);



}(document, 'script', 'facebook-jssdk'));</script>



<div class="fb-like" data-href="http://www.facebook.com/jobtardis.in" data-send="false" data-layout="button_count" data-width="420" data-show-faces="true" data-font="arial"></div>  

    </div></li>



				



				



				 </ul><br /><br />



                 	



				</div>



		  </div>



	   </div>



	   <div align="left" class="container fleft">



			<div class="fleft mgnt16"></div>



			<div class="menu fleft">



				<ul>



				<li><a href="#">Seeking Jobs</a>

    			<div class="dropdown_1column align_left">


						<div class="col_1">
	

							<ul class="simple fleft">

								<li><a href="<?=$baseUrl?>index.php">Jobs</a></li>

								<li><a href="<?=$baseUrl?>bidding/emp_rec_bid_search.php">Bids </a></li>

								<li><a href="<?=$baseUrl?>quiz_search.php">Tests </a></li>

								<li style="border:none;"><a href="<?=$baseUrl?>arw/networkme/friends.php">Net.Me</a></li>
				
							</ul>   <div class="fleft brdrmid" style="height:100px;"></div>

							 <ul class="simples fleft">

								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/disc_list.php" class="padl10">Discussions </a></li>

								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/my_group.php" class="padl10">Groups</a></li>

								<li style="border:0px;"><a href="<?=$baseUrl?>Resumeticker.php" class="padl10">Ticker Application</a></li>                                               
							</ul> 

						</div>					

				</div>         
				</li>

				<li><a href="#">Seeking Resumes</a>

    			<div class="dropdown_1column align_left">

						<div class="col_1">

	
							<ul class="simple fleft">



								<li><a href="<?=$baseUrl?>resume_search.php">Resumes</a></li>



								<li><a href="<?=$baseUrl?>videoCV.php">Video CV </a></li>



								<li><a href="<?=$baseUrl?>bidding/emp_rec_bid_search.php">Bids </a></li>



								<li><a href="<?=$baseUrl?>quiz_search.php">Tests </a></li>



								<li style="border:none;"><a href="<?=$baseUrl?>arw/networkme/friends.php">Net.me</a></li>



								



							</ul>   <div class="fleft brdrmid"></div>



							 <ul class="simples fleft">



								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/disc_list.php" class="padl10">Discussions</a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/my_group.php" class="padl10">Groups</a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>ats/client_tracking.php" class="padl10">ATS </a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>ats/resume_list_display.php" class="padl10">RTS</a></li>



								<li style="border:0px;"><a href="<?=$baseUrl?>Resumeticker.php" class="padl10">Ticker Application  </a></li>                                               



							</ul> 



						</div>					



				</div>        



				</li>



				<li><a href="#">Seeking Employees</a>



    			<div class="dropdown_1column align_left">



				



						<div class="col_1">



						



							<ul class="simple fleft">



								<li><a href="<?=$baseUrl?>uploadresume.php">Resumes</a></li>



								<li><a href="<?=$baseUrl?>videoCV.php">Video CV  </a></li>



								<li><a href="<?=$baseUrl?>bidding/emp_rec_bid_search.php">Bids </a></li>



								<li><a href="<?=$baseUrl?>quiz_search.php">Tests </a></li>



								<li style="border:none;"><a href="<?=$baseUrl?>arw/networkme/friends.php">Net.Me</a></li>



								



							</ul>   <div class="fleft brdrmid"></div>



							 <ul class="simples fleft">



								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/disc_list.php" class="padl10">Discussions</a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>arw/networkme/my_group.php" class="padl10">Groups</a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>ats/client_tracking.php" class="padl10">ATS </a></li>



								<li style="border-right:0px;"><a href="<?=$baseUrl?>ats/resume_list_display.php" class="padl10">RTS</a></li>



								<li style="border:0px;"><a href="<?=$baseUrl?>Resumeticker.php" class="padl10">Ticker Application  </a></li>                                               



							</ul> 



						</div>					



				</div>         



				</li>



				<li class="b_box"><a href="http://jbtrds.cm/17496">Blosp</a>



    			



				</li>



				<li style="height:5px;background-image:none;"><a href="<?=$baseUrl?>newsroom.php">News Room</a></li>				



				</ul>



			</div>



			<div class="fleft mgnt20 morebttn">

			<ul>

			<li>

			<div class="dropdown_2column align_left">

						<div class="col_1">

							<ul class="simple fleft">

								<li><a href="<?=$baseUrl?>resume_search.php">Resumes</a></li>
								<li><a href="<?=$baseUrl?>business.php">Video CV  </a></li>



								<li><a href="<?=$baseUrl?>bidding/emp_rec_bid_search.php">Bids </a></li>



								<li><a href="<?=$baseUrl?>quiz_search.php">Tests </a></li>



								<li style="border:none;"><a href="<?=$baseUrl?>arw/networkme/friends.php">Net.Me</a></li>



								



							</ul>   <div class="fleft brdrmid"></div>



							 <ul class="simples fleft">



								<li style="border-right:0px;"><a href="arw/networkme/disc_list.php" class="padl10">Discussions</a></li>



								<li style="border-right:0px;"><a href="arw/networkme/my_group.php" class="padl10">Groups</a></li>



								<li style="border-right:0px;"><a href="ats/client_tracking.php" class="padl10">ATS </a></li>



								<li style="border-right:0px;"><a href="#" class="padl10">RTS</a></li>



								<li style="border:0px;"><a href="Resumeticker.php" class="padl10">Ticker Application  </a></li>                                               



							</ul> 



						</div>					



				</div>



			</li>



			</ul>			



			</div>



			<div class="fleft mgnt20 morebttn">



			<ul>



			<li><a href="#" class="drop">More</a>



			<div class="dropdown_2column align_left">


	



						<div class="col_2">



							<div class="simplemore fleft">



								<ul>



								<li><a href="<?=$baseUrl?>resume_search.php">Resumes</a></li>



								<li><a href="<?=$baseUrl?>search_wowcv.php">Video CV  </a></li>



								<li><a href="<?=$baseUrl?>bidding/emp_rec_bid_search.php">Bids </a></li>



								<li><a href="<?=$baseUrl?>quiz_search.php">Tests </a></li>



								<li style="border:none;"><a href="<?=$baseUrl?>arw/networkme/friends.php">Net.Me</a></li>



								</ul>



							</div>



						</div>					



				</div>



			</li>



			</ul>			



			</div>



			<div class="fleft uploadbrdr"><a href="<?=$baseUrl?>upload_resume.php">Upload Resume</a><span>/</span><a href="<?=$baseUrl?>videoCV.php">Create Video CV</a></div>



	   </div>



       <div class="fright mgnt3 mgnl20"><!--<a href="#" class="largetxt txtdecornone clr1">Help</a>--></div>



<?php if (isset($_SESSION['curr_user']['user_type'])){ ?>

					<div class="fright mgnt3 mgnl20">

                    <span class="largetxt txtdecornone clr1">Welcome  <?php



						 if (($_SESSION['curr_user']['user_type'])==1)



							{	echo ucfirst($_SESSION['curr_user']['fname']); }



							else



							if ($_SESSION['curr_user']['user_type']=='2' || $_SESSION['curr_user']['user_type']=='21' || $_SESSION['curr_user']['user_type']=='22' || $_SESSION['curr_user']['user_type']=='23')



							{



							echo ucfirst($_SESSION['curr_user']['company_name']); 



							}



							else



							{



							echo ucfirst($_SESSION['curr_user']['company_name']);



							}



							?>, 



							</a> <a href="<?=$baseUrl?>logout.php?logout=logout" class="blueContent_u">Logout</a></span>

                            </div>

<?php } ?>

      </div>



       </div>



</div>



	<!--- Header Part End here -->	





