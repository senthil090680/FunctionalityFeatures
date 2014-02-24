<?php
session_start();
require_once("includes/functions.php");

//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);

if(MACHINE_A_ACCESS && MACHINE_B_ACCESS) {
	
	if($_POST) {
		extract($_POST);			
			//echo debugerr($_POST);
			//exit(0);
		if(isset($_POST['action']) && $_POST['action'] != '' ) {
			
			if($_POST['action'] == 'new') {
				$queryInsert	=	"insert into ".TABLE_PRODUCTS." (customerName,productName,productNumber,insertedDate) values ('$customerName','$productName','$productNumber',NOW())";

				$resultInsert	=	mysql_query($queryInsert) or die(mysql_error());;

				if($resultInsert) {
					$msg	=	"Datas inserted successfully";
				}
				else {
					$msg	=	"Datas are not inserted";
				}
			}
		}
	}

	require_once("includes/header.php");
	?>
	<script type="text/javascript">

$.validator.setDefaults({
	submitHandler: function() {
		form.submit();
	}
});

$().ready(function() {
	$.validator.addMethod("alphacheck", function(value,element,params) {
		var alphapattern = /^[A-Za-z ]+$/;
			if (!alphapattern.test(value)) {
				return false;
		   } else {
				return true;
		   }
		}, "Only Alphabets"
	);
	$.validator.addMethod("alphanumcheck", function(value,element,params) {
		var alphanumpattern = /^[A-Za-z0-9 ]+$/;
			if (!alphanumpattern.test(value)) {
				return false;
		   } else {
				return true;
		   }
		}, "Only Alphabets & Numbers"
	);

	// Validate Product Add form on submit

	$("#productadd").validate({
		onkeyup: false,
		onkeydown: false,
		rules: {
			customerName: { 
				required: true,
				alphacheck : true
			},
			productName: {
				required : true,
				alphanumcheck : true
			},
			productNumber : {
				required:true,
				number:true,
				minlength: 16
			}	
		},
		messages: {
			customerName: {			
				required: "* Required Field",
			},
			productName: {
				required: "* Required Field",
			},
			productNumber: {
				required:"* Required Field",
				number:	"Product Number Should be Numeric",
				minlength:	"Product Number Should be a 16-Digit number",
			}			
		}
	});
});

function newPlan(){
	d												=	document.productadd;
	d.customerName.value							=	"";
	d.productName.value								=	"";
	d.productNumber.value							=	"";
	d.action.value									=	"new";
	d.submitPlan.value								=	"Replicate";
	document.getElementById("form-tab").innerHTML	=	"New Product";
	$("#formPlan").show();
	$("#backmsg").hide();
	location.href									=	"#formPlan";
}
</script>
	<?php if(isset($msg) && $msg != '') { ?>
	<tr>
		<td>
			<span id='backmsg'><?php echo $msg; ?></span>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td>
			<p>Manage Your Products</p>
		</td>
	</tr>
	<tr>
		<td>
			<div id='formPlan' style="display:none;">
				<div id="form-tab" class="form-tab"></div>
				<div class="clear"></div>
				<form name="productadd" id="productadd" action="" method="post" enctype='multipart/form-data'>
					<fieldset>
						<p>
							<label style="padding-right:20px;">Customer Name</label>:&nbsp;&nbsp;
							<input name="customerName" id="customerName" class="text-long"  type="text" maxlength='100'/>
						</p>
						<p>
							<label style="padding-right:20px;">Product Name</label>:&nbsp;&nbsp;
							<input name="productName" id="productName" class="text-long"  type="text" maxlength='100'/>
						</p>
						<p>
							<label style="padding-right:20px;">Product Number</label>:&nbsp;&nbsp;
							<input name="productNumber" id="productNumber" class="text-long"  type="text" maxlength='16'/>
						</p>
						<input id="submitPlan" type="submit" value="" class="button-submit"/>
						<input type="hidden" name="action" value="" />
					</fieldset>
				</form>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="add_link"><a href="" onclick="newPlan();return false;" class="button-submit">New Product</a></div>
		</td>
	</tr>				
	<tr>
		<td>
			<div class="add_link"><a href="http://<?php echo MACHINE_A."/".ROOT_DIRECTORY."dataview_b.php"; ?>" class="button-submit">Other Machine View</a></div>
		</td>
	</tr>
			</table>
		</td>
	</tr>
	  <tr>
		<td bgcolor="#333333">&nbsp;</td>
	  </tr>
<?php } else {
	redirect(RELATIVE_PATH."notallow.php");
}
?>
</table>
</body>
</html>