<?php
class CountUfoTypes {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getCount($params = array()) {
	try{

		$sql = "SELECT COUNT(DISTINCT shape) AS count FROM ufo_sightings_bookeeper WHERE shape <> '' AND shape <>'unknown'";
		if(!empty($params)){
			foreach($params as $index=>$value){
				if(!empty($value))
					$sql .= " AND {$index}='{$value}' ";
			}
		}
		$stmt = $this->db->query($sql);
		$query_result = $stmt->fetchAll();
		$result = $query_result[0];
		return $result;
	}
	catch (Exception $e){
		return array("Msg" => $e->getMessage());
	}
    }
}
