<?php
class Utility {

	public function __construct() {

    	}

	public function validate_params_value ($valid_params, $param, $value){
		
		$check_st = false;

		if(array_key_exists($param, $valid_params)){

			switch($valid_params[$param]){
				case 'int' :
					if(is_int($value)){
                                                $check_st = true;
                                        }else if(is_string($value)){
                                                $check_st=ctype_digit($value);
                                        }                            
                                        break;
				case 'float' :
					if(is_float($value)){
						$check_st = true;
					}else if(is_string($value)){
						$check_st=is_numeric($value);
					}		
					break;
				case 'str' :
					$check_st = (!empty($value) && is_string($value));
					break;
				default :
					$check_st = false;
			}
			
			if($check_st)
				return $check_st;
			return "'{$param}' should be a {$valid_params[$param]}";
	
		}

		return "'{$param}' is not a valid parameter";	
		
	}

        
	public function process_request_params(&$params=array(), $valid_params=array(), $params_default_value=array(), 
					        $dependency_params_list = array()){
		
        	foreach($params as $index=>$value){
                	$status = $this->validate_params_value($valid_params,$index, $value);
                	if($status !== true)
                        	return array('Msg'=>$status);
        	}

		foreach ($dependency_params_list as $index=>$value){
			$dependent_params = explode(",", $value);
			if(isset($params[$index])){
				foreach ($dependent_params as $dependent_param){
					if(!isset($params[$dependent_param]))
						return array("Msg" => "If '{$index}' is set, you must set '{$value}'");
				}
			}
		}

        	foreach($params_default_value as $index=> $value){
                	if(!isset($params[$index]))
                        	$params[$index] = $value;
        	}
		return true;

	}	

}
