<?php
$baseURL = 'http://127.0.0.1:8000/';

return [

    /*
    |--------------------------------------------------------------------------
    | Constant Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */
     
    'options' => [
        
        '_project_name_' => 'College Management',
        '_project_complete_name_' => 'College Management Shoftware',
        '_meta_keywords_' => 'College Management',
        '_brand_name_' => 'College Management',
        'SITE_KEY' => '',
        '_brand_name_email_' => '',
        '__projectcontact__' => '+91-62026 27875',
        '__projectcontact2__' => '+91-62026 27875',
        '__projectemail__' => 'info@mukulraja.com',
        '__adminemail__' => 'info@mukulraja.com',
        '__project_address__' => 'No.34, Shop No.2, Ground Floor, Fatma Manor, 5th Cross Road, Maruthi Extension, New Gurrapanapalya, BTM 1st Stage Bangaluru, Karnataka 560029 ',
        'MAINSITE' => $baseURL,
        'MAINSITE_Admin' =>$baseURL."build/assets/admin/",
        'Website_Files' => $baseURL."build/assets/front/",
        '__IMAGE__' => $baseURL."build/assets/front/img/",
        '_uploaded_files_'=>'',
        '__facebook__' => '',
        '__twitter__' => '',
        '__linkedin__' => '',
        '__insatagram__' => '',
        '__youtube__' => '',
        'base_url' => $baseURL,
        'url1' => $baseURL . '/login',
        'url2' => $baseURL . '/about',
    ]

];
