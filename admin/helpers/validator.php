<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/user.php';

function validator($data, $rules){
	$errors = [];

	foreach ($rules as $k => $v) {

		$v = explode('|', $v);

		if (in_array('required', $v) && !isset($data[$k]) ){
			$errors[] = $k.' field is required.';
		}

		if (in_array('required', $v) && empty($data[$k]) ){
			$errors[] = $k.' field has not a value.';
		}

		if ( !empty($data[$k]) ) {
			foreach ($v as $x => $y) {

				if ($y == 'string' && !is_string($data[$k]) ){
					$errors[] = $k.' field must be a string.';
				}
				
				if ($y == 'numeric' && !is_numeric($data[$k]) ){
					$errors[] = $k.' field must be a numeric.';
				}

				if ($y == 'array' && !is_array($data[$k]) ){
					$errors[] = $k.' field must be an array.';
				}

				if ($y == 'email' && !filter_var($data[$k], FILTER_VALIDATE_EMAIL) ){
					$errors[] = $k.' field must be a valid email.';
				}

				if ($y == 'confirmed' && !isset($data[ "{$k}_confirmarion" ]) ){
					$errors[] = $k.' field must be confirmed.';
				}

				if ($y == 'confirmed' && !empty($data[ "{$k}_confirmarion" ]) && $data[$k] != $data["{$k}_confirmarion"]){
					$errors[]=$k." field confirmation doesn't match.";
				}

				if (substr($y,0,3) == 'max'){

					$length = substr($y,4);

					if( strlen($data[$k]) > $length){
						$errors[] = $k.' field must not bigger than '.$length;
					}
				}

				if (substr($y,0,3) == 'min'){

					$length = substr($y,4);

					if( strlen($data[$k]) < $length){
						$errors[] = $k.' field must not less than '.$length;
					}
				}

				if (substr($y ,0 ,6) == 'unique'){
					$t = explode( ',', substr($y, 7) );
	
					if(empty($t[0]) || empty($t[1])){
						throw new Exception("Your Unique parameters is not valid");
					}
					$exist = User::user_query("SELECT * FROM {$t[0]} WHERE $t[1]='{$data[$k]}' LIMIT 1");

					//var_dump($exist);
					if ($exist) {
						$errors[] = $data[$k].' has already been taken.';
					}					
				}

				if (substr($y, 0, 6) == 'exists'){
					$t = explode( ',', substr($y, 7) );
	
					if(empty($t[0]) || empty($t[1])){
						throw new Exception("Your Exists parameters is not valid");
					}
					$exist = User::user_query("SELECT * FROM {$t[0]} WHERE $t[1]='{$data[$k]}' LIMIT 1");
				//	var_dump($exist);
				//	exit();

					if (!$exist) {
						$errors[] = $data[$k]." doesn't match our records.";
					}					
				}

				if (substr($y, 0, 2) == 'in') {
					$t = explode(',', substr($y, 3));

					if (!in_array($data[$k], $t)) {
						$errors[] = $k . " doesn't have a valid value";
					}
				}
			}
		}
	}
	return $errors;
}

