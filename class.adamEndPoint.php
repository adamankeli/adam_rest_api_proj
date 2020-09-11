<?php

class adamEndPoint {
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}
	
	public static function init_hooks() {
		self::$initiated = true;
		
		add_action('init', 'add_endpoint');
		
	}
	// Make API call to endpoint
	public static function endpoint() {

		global $wp;

    	$endpoint_vars = $wp->query_vars;

    	// if  custom endpoint 
    	if ($wp->request == 'endpoint/table') {

        //process endpoint
        	self::processEndPoint();
        	exit;
    	} elseif (isset($endpoint_vars['tracking']) && !empty($endpoint_vars['tracking'])) {
        	$request = [
            'tracking_id' => $endpoint_vars['tracking']
        	];

        	self::processEndPoint($request);
    	} elseif (isset($_GET['utm_source']) && !empty($_GET['utm_source'])){
        	self::processGoogleTracking($_GET);
    	}


	}

 //Permalink for tracking purposes
 private static function add_endpoint(){
	add_rewrite_endpoint('tracking', EP_PERMALINK | EP_PAGES, true);
}	

//Send API request and parse response to table 
 public static function processEndPoint(){

	 $response = self::get_api_info();
	 processRequest::process($response);
 }

private static function get_api_info() {
	global $apiInfo; // Save database calls
		if( empty($apiInfo) ) $apiInfo = get_transient('api_info'); // Check DB
		if( !empty($apiInfo) ) return $apiInfo;

		$response = wp_remote_get('https://jsonplaceholder.typicode.com/users');
		$data = wp_remote_retrieve_body($response);

		if( empty($data) ) return false;

		$apiInfo = json_decode($data); // Load data into runtime cache
		set_transient( 'api_info', $apiInfo, 6 * HOURS ); // Store in DB for 6 hours

		return $apiInfo;
}

}	