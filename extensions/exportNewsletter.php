<?php 
	require_once("../../../../wp-load.php");
	header ( "Content-type: application/vnd.ms-excel" );
	header ( "Content-Disposition: attachment; filename=newsleterExport_".date('dmY').".xls" );
	global $themePrefix; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Export</title>
</head>
<body>
	<?php 
		$users = get_users(array('role'=>'assinante_newsletter'));
		echo '<table><tr><th>Nome</th><th>Email</th><th>&Aacute;reas de Interesse</th></tr>';
		foreach ($users as $user) {
			echo '<tr><td>'.$user->display_name.'</td><td>'.$user->user_email.'</td><td>'.get_user_meta($user->ID, $themePrefix.'cat_interesting', true).'</td></tr>';
		}
		echo '</table>';
	?>
</body>
</html>