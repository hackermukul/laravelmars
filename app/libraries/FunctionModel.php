<?php
namespace App\libraries; // defines the Helpers namespace under App namespace.

use Illuminate\Support\Facades\DB;
//use Session;
class FunctionModel {

    protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
                // Assign the CodeIgniter super-object
        

        }
        function getModule_details()
        {
              $segment1 = request()->segment(2); //returns 'users'
              $segment2 = request()->segment(3); //returns 'users'
			  $final =  $segment1.'/'.$segment2;
            //   $query1=DB::table("module_masters as auf")
            //         ->select('auf.*',);
            //         $query1->where('auf.class_name',$segment1);
		    //         $query1->get();
              $users = DB::table('module_masters') ->orderBy('name', 'desc')->where('class_name', $segment1 )->get();			  
			  return $users;
        }

 
}