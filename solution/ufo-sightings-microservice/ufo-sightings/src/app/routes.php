<?php

$app->get('/ufo/sightings/count', function ($request, $response, $args) {

	$params = $request->getQueryParams();

	$utility = new Utility();
	$params_result = $utility->validate_params($params);

	/* If the parameters are given then at least one parameter should be valid. If know parameter is porvided then just count all.*/
	if(empty($params) || (!empty($params) && !empty($params_result['valid_params'])))
	{
		$count_sightings_obj = new CountSightings($this->db);
		$result = $count_sightings_obj->getCount($params_result['valid_params']);
		$result = array_map('intval', $result);
		return $this->response->withJson($result);
	}	

	return $this->response->withJson(array('count'=>0));
});
