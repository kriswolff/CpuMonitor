<?php
header('Content-type: text/plain');
$hours = preg_replace("/^([0-9]+).*$/", "$1", $_REQUEST['hour']);
$group = "";
$value = "value";
if($hours > 1){
	$group = "GROUP BY cpu, strftime('%H', stamp)";
	$value = "round(avg(value)) as value";
}
#$db = new SQLite3('./cpumonitor.db');
$db = new PDO('sqlite:./cpumonitor.db');

# load data and printout json
$cpus = array();
#$result = $db->query('SELECT cpu, value FROM cpuload');
#while($res = $result->fetchArray(SQLITE3_ASSOC)){ 
foreach($db->query('SELECT cpu, '. $value .' FROM cpuload WHERE stamp > datetime("now", "-'. $hours .' hour") '.$group.' ORDER BY stamp') as $res) {
	if(is_array($cpus[$res['cpu']]) == false){
		$cpus[$res['cpu']] = array();
	}
	array_push($cpus[$res['cpu']], $res['value']); 
}
$ret['y'] = $cpus;
echo json_encode($ret);

?>

