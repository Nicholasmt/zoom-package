<?php

namespace Nicholasmt\ZoomLibrary\Controllers;

use Illuminate\Http\Request;
use Nicholasmt\ZoomLibrary\Zoom;

class ZoomController 
{
    public function zoom_meeting()
    {

        // .Env File Setup.
        // ZOOM_EMAIL = your zoom register email.
        // ZOOM_API_SECRET = your zoom secret key.
        // ZOOM_API_KEY = your zoom key.

        $zoom_meeting = new Zoom();
        $data = array();
        // meeting details array
        $data['topic'] 		= 'Meeting Title';
        $data['start_date'] = '25/04/2023';
        $data['duration'] 	=  25; /* in minutes*/
        $data['type'] 		= 2;
        $data['password'] 	=  '12345';
        // create meeting
        $response = $zoom_meeting->createMeeting($data);
        
        return $response;

       
    }
}
