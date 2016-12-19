<?php 

	require_once '../core/init.php';
	include '../includes/header.php';

?>

<table class="table table-hover dataTable">
	<thead>
		<tr>
			<th> Class Name </th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$files = array();
	$dir = opendir('../classes'); 
	while(false != ($file = readdir($dir))) {
	    if(($file != ".") and ($file != "..") and ($file != "index.php")) {
	            $files[] = $file; // put in array.
	    }   
	}
	natsort($files); 
	?>
		
		<?php foreach($files as $file) { ?>
		<tr>
			<td><a href="<?= Config::get('root/root').'documentation/classesFolder/'.$file; ?>"><?= $file; ?></a></td>
		</tr>
		<?php } ?>
		
	</tbody>
</table>

<?php include '../includes/footer.php'; ?>