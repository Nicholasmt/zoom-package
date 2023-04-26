# <span>   <img src="https://st2.zoom.us/static/6.3.12613/image/new/topNav/Zoom_logo.svg"> </span> Package  

This is a laravel zoom api library package

# To get started

```
run composer require nicholasmt/zoom_library

```

<h4> Configure the following in .Env file </h4>
 
```
ZOOM_EMAIL = your zoom register email.
ZOOM_API_SECRET = your zoom secret key.
ZOOM_API_KEY = your zoom key.

```
 <h4> Create a Controller </h4>
 
```
php artisan make:controller ZoomController --resource
 
```

Require the package as below: 

```
 use Nicholasmt\ZoomLibrary\Zoom;
 
```
To create zoom meeting use code in Method:

```
$zoom_meeting = new Zoom();
$data = array();
// meeting details array
$data['topic'] 		= 'Meeting Title';
$data['start_date'] = '25/04/2023';
$data['duration'] 	=  25; /*in minutes*/
$data['type'] 		= 2;
$data['password'] 	=  '12345';
// create meeting
$response = $zoom_meeting->createMeeting($data);
return $response;
 
```

Code Preview:

```
 
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Nicholasmt\ZoomLibrary\Zoom;
 
class ZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zoom_meeting = new Zoom();
        $data = array();
        // meeting details array
        $data['topic'] 		= 'Meeting Title';
        $data['start_date'] = '25/04/2023';
        $data['duration'] 	=  25; /*in minutes*/
        $data['type'] 		= 2;
        $data['password'] 	=  '12345';
        // create meeting
        $response = $zoom_meeting->createMeeting($data);

        // dd($response);

        return $response;
    }

 
 
```

Then finally setup Route for the controller.

```
Route::get('create-meeting', [App\Http\Controllers\ZoomController::class, 'index'])->name('create-meeting');

```

The Package is very simple to use.

Enjoy! and don't forget to like thanks

