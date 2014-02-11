<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form id="formid">
	<textarea></textarea>
	<input type="submit" value="Submit" />
</form>
<table border="1">
	<tr>
		<th>NAME</th>
	</tr>
	<?php //exit;
		$con = mysql_connect('localhost','root','hari') or die(mysql_error());  
		mysql_select_db('test',$con) or die(mysql_error());
		$query = "SELECT name FROM fruit";
		$res = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($res)) {
	?>
	<tr>
		<td><?php echo $row[name]; ?></td>
	</tr>
	<?php } ?>
</table>
</body>
</html>
<!--
 fruit | CREATE TABLE `fruit` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `isDeleted` int(11) DEFAULT NULL,
 `fruit_price` varchar(255) DEFAULT NULL,
 `email_sent` enum('0','1') DEFAULT '0',
 PRIMARY KEY (`id`)
 ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 |

mysql> insert into fruit (name,isDeleted,fruit_price,email_sent) values ("<script>document.location=http://www.google.co.in</script>",0,2500,0);
Query OK, 1 row affected, 1 warning (0.05 sec)

mysql> select * from fruit;
+----+------------------------------------------------------------+-----------+-------------+------------+
| id | name                                                       | isDeleted | fruit_price | email_sent |
+----+------------------------------------------------------------+-----------+-------------+------------+
|  1 | apple                                                      |         1 | 1000        | 0          |
|  2 | mango                                                      |         2 | 2000        | 0          |
|  3 | pineapple                                                  |         1 | 3000        | 0          |
|  4 | grapes                                                     |         0 | NULL        | 0          |
|  5 | orange                                                     |         1 | 5000        | 0          |
|  6 | <script>document.location=http://www.google.co.in</script> |         0 | 2500        |            |
+----+------------------------------------------------------------+-----------+-------------+------------+
6 rows in set (0.00 sec)

-->