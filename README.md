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
 <h4> Public package Using </h4>
 
```

 php artisan vendor:publish --tag=library-controller
 
```
For publish the package controller

In the Controller, method has already been created just pass in array data with the neccessary detail to create zoom meeting. 

```
 php artisan vendor:publish --tag=jwt-master
 
```
For the JWT package

Route setup for the controller.

```

 Route::get('create-meeting', [Nicholasmt\ZoomLibrary\Controllers\ZoomController::class, 'zoom_meeting'])->name('create-meeting');

```

The Package is very simple to use.

Enjoy! and don't forget to like thanks

