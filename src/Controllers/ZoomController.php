<?php

namespace Nicholasmt\ZoomLibrary\Controllers;

use Illuminate\Http\Request;
use Nicholasmt\ZoomLibrary\Zoom;

class ZoomController 
{
    public function zoom_meeting()
    {

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
