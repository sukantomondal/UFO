<?php
class CountSightings {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getCount($params = array()) {
	$sql = "SELECT count(*) AS count FROM ufo_sightings_bookeeper";
	if(!empty($params)){
		$sql .= " WHERE";
		foreach($params as $index=>$value){
			$sql .= " {$index}='{$value}' AND";
		}
		$sql .= " 1=1";
	}

	$stmt = $this->db->query($sql);
	$query_result = $stmt->fetchAll();
	$result = $query_result[0];
	return $result;

/*
	$sql = "SELECT";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new ProcessResult($row);
        }
        return $results;
*/
    }
}
