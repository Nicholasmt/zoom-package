<?php

namespace Nicholasmt\ZoomLibrary\Controllers;

use Illuminate\Http\Request;
use Nicholasmt\ZoomLibrary\Zoom;

class ZoomController 
{
    public function zoom_meeting()
    {


        // Setup the following in your .Env file.
        // ZOOMEMAIL = your zoom register email,
        // ZOOMAPISECRET = your zoom secret key,
        // ZOOMAPIKEY = your zoom key,

        $zoom_meeting = new Zoom();
        $data = array();

        // meeting detail array
        $data['topic'] 		= 'Meeting Title';
        $data['start_date'] = 'Meeting Start Time';
        $data['duration'] 	= 'Meeting duration in minutes';
        $data['type'] 		= 2;
        $data['password'] 	=  'Meeting password';

        // create meeting
        $response = $zoom_meeting->createMeeting($data);
        
        return $response;

       
    }
}
