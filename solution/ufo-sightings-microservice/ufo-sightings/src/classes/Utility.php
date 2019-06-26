<?php
class Utility {

	protected $valid_params = array(
	'id'=>'int',
        'occurred_at' => 'datetime',
        'city' => 'str',
        'state' => 'str',
        'country' => 'str',
        'shape' => 'str',
        'duration_seconds' =>'int',
        'duration_text' => 'int',
        'description' => 'str',
        'reported_on' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float');


	public function __construct() {

    	}
	public function validate_params($params = array()){

		$invalid_params = array();
		$params_indices = array_keys($params);

        	foreach($params_indices as $index){
                	if(!array_key_exists($index, $this->valid_params)){
				$invalid_params[$index] = $params[$index];
                        	unset($params[$index]);
                	}
        	}

		return $result = array('valid_params'=> $params, 'invalid_params' => $invalid_params);
	}


	public function validate_params_value ($valid_params, $param, $value){
		
		$check_st = false;

		if(array_key_exists($param, $valid_params)){

			switch($valid_params[$param]){
				case 'int' :
				case 'float' :
					$check_st=is_numeric($value);		
					break;
				default :
					$check_st = false;
			}
			
			if($check_st){
				return $check_st;
			}
			else{
				return "{$param} should be {$valid_params[$param]}";
			}
	
		}

		return "{$param} is not a valid parameter";	
		
	}	

}
