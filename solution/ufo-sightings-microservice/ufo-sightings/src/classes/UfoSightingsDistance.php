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
	$offset = $params['offset'];
	$limit = $params['limit'];


	try
	{

		$sql = "SELECT * FROM ufo_sightings_bookeeper WHERE city IS NOT NULL AND city <> '' AND 
			state IS NOT NULL AND state <> '' AND country IS NOT NULL AND country <> '' AND 
			shape IS NOT NULL AND shape <> '' AND duration_seconds <> 0 AND duration_text <> '' AND 
			description IS NOT NULL AND description <> '' AND reported_on IS NOT NULL AND latitude IS NOT NULL 
			AND longitude IS NOT NULL LIMIT {$offset},{$limit}";
		$stmt = $this->db->query($sql);
        	$results = array();
		$result_temp_rows = array();

 		$priority_queue = new SplPriorityQueue();

		while($row = $stmt->fetch()){
			foreach($row as $index => $value){
				if(empty($index))
					continue;
				else{
					switch($index){
						case 'id' :
							$row['id'] = (int) $row['id'];
							break;
						case 'duration_seconds' :
							$row['duration_seconds'] = (int) $row['duration_seconds'];
							break;
						case 'latitude' :
							$row['latitude'] = (float) $row['latitude'];
							break;
						case 'longitude' :
                                                	$row['longitude'] = (float) $row['longitude'];
                                                	break;
					}
				}

			}

			$row['distance'] = $this->calculateDistance($base_latitude, $base_longitude, $row['latitude'], $row['longitude']);
			$result_temp_rows[] = $row;
			$priority_queue->insert($row, $row['distance']);
		}
	
		//usort($result_temp_rows, array('UfoSightingsDistance','user_compare'));
		$priority_queue->setExtractFlags(SplPriorityQueue::EXTR_DATA);

		$result_temp = array();
		while ($priority_queue->valid()) {
			array_unshift($result_temp,$priority_queue->current());
    			$priority_queue->next();
		}

		$results['sightings'] = $result_temp;
		return $results;
	}

	catch(Exception $e) {
		return array("Msg"=>$e->getMessage());

	}

    }
}
