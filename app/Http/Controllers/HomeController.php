<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function index()
    {
        $data['title'] =  'The Home Page';
        //$title = 'Project | About Us';
        return view('home.index', $data);
    }

    public function about()
    {
        $data['title'] =  'The  About Page';
       
        return view('home.about', $data);
    }

    

    public function send(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send the email
        $subject = "Contact Us Inquiry from " . config('app.name');
        $mailMessage = file_get_contents(resource_path('views/emails/contact_us_template.html'));
        
        // Populate dynamic content
        $mailMessage = str_replace("#name#", $request->input('name_contact_us'), $mailMessage);
        $mailMessage = str_replace("#contact#", $request->input('contact_contact_us'), $mailMessage);
        $mailMessage = str_replace("#email#", $request->input('email_contact_us'), $mailMessage);
        $mailMessage = str_replace("#city#", $request->input('city_contact_us'), $mailMessage);
        $mailMessage = str_replace("#description#", $request->input('message_contact_us'), $mailMessage);
        $mailMessage = str_replace("#page#", 'Product', $mailMessage);
        $mailMessage = str_replace("#page_url#", $request->server('HTTP_REFERER'), $mailMessage);
        
        // Project-specific placeholders
        $mailMessage = str_replace("#project_contact#", config('app.contact'), $mailMessage);
        $mailMessage = str_replace("#project_complete_name#", config('app.name'), $mailMessage);
        $mailMessage = str_replace("#project_website#", config('app.url'), $mailMessage);
        $mailMessage = str_replace("#project_email#", config('mail.from.address'), $mailMessage);

        // Social media links
        $social_media = '';
        if(config('app.facebook')) {
            $social_media .= '<a href="'.config('app.facebook').'" target="_blank"><img src="'.asset('images/email/facebook.png').'" width="25"></a>';
        }
        // Add other social media links as needed
        $mailMessage = str_replace("#social_media#", $social_media, $mailMessage);

        // Send email
        Mail::to(config('mail.from.address'))->send(new Mailer($mailMessage , $subject));


       // Mail::to('mukulsingh97087@gmail.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your enquiry has been sent successfully!');
    }


}
