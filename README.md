# <img src="https://st2.zoom.us/static/6.3.12613/image/new/topNav/Zoom_logo.svg">

# Api Laravel Package  

This is a zoom api library package

# To get started

```
run composer require nicholasmt/zoom_library

```

Note: if You encounter this error which means you are using "nette/schema/v1.2.2" which requires php version of ">=7.1 <8.2".

```console

Your requirements could not be resolved to an installable set of packages.
- nette/schema v1.2.2 requires php >=7.1 <8.2 -> your php version (8.2.4) does not satisfy that requirement.

```

To Solve simply go the roof folder of your project and open "composer.lock" file

Search for "name": "nette/schema" and go under "require" and update the php version to " >=7.1 " and save as below

```json

 "require": {
                "nette/utils": "^2.5.7 || ^3.1.5 ||  ^4.0",
                "php": ">=7.1"
            },
            
```

Then run composer again.

```
composer require nicholasmt/zoom_library

```

<h4> Configure the following in .Env file </h4>
 
```env
ZOOM_EMAIL = your zoom register email.
ZOOM_API_SECRET = your zoom secret key.
ZOOM_API_KEY = your zoom key.

```
 <h4> Create a Controller </h4>
 
```
php artisan make:controller ZoomController
 
```

Require the package as below: 

```php
 use Nicholasmt\ZoomLibrary\Zoom;
 
```
To create zoom meeting use code in Method:

```php
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

```php
 
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Nicholasmt\ZoomLibrary\Zoom;
 
class ZoomController extends Controller
{
    
    public function zoom_meeting()
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

 }
 
```

Then finally setup Route for the controller.

```php
Route::get('create-meeting', [App\Http\Controllers\ZoomController::class, 'zoom_meeting'])->name('create-meeting');

```


Enjoy! and don't forget to like thanks

