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
			<th> Returns </th>
			<th> Description </th>
			<th> Usage </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> make </td>
			<td> public static </td>
			<td> $string, $salt = '' </td>
			<td> A sha256 hash with a concatonated salt </td>
			<td> Used to make a hash </td>
			<td> Hash::make('string', 'salt'); </td>
		</tr>
		<tr>
			<td> salt </td>
			<td> public static </td>
			<td> $length </td>
			<td> mycrypt_create_iv </td>
			<td> Creates a salt </td>
			<td> N/A </td>
		</tr>
		<tr>
			<td> unique </td>
			<td> public static </td>
			<td> N/A </td>
			<td> Makes a unique ID </td>
			<td> Used to create a unique ID </td>
			<td> N/A </td>
		</tr>
	</tbody>
</table>
<?php include '../../includes/footer.php'; ?>