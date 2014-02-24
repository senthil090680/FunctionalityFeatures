<?php
session_start();
require_once("includes/functions.php");

error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);

if(MACHINE_A_ACCESS && MACHINE_B_ACCESS) {
require_once("includes/header.php"); ?>
<tr>
	<td>
		<p>View Your Products in this Machine</p>
	</td>
</tr>
<tr>
	<td>
		<table class="tablecss" border='1'>
			<tr class="thead">
				<th>Product ID</th>
				<th>Customer Name</th>
				<th>Product Name</th>
				<th>Product Number</th>
			</tr>
			<?php 			
			$result = SingleTon::selectQuery("id,customerName,productName,productNumber","ORDER BY id DESC",TABLE_PRODUCTS,MY_ASSOC,NOR_YES);

			$row_count = 0;
			$num_rows = $result[0];
			
			if($num_rows > 0) {

				foreach($result[1] as $result){
					$product_id				=	$result["id"];
					$customerName			=	$result["customerName"];
					$productName			=	$result["productName"];
					$productNumber			=	$result["productNumber"];

					$row_count++;
					if ($row_count%2 == 0) $row_class = 'class="odd"';
					else $row_class = 'class="even"';
			?>
			<tr <?php echo $row_class;?> >      
				<td><?php echo $product_id;		?></td>
				<td><?php echo $customerName;	?></td>
				<td><?php echo $productName;	?></td>
				<td><?php echo $productNumber;	?></td>
			</tr>
			<?php } } else { ?>
				<tr <?php echo $row_class; ?> >      
				<td colspan='11' align='center'>No Results Found</td>
				</tr>	
			<?php } ?>
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