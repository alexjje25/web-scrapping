<?php
require_once 'init.php';

$PDO = db_connect();

$sql = "SELECT * FROM acessos ORDER BY id DESC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<?php while ($info = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

	<tr>
		<td> <?php echo $info['ip'] ?></td>
		<td> <?php echo $info['estado'] ?> </td>
		<td> <?php echo $info['dispositivo'] ?> </td>
		<td> <?php echo $info['sistema'] ?> </td>
		<td> <?php echo $info['data'] ?> </td>
	</tr>
<?php endwhile; ?>