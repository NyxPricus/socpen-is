<?php>

class JsonEncode{

	function safe_json_encode($output){
		$uctList = json_encode($output);
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				return $uctList;
			case JSON_ERROR_DEPTH:
				return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_STATE_MISMATCH:
				return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_CTRL_CHAR:
				return 'Unexpected control character found';
			case JSON_ERROR_SYNTAX:
				return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
			case JSON_ERROR_UTF8:
				$clean = utf8ize($output);
				return safe_json_encode($clean, 0, 512);
			default:
				return 'Unknown error'; // or trigger_error() or throw new Exception()

		}
	}

	function utf8ize($mixed) {
		if (is_array($mixed)) {
			foreach ($mixed as $key => $output) {
				$mixed[$key] = utf8ize($output);
			}
		} else if (is_string ($mixed)) {
			return utf8_encode($mixed);
		}
		return $mixed;
	}
}
?>