<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


//Profile
Route::get('profile', 'ProfileController@indexProfile')->name('profile');

Route::patch('updateProfile/{id}', 'ProfileController@updateProfile')->name('updateProfile');

Route::get('change_password', 'ProfileController@index')->name('change_password');
Route::post('/changePassword', 'ProfileController@store')->name('changePassword');


//leads

Route::get('/leads','LeadController@index')->name('leads');
Route::get('/leads_add', 'LeadController@leadadd')->name('leads_add');
Route::post('/add_lead', 'LeadController@create')->name('add_lead');


Route::post('leadsTableData', 'LeadController@leadsTableData')->name('leadsTableData');
Route::post('leadDetail', 'LeadController@leadDetail')->name('leadDetail');
Route::delete('leadDelete/{id}', 'LeadController@leadDelete')->name('leadDelete');

Route::post('addcomment', 'LeadController@addcomment')->name('addcomment');

Route::get('/export', 'LeadController@export')->name('export');
Route::get('/import_leads','LeadController@importview')->name('import_leads');

Route::post('/uploads_leads','LeadController@import')->name('uploads_leads');
Route::get('/leadsstatus/{id}', 'LeadController@leadsstatus')->name('leadsstatus');

//employee 

Route::get('/telecaller','EmployeeController@tIndex')->name('telecaller');
Route::get('/employee_add', 'EmployeeController@telecalleradd')->name('employee_add');

Route::post('/add_employee', 'EmployeeController@addEmployee')->name('add_employee');
Route::post('telecallerTableData', 'EmployeeController@telecallerTableData')->name('telecallerTableData');
Route::delete('telecallerDelete/{id}', 'EmployeeController@telecallerDelete')->name('telecallerDelete');

Route::get('/employee_edit/{id}', 'EmployeeController@employeeEdit')->name('employee_edit');

Route::post('/update_employee', 'EmployeeController@updateEmployee')->name('update_employee');

Route::post('/telecallerDetail', 'EmployeeController@telecallerDetail')->name('telecallerDetail');


Route::get('/salesperson','EmployeeController@sIndex')->name('salesperson');

Route::post('salespersonTableData', 'EmployeeController@salespersonTableData')->name('salespersonTableData');

Route::delete('salespersonDelete/{id}', 'EmployeeController@salespersonDelete')->name('salespersonDelete');

Route::post('/salespersonDetail', 'EmployeeController@salespersonDetail')->name('salespersonDetail');

Route::get('/employeestatus/{id}', 'EmployeeController@employeestatus')->name('employeestatus');

//myleads

Route::get('/myleads','MyLeadsController@index')->name('myleads');

Route::post('myleadsTableData', 'MyLeadsController@myLeadsTableData')->name('myleadsTableData');


//task generate

Route::get('/task_generate','LeadTaskController@taskIndex')->name('task_generate');

Route::post('/generate_task','LeadTaskController@generateTask')->name('generate_task');

//status update

Route::get('/status_update','LeadTaskController@Index')->name('status_update');
Route::get('/add_status','LeadTaskController@create')->name('add_status');
Route::post('/status_add','LeadTaskController@statusAdd')->name('status_add');
Route::post('statusTableData', 'LeadTaskController@statusTableData')->name('statusTableData');
Route::get('/dailystatus/{id}', 'LeadTaskController@dailystatus')->name('dailystatus');

