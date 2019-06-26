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

/*

EvacuationPriorities

/* Question:2 Route */
$app->get('/ufo/attack/evacuation/priorities', function ($request, $response, $args) {

        $params = $request->getQueryParams();

	$country = 'us';         //default country
	$min_priority_rank = 10; //default number

	$valid_params = array("country", "min_priority_rank");

	foreach($params as $index=>$value){
		if(!in_array($index,$valid_params)){
			return $this->response->withJson(array('Msg'=>"Invalid Query string: Query String should have only 'country' and 'min_priority_rank'"));
		}	
	}

	if(array_key_exists($valid_params[0], $params))
		$country = $params[$valid_params[0]];

	if(array_key_exists($valid_params[1], $params))
                $min_priority_rank = $params[$valid_params[1]];

	$evacaution_priorities_obj = new EvacuationPriorities($this->db);
        $result = $evacaution_priorities_obj->getEvacuationPrioritiesByCountry($country,$min_priority_rank);
	return $this->response->withJson($result);
});
