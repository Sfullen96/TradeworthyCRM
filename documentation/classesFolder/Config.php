<?php 

require_once '../../core/init.php';
include '../../includes/header.php';

?>

<table class="table table-hover dataTable">
	<thead>
		<tr>
			<th> Method Name </th>
			<th> Method Type </th>
			<th> Parameters </th>
			<th> Description </th>
			<th> Usage </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> get </td>
			<td> public static </td>
			<td> $path = null </td>
			<td> Used to get an element from the GLOBALS['config'] array located in core/init.php </td>
			<td> Config::get('config element/inner element'); E.G. Config::get('mysql/host'); would output the stored mysql host in core/init.php<br>
			'mysql' => array(
				'host' => 192.168.1.1,
			) </td>
		</tr>	
	</tbody>
</table>

<?php include '../../includes/footer.php'; ?>