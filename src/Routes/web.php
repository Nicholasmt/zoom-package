<?php

use Nicholasmt\ZoomLibrary\Controllers;
use Nicholasmt\ZoomLibrary\Zoom;
use Illuminate\Support\Facades\Route;

Route::get('zoom', function(){

    
    $zoom_meeting = new Zoom();
    $data = array();
    // meeting detail array
    $data['topic'] 		= 'Meeting Title';
    $data['start_date'] = '25/04/2023';
    $data['duration'] 	=  2;
    $data['type'] 		= 2;
    $data['password'] 	=  '12345';

    // create meeting
    $response = $zoom_meeting->createMeeting($data);
    
    return $response;
   
    \Artisan::call('vendor:publish --tag=jwt-master');
    \Artisan::call('vendor:publish --tag=zoom-controller');

});