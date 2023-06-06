# <img src="https://st2.zoom.us/static/6.3.12613/image/new/topNav/Zoom_logo.svg">

# Laravel Package library for Zoom API to create, update and delete meetings. 

This is a zoom api library package

# To get started Run

```console
composer require nicholasmt/zoom_library

```

Note: if You encounter this or any other error which means you are using the old version of those packages

```console

Your requirements could not be resolved to an installable set of packages.

```

To Resolve simply run
 
```console

 composer update
 
 ```

After successfull composer update then install the package again with 
``` composer require nicholasmt/zoom_webhook ```

Note: if you encounter any error based on poor network during update, 

just backup the vender file, delete and run composer update again with 
``` composer update ```

<h4> Configure in .env file </h4>
 
```env
ACCOUNT_ID    =  your zoom app Acount ID .
CLIENT_ID     =  your zoom app Client ID.
CLIENT_SECRET =  your zoom app Client Secret key.

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

