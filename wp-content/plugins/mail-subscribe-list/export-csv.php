<?php 
require_once '../../../wp-load.php';
if (current_user_can('manage_options')) {
	header("Content-type: application/force-download"); 
	header('Content-Disposition: inline; filename="subscribers'.date('YmdHis').'.csv"');  
	$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."sml");
	echo "First Name,Last Name,Email Address\r\n";
	if (count($results))  {
		foreach($results as $row) {
			$n = doSplitName($row->sml_name);
			echo $n['first'].','.$n['last'].','.$row->sml_email."\r\n";
		}
	}
}

function doSplitName($name) {
    $results = array();

    $r = explode(' ', $name);
    $size = count($r);

    if (mb_strpos($r[0], '.') === false) {
        $results['salutation'] = '';
        $results['first'] = $r[0];
    } else {
        $results['salutation'] = $r[0];
        $results['first'] = $r[1];
    }

    if (mb_strpos($r[$size - 1], '.') === false) {
        $results['suffix'] = '';
    } else {
        $results['suffix'] = $r[$size - 1];
    }

    $start = ($results['salutation']) ? 2 : 1;
    $end = ($results['suffix']) ? $size - 2 : $size - 1;

    $last = '';
    for ($i = $start; $i <= $end; $i++) {
        $last .= ' '.$r[$i];
    }
    $results['last'] = trim($last);

    return $results;
}
?>