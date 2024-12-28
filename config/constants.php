<?php

$web_root = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$web_root = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$baseURL	= $web_root;
date_default_timezone_set('Asia/Calcutta'); 


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
        
        '_project_name_' => 'Grievance Management Software',
        '_project_complete_name_' => 'Grievance Management Software',
        '_meta_keywords_' => 'Grievance Management',
        '_brand_name_' => 'Grievance Management',
        'SITE_KEY' => '',
        '_brand_name_email_' => '',
        '__projectcontact__' => '+91-62026 27875',
        '__projectcontact2__' => '+91-62026 27875',
        '__projectemail__' => 'info@college.com',
        '__adminemail__' => 'info@collage.com',
        '__project_address__' => 'No.34, Shop No.2 ',
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
