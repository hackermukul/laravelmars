<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\company\CompanyProfile;


class BaseLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
        /**
     * Get the view / contents that represent the component.
     */
    
    public function render(): View|Closure|string
    {
        // Fetch the company profile data
        $companyProfile = CompanyProfile::first();
       
        // Pass the data to the view
        return view('layouts.base', compact('companyProfile'));
    }
    
}
