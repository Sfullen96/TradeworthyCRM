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
			<td> exists </td>
			<td> public static </td>
			<td> $name - Cookie name </td>
			<td> true or false </td>
			<td> Used to check if a cookie exists </td>
			<td> Cookie::exists('cookie_name'); </td>
		</tr>
		<tr>
			<td> get </td>
			<td> public static </td>
			<td> $name - Cookie name </td>
			<td> The cookie with the name given </td>
			<td> Used to retrieve a cookie </td>
			<td> Cookie::get('cookie_name'); </td>
		</tr>
		<tr>
			<td> put </td>
			<td> public static </td>
			<td> $name, $value, $expiry </td>
			<td> true if cookie added successfully, false if failed. </td>
			<td> Used to add a cookie </td>
			<td> Cookie::put('cookie_name', 'value', 'expiry'); </td>
		</tr>
		<tr>
			<td> delete </td>
			<td> public static </td>
			<td> $name - Cookie name </td>
			<td> N/A </td>
			<td> Used to delete a cookie </td>
			<td> Cookie::delete('cookie_name'); </td>
		</tr>
	</tbody>
</table>
<?php include '../../includes/footer.php'; ?>