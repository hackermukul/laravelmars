<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleManagerController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GrievanceController;
use App\Http\Controllers\GrievanceAdminController;
use App\Http\Controllers\GrievanceCommitteeController;
use App\Http\Controllers\GrievanceReportController;
use App\Http\Controllers\BannerController;



use App\Http\Controllers\ForgotPasswordController;


use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     //abort(401);
//     return view('home');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('/logout', [DashboardController::class,'logout'])->name('logout');

    // Route::get('/dashboard', function () { 
    //     return view('dashboard'); 
    // })->name('dashboard');
});

Route::fallback(function(){
    return view('errors.404');
});

// Route::any('*',function(){
//     return view('errors.404');
// });

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::post('/sendEnquiry', [HomeController::class,'sendEnquiry'])->name('sendEnquiry');
Route::get('/grievance-committee', [HomeController::class, 'committee'])->name('committee');


Route::get('/registration', [HomeController::class,'registration'])->name('registration');
// Show the registration form
Route::get('/registration/student', [StudentRegistrationController::class, 'showForm'])->name('registration.student');

// Handle form submission
Route::post('/registration/student', [StudentRegistrationController::class, 'submitForm'])->name('registration.student.submit');


Route::post('/registration/staff', [StudentRegistrationController::class, 'staffsubmitForm'])->name('registration.staff.submit');

Route::post('/registration/parent', [StudentRegistrationController::class, 'parentsubmitForm'])->name('registration.parent.submit');

Route::post('/registration/alumni', [StudentRegistrationController::class, 'alumnisubmitForm'])->name('registration.alumni.submit');


// Student Registration Route
Route::get('/registration/student', [RegistrationController::class, 'studentRegistration'])->name('registration.student');

// Staff Registration Route
Route::get('/registration/staff', [RegistrationController::class, 'staffRegistration'])->name('registration.staff');

// Parent Registration Route
Route::get('/registration/parent', [RegistrationController::class, 'parentRegistration'])->name('registration.parent');

Route::get('/registration/alumni', [RegistrationController::class, 'alumniRegistration'])->name('registration.alumni');



// Profile Routes
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('editProfile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('updateProfile');
Route::get('/profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('changePassword');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');


Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'processForgotPassword'])->name('password.reset.direct');
Route::get('show-userId', [ForgotPasswordController::class, 'showUserIdForm'])->name('userId.request');

Route::post('/show-user-id', [ForgotPasswordController::class, 'getUserId'])->name('showuserId.reset.direct');



Route::get('/grievances/create', [GrievanceController::class, 'create'])->name('addGrievance');
Route::post('/grievances', [GrievanceController::class, 'store'])->name('submitGrievance');
Route::get('/grievances', [GrievanceController::class, 'index'])->name('viewGrievance');
Route::get('/displayReply/{id}', [GrievanceController::class, 'show'])->name('displayReply');
Route::get('/grievances/{id}', [GrievanceController::class, 'show'])->name('grievances.show');

Route::post('grievances/{id}/reply', [GrievanceController::class, 'storeReply'])->name('grievances.reply.store');






Route::post('/customer-login', [AuthController::class, 'customer_login'])->name('customer_login');

Route::middleware('guest')->get('/loginForm', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=> ['auth'], 'prefix'=>'dashboard'],function () {
   
    //DashboardController

    Route::group(['prefix'=>'','as'=> 'dashboard'], function() {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('index');
        Route::get('/access-denied', [DashboardController::class,'access_denied'])->name('access_denied');
    });

    //categories

    Route::group(['prefix'=>'categories','as'=> 'categories.'], function() {
        Route::get('/', [CategoryController::class,'index'])->name('index');
        Route::get('create', [CategoryController::class,'create'])->name('create');
        Route::post('store', [CategoryController::class,'store'])->name('store');
        Route::get('show/{id}', [CategoryController::class,'show'])->name('show');
        Route::get('{category:slug}/edit', [CategoryController::class,'edit'])->name('edit');
        Route::put('{category:slug}', [CategoryController::class,'update'])->name('update');
        Route::get('{category:slug}/delate', [CategoryController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [CategoryController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [CategoryController::class,'index'])->name('search');
        Route::post('export-excel', [CategoryController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [CategoryController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCategoryList', [CategoryController::class,'GetCompleteCategoryList'])->name('GetCompleteCategoryList');
        Route::post('GetCompleteCategoryListNewPos', [CategoryController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        
    });

    //Department-Module/

    Route::group(['prefix'=>'department','as'=> 'department.'], function() {
        Route::get('/', [DepartmentController::class,'index'])->name('index');
        Route::get('create', [DepartmentController::class,'create'])->name('create');
        Route::post('store', [DepartmentController::class,'store'])->name('store');
        Route::get('show/{id}', [DepartmentController::class,'show'])->name('show');
        Route::get('{department:slug}/edit', [DepartmentController::class,'edit'])->name('edit');
        Route::put('{department:slug}', [DepartmentController::class,'update'])->name('update');
        Route::get('{department:slug}/delate', [DepartmentController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [DepartmentController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [DepartmentController::class,'index'])->name('search');
        Route::post('export-excel', [DepartmentController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [DepartmentController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCategoryList', [DepartmentController::class,'GetCompleteCategoryList'])->name('GetCompleteCategoryList');
        Route::post('GetCompleteCategoryListNewPos', [DepartmentController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
    });


    //DesignationController-Module/

    Route::group(['prefix'=>'designation','as'=> 'designation.'], function() {
        Route::get('/', [DesignationController::class,'index'])->name('index');
        Route::get('create', [DesignationController::class,'create'])->name('create');
        Route::post('store', [DesignationController::class,'store'])->name('store');
        Route::get('show/{id}', [DesignationController::class,'show'])->name('show');
        Route::get('{designation:slug}/edit', [DesignationController::class,'edit'])->name('edit');
        Route::put('{designation:slug}', [DesignationController::class,'update'])->name('update');
        Route::get('{designation:slug}/delate', [DesignationController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [DesignationController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [DesignationController::class,'index'])->name('search');
        Route::post('export-excel', [DesignationController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [DesignationController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCategoryList', [DesignationController::class,'GetCompleteCategoryList'])->name('GetCompleteCategoryList');
        Route::post('GetCompleteCategoryListNewPos', [DesignationController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
    });
    

    //DesignationController-Module/

    Route::group(['prefix'=>'role-manager','as'=> 'role-manager.'], function() {
        Route::get('/', [RoleManagerController::class,'index'])->name('index');
        Route::get('create', [RoleManagerController::class,'create'])->name('create');
        Route::post('store', [RoleManagerController::class,'store'])->name('store');
        Route::get('show/{id}', [RoleManagerController::class,'show'])->name('show');
        Route::get('{roleManager:slug}/edit', [RoleManagerController::class,'edit'])->name('edit');
        Route::put('{roleManager:slug}', [RoleManagerController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [RoleManagerController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [RoleManagerController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [RoleManagerController::class,'index'])->name('search');
        Route::post('export-excel', [RoleManagerController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [RoleManagerController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCategoryList', [RoleManagerController::class,'GetCompleteCategoryList'])->name('GetCompleteCategoryList');
        Route::post('GetCompleteCategoryListNewPos', [RoleManagerController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
    });

    Route::group(['prefix'=>'country','as'=> 'country.'], function() {
        Route::get('/', [CountryController::class,'index'])->name('index');
        Route::get('create', [CountryController::class,'create'])->name('create');
        Route::post('store', [CountryController::class,'store'])->name('store');
        Route::get('show/{id}', [CountryController::class,'show'])->name('show');
        Route::get('{country:slug}/edit', [CountryController::class,'edit'])->name('edit');
        Route::put('{country:slug}', [CountryController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [CountryController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [CountryController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [CountryController::class,'index'])->name('search');
        Route::post('export-excel', [CountryController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [CountryController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [CountryController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [CountryController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');

    });

    Route::group(['prefix'=>'state','as'=> 'state.'], function() {
        Route::get('/', [StateController::class,'index'])->name('index');
        Route::get('create', [StateController::class,'create'])->name('create');
        Route::post('store', [StateController::class,'store'])->name('store');
        Route::get('show/{id}', [StateController::class,'show'])->name('show');
        Route::get('{state:slug}/edit', [StateController::class,'edit'])->name('edit');
        Route::put('{state:slug}', [StateController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [StateController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [StateController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [StateController::class,'index'])->name('search');
        Route::post('export-excel', [StateController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [StateController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [StateController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [StateController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');

    });


    Route::group(['prefix'=>'city','as'=> 'city.'], function() {
        Route::get('/', [CityController::class,'index'])->name('index');
        Route::get('create', [CityController::class,'create'])->name('create');
        Route::post('store', [CityController::class,'store'])->name('store');
        Route::get('show/{id}', [CityController::class,'show'])->name('show');
        Route::get('{city:slug}/edit', [CityController::class,'edit'])->name('edit');
        Route::put('{city:slug}', [CityController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [CityController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [CityController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [CityController::class,'index'])->name('search');
        Route::post('export-excel', [CityController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [CityController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [CityController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [CityController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        Route::post('getState', [CityController::class,'getState'])->name('getState');

    });

    Route::group(['prefix'=>'company','as'=> 'company.'], function() {
        Route::get('/', [CompanyProfileController::class,'index'])->name('index');
        Route::post('store', [CompanyProfileController::class,'store'])->name('store');
        Route::get('show/{id}', [CompanyProfileController::class,'show'])->name('show');
        Route::get('{companyProfile:slug}/edit', [CompanyProfileController::class,'edit'])->name('edit');
        Route::put('{companyProfile:slug}', [CompanyProfileController::class,'update'])->name('update');
        Route::post('updateStatus', [CompanyProfileController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [CompanyProfileController::class,'index'])->name('search');
        Route::post('getCity', [CompanyProfileController::class,'getCity'])->name('getCity');
    });

    Route::group(['prefix'=>'employee','as'=> 'employee.'], function() {
        Route::get('/', [UserController::class,'index'])->name('index');
        Route::get('create', [UserController::class,'create'])->name('create');
        Route::post('store', [UserController::class,'store'])->name('store');
        Route::get('show/{id}', [UserController::class,'show'])->name('show');
        Route::get('{userModel:slug}/edit', [UserController::class,'edit'])->name('edit');
        Route::put('{userModel:slug}', [UserController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [UserController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [UserController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [UserController::class,'index'])->name('search');
        Route::post('export-excel', [UserController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [UserController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [UserController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [UserController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        Route::post('addNewFileLine', [UserController::class,'addNewFileLine'])->name('addNewFileLine');

    });


    Route::group(['prefix' => 'grievance', 'as' => 'grievance.'], function() {
        Route::get('/', [GrievanceAdminController::class, 'index'])->name('index');
        Route::get('create', [GrievanceAdminController::class, 'create'])->name('create');
        Route::post('store', [GrievanceAdminController::class, 'store'])->name('store');
        Route::get('show/{id}', [GrievanceAdminController::class, 'show'])->name('show');
        Route::get('{grievance:slug}/edit', [GrievanceAdminController::class, 'edit'])->name('edit');
        Route::put('{grievance:slug}', [GrievanceAdminController::class, 'update'])->name('update');
        Route::get('{grievance:slug}/delete', [GrievanceAdminController::class, 'destroy'])->name('destroy');
        Route::post('updateStatus', [GrievanceAdminController::class, 'updateStatus'])->name('updateStatus');
        Route::post('search', [GrievanceAdminController::class, 'index'])->name('search');
        Route::post('export-excel', [GrievanceAdminController::class, 'export_excel'])->name('export-excel');
        Route::post('/add-update', [GrievanceAdminController::class, 'addUpdate'])->name('grievance_update');
        Route::post('updateReply', [GrievanceAdminController::class, 'updateReply'])->name('updateReply');
    });

    Route::group(['prefix'=>'grievance_committees','as'=> 'grievance_committees.'], function() {
        Route::get('/', [GrievanceCommitteeController::class,'index'])->name('index');
        Route::get('create', [GrievanceCommitteeController::class,'create'])->name('create');
        Route::post('store', [GrievanceCommitteeController::class,'store'])->name('store');
        Route::get('show/{id}', [GrievanceCommitteeController::class,'show'])->name('show');
        Route::get('{grievance_committees:slug}/edit', [GrievanceCommitteeController::class,'edit'])->name('edit');
        Route::put('{grievance_committees:slug}', [GrievanceCommitteeController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [GrievanceCommitteeController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [GrievanceCommitteeController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [GrievanceCommitteeController::class,'index'])->name('search');
        Route::post('export-excel', [GrievanceCommitteeController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [GrievanceCommitteeController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [GrievanceCommitteeController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [GrievanceCommitteeController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        Route::post('getState', [GrievanceCommitteeController::class,'getState'])->name('getState');

    });
    
    Route::group(['prefix'=>'grievance_report','as'=> 'grievance_report.'], function() {
        Route::get('/', [GrievanceReportController::class,'index'])->name('index');
        Route::get('create', [GrievanceCommitteeController::class,'create'])->name('create');
        Route::post('store', [GrievanceCommitteeController::class,'store'])->name('store');
        Route::get('show/{id}', [GrievanceCommitteeController::class,'show'])->name('show');
        Route::get('{grievance_committees:slug}/edit', [GrievanceCommitteeController::class,'edit'])->name('edit');
        Route::put('{grievance_committees:slug}', [GrievanceCommitteeController::class,'update'])->name('update');
        Route::get('{role-manager:slug}/delate', [GrievanceCommitteeController::class,'destroy'])->name('destroy');
        Route::post('updateStatus', [GrievanceCommitteeController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [GrievanceReportController::class,'index'])->name('search');
        Route::post('chat', [GrievanceReportController::class,'chat'])->name('chat');

        Route::post('export-excel', [GrievanceCommitteeController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [GrievanceCommitteeController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [GrievanceCommitteeController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [GrievanceCommitteeController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        Route::post('getState', [GrievanceCommitteeController::class,'getState'])->name('getState');

    });


    Route::group(['prefix'=>'banner_module','as'=> 'banner_module.'], function() {
        Route::get('/', [BannerController::class,'index'])->name('index');
        Route::get('create', [BannerController::class,'create'])->name('create');
        Route::post('store', [BannerController::class,'store'])->name('store');
        Route::get('show/{id}', [BannerController::class,'show'])->name('show');
        Route::get('{banner_module:slug}/edit', [BannerController::class,'edit'])->name('edit');
        Route::put('{banner_module:slug}', [BannerController::class,'update'])->name('update');
        Route::post('updateStatus', [BannerController::class,'updateStatus'])->name('updateStatus');
        Route::post('search', [BannerController::class,'index'])->name('search');
        Route::post('chat', [BannerController::class,'chat'])->name('chat');

        Route::post('export-excel', [BannerController::class,'export_excel'])->name('export-excel');
        Route::get('setPositions', [BannerController::class,'setPositions'])->name('setPositions');
        Route::post('GetCompleteCountryList', [BannerController::class,'GetCompleteCountryList'])->name('GetCompleteCountryList');
        Route::post('GetCompleteCategoryListNewPos', [BannerController::class,'GetCompleteCategoryListNewPos'])->name('GetCompleteCategoryListNewPos');
        Route::post('getState', [BannerController::class,'getState'])->name('getState');

    });
    



});



