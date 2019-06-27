<?php
class UfoSightingsDistance {
    
    protected $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2){
	
	$theta = $lon1 - $lon2;
  	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  	$dist = acos($dist);
  	$dist = rad2deg($dist);
  	$miles = $dist * 60 * 1.1515;
	$kms = $miles * 1.609344;
	$kms = round($kms, 2);
    	return $kms; 

    }

    private static function user_compare($x,$y) {

	if ($x['distance'] == $y['distance'])
		return 0;
	else if ($x['distance'] > $y['distance'])
		return 1;
	else
		return -1;
    }

    public function getDistances($params = array()) {

	$base_latitude = $params['base_latitude'];
	$base_longitude = $params['base_longitude'];

	try
	{
		$sql = "SELECT * FROM ufo_sightings_bookeeper WHERE occurred_at IS NOT NULL AND city IS NOT NULL AND city <> '' AND
			state IS NOT NULL AND state <> '' AND country IS NOT NULL AND country <> '' AND 
			shape IS NOT NULL AND shape <> '' AND duration_seconds <> 0 AND duration_text <> '' AND 
			description IS NOT NULL AND description <> '' AND reported_on IS NOT NULL AND latitude IS NOT NULL 
			AND longitude IS NOT NULL";
		
		if(isset($params['offset']) && isset($params['limit']))
			$sql .= " LIMIT {$params['offset']},{$params['limit']}";
		elseif (isset($params['limit']))
			$sql .= " LIMIT {$params['limit']}";

		$stmt = $this->db->query($sql);
        	$results = array();
		$result_temp_rows = array();

		while($row = $stmt->fetch()){

			$empty_element_exists = false;

			foreach($row as $index => $value){
				if(empty($value)){
					$empty_element_exists = true;
					break;
				}
			}
			
			if(!$empty_element_exists){
				$row['distance'] = $this->calculateDistance($base_latitude, $base_longitude, $row['latitude'], $row['longitude']);
				$result_temp_rows[] = $row;
			}
		}

		usort($result_temp_rows, array('UfoSightingsDistance','user_compare')); //sorting rows based on distance

		$results['sightings'] = $result_temp_rows;
		return $results;
	}
	catch(Exception $e) {
		return array("Msg"=>$e->getMessage());
	}

    }
}
