<?php
class EvacuationPriorities {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getEvacuationPrioritiesByCountry($country = 'us',$min_priority_rank = 10) {
	$sql = "SELECT city,COUNT(*) AS count FROM ufo_sightings_bookeeper WHERE country <> '' AND country = '{$country}' GROUP BY city ORDER BY count DESC LIMIT {$min_priority_rank}";
	$stmt = $this->db->query($sql);
        $results = array();
	$result['sightings'] = $stmt->fetchAll();
	return $result;
    }
}
