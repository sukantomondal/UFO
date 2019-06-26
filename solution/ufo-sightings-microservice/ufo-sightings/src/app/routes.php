<?php

/* Question:0 Route */
$app->get('/ufo/sightings/count', function ($request, $response, $args) {

	$params = $request->getQueryParams();

	$utility = new Utility();
	$params_result = $utility->validate_params($params);

	/* If the parameters are given then at least one parameter should be valid. If no parameter is porvided then just count all.*/
	if(empty($params) || (!empty($params) && !empty($params_result['valid_params'])))
	{
		$count_sightings_obj = new CountSightings($this->db);
		$result = $count_sightings_obj->getCount($params_result['valid_params']);
		$result = array_map('intval', $result);
		return $this->response->withJson($result);
	}	

	return $this->response->withJson(array('count'=>0));
});

/* Question:1 Route */
$app->get('/ufo/types/count', function ($request, $response, $args) {

        $params = $request->getQueryParams();

        $utility = new Utility();
        $params_result = $utility->validate_params($params);

        /* If the parameters are given then at least one parameter should be valid. If no parameter is porvided then just count all.*/
        if(empty($params) || (!empty($params) && !empty($params_result['valid_params'])))
        {
                $count_ufo_types_obj = new CountUfoTypes($this->db);
                $result = $count_ufo_types_obj->getCount($params_result['valid_params']);
                $result = array_map('intval', $result);
                return $this->response->withJson($result);
        }

        return $this->response->withJson(array('count'=>0));

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
	$params_default_value = array('base_latitude' => 46.5476, 'base_longitude' => -87.3956, 'limit' => 1000, 'offset' => 0);

	$utility = new Utility();
        $status = $utility->process_request_params($params, $valid_params, $params_default_value);
        if($status !== true)
                return $this->response->withJson($status);


/*
	foreach($params as $index=>$value){
		$status = $utility->validate_params_value($valid_params,$index, $value);
		if($status !== true)
			return $this->response->withJson(array('Msg'=>$status));
	}

	foreach($params_default_value as $index=> $value){
		if(!isset($params[$index]))
			$params[$index] = $value;			
	}
*/

	$ufo_sightngs_distance_obj = new UfoSightingsDistance($this->db);
	$result = $ufo_sightngs_distance_obj->getDistances($params);

	return $this->response->withJson($result);
});

