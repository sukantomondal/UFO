<?php

/* Question:0 Route */
$app->get('/ufo/sightings/count', function ($request, $response, $args) {

	$params = $request->getQueryParams();

	$valid_params = array('city' => 'str','state' => 'str','country' => 'str','shape' => 'str');
	
	$utility = new Utility();
        $status = $utility->process_request_params($params, $valid_params);
        if($status !== true)
                return $this->response->withJson($status);

	$count_sightings_obj = new CountSightings($this->db);
        $result = $count_sightings_obj->getCount($params);
        return $this->response->withJson($result);
        
});

/* Question:1 Route */
$app->get('/ufo/types/count', function ($request, $response, $args) {

        $params = $request->getQueryParams();

	$valid_params = array('city' => 'str','state' => 'str','country' => 'str');

 	$utility = new Utility();
        $status = $utility->process_request_params($params, $valid_params);
        if($status !== true)
                return $this->response->withJson($status);

	$count_ufo_types_obj = new CountUfoTypes($this->db);
        $result = $count_ufo_types_obj->getCount($params);
        return $this->response->withJson($result);
});



/* Question:2 Route */
$app->get('/ufo/attack/evacuation/priorities', function ($request, $response, $args) {

        $params = $request->getQueryParams();

	$valid_params = array('country'=>'str', 'min_priority_rank'=>'int');
	$params_default_value = array('country'=>'us', 'min_priority_rank'=>10);

	$utility = new Utility();
	$status = $utility->process_request_params($params, $valid_params, $params_default_value);
	if($status !== true)
		return $this->response->withJson($status); 

	$evacaution_priorities_obj = new EvacuationPriorities($this->db);
        $result = $evacaution_priorities_obj->getEvacuationPrioritiesByCountry($params);
        return $this->response->withJson($result);

});



/* Question:3 Route */
$app->get('/ufo/sightings/distances', function ($request, $response, $args) {

        $params = $request->getQueryParams();

	$valid_params = array('base_latitude' => 'float', 'base_longitude' => 'float', 'limit' => 'int', 'offset' => 'int');
	$params_default_value = array('base_latitude' => 46.5476, 'base_longitude' => -87.3956);
	$dependency_params_list = array('offset'=>'limit');

	$utility = new Utility();
        $status = $utility->process_request_params($params, $valid_params, $params_default_value, $dependency_params_list);
        if($status !== true)
                return $this->response->withJson($status);

	$ufo_sightngs_distance_obj = new UfoSightingsDistance($this->db);
	$result = $ufo_sightngs_distance_obj->getDistances($params);
	return $this->response->withJson($result);
});

