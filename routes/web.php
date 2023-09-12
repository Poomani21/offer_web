<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**** LARASNAP ROUTES START ****/

Route::group(['namespace' => '\LaraSnap\LaravelAdmin\Controllers','prefix' => 'admin', 'middleware' => ['web', 'auth', 'check-userstatus'], 'roles' => '' ], function(){
	
    Route::group(['middleware' => ['check-roles'] ], function(){
        
        /** DASHBOARD ROUTES **/
        Route::get('/', [App\Http\Controllers\DashboardController::class,'__invoke'])->name('dashboard');
        /** DASHBOARD ROUTES **/
        
       

        /** USER ROUTES **/
        Route::group(['prefix' => 'users', 'exculde' => ['users.filter', 'users.store', 'users.update', 'users.bulkdestroy', 'users.assignrole_store']], function(){
            Route::get('/',[App\Http\Controllers\User\UserController::class, 'index'])->name('users.index');
            Route::post('/',[App\Http\Controllers\User\UserController::class, 'index'])->name('users.filter');
            Route::get('create',[App\Http\Controllers\User\UserController::class, 'create'])->name('users.create');
            Route::post('create',[App\Http\Controllers\User\UserController::class, 'store'])->name('users.store');
            Route::get('{user}/edit',[App\Http\Controllers\User\UserController::class, 'edit'])->name('users.edit');
            Route::put('{user}',[App\Http\Controllers\User\UserController::class, 'update'])->name('users.update');
            Route::get('{user}',[App\Http\Controllers\User\UserController::class, 'show'])->name('users.show');
            Route::delete('{user}',[App\Http\Controllers\User\UserController::class, 'destroy'])->name('users.destroy');
            Route::delete('/',[App\Http\Controllers\User\UserController::class, 'bulkdestroy'])->name('users.bulkdestroy');
            Route::get('{user}/roles',[App\Http\Controllers\User\UserController::class, 'assignRoleCreate'])->name('users.assignrole_create');
            Route::post('{user}/roles',[App\Http\Controllers\User\UserController::class, 'assignRoleStore'])->name('users.assignrole_store');
        });
        /** USER ROUTES **/
        
        /** PROFILE ROUTES **/
        Route::group(['prefix' => 'profile', 'exculde' => ['profile.edit', 'profile.update']], function(){
            Route::get('/', 'ProfileController@edit')->name('profile.edit');
            Route::put('{user}', 'ProfileController@update')->name('profile.update');
        });
        /** PROFILE ROUTES **/
        
        /** ROLE ROUTES **/
        Route::group(['prefix' => 'roles', 'exculde' => ['roles.filter', 'roles.store', 'roles.update', 'roles.assignpermission_store', 'roles.assignscreen_store']], function(){
            Route::get('/','RoleController@index')->name('roles.index');
            Route::post('/','RoleController@index')->name('roles.filter');
            Route::get('create','RoleController@create')->name('roles.create');
            Route::post('create','RoleController@store')->name('roles.store');
            Route::get('{role}/edit','RoleController@edit')->name('roles.edit');
            Route::put('{role}','RoleController@update')->name('roles.update');
            Route::delete('{role}','RoleController@destroy')->name('roles.destroy');
            Route::get('{role}/permissions','RoleController@assignPermissionCreate')->name('roles.assignpermission_create');
            Route::post('{role}/permissions','RoleController@assignPermissionStore')->name('roles.assignpermission_store');
            Route::get('{role}/screens','RoleController@assignScreenCreate')->name('roles.assignscreen_create');
            Route::post('{role}/screens','RoleController@assignScreenStore')->name('roles.assignscreen_store');
        });
        /** ROLE ROUTES **/	
        
        /** PERMISSION ROUTES **/
        Route::group(['prefix' => 'permissions', 'exculde' => ['permissions.filter', 'permissions.store', 'permissions.update']], function(){
            Route::get('/','PermissionController@index')->name('permissions.index');
            Route::post('/','PermissionController@index')->name('permissions.filter');
            Route::get('create','PermissionController@create')->name('permissions.create');
            Route::post('create','PermissionController@store')->name('permissions.store');
            Route::get('{permission}/edit','PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}','PermissionController@update')->name('permissions.update');
            Route::delete('{permission}','PermissionController@destroy')->name('permissions.destroy');
        });
        /** PERMISSION ROUTES **/		
        
        /** SCREEN ROUTES **/
        Route::group(['prefix' => 'screens', 'exculde' => ['screens.filter', 'screens.store', 'screens.update', 'screens.assignrole_store', 'screens.modules', 'screens.modules_store', 'screens.modules_destroy']], function(){
            Route::get('/','ScreenController@index')->name('screens.index');
            Route::post('/','ScreenController@index')->name('screens.filter');
            Route::get('create','ScreenController@create')->name('screens.create');
            Route::post('create','ScreenController@store')->name('screens.store');
            Route::get('{screen}/edit','ScreenController@edit')->name('screens.edit');
            Route::put('{screen}','ScreenController@update')->name('screens.update');
            Route::delete('{screen}','ScreenController@destroy')->name('screens.destroy');
            Route::get('{screen}/roles','ScreenController@assignRoleCreate')->name('screens.assignrole_create');
            Route::post('{screen}/roles','ScreenController@assignRoleStore')->name('screens.assignrole_store');
            Route::get('modules','ScreenController@getModules')->name('screens.modules');
            Route::post('modules','ScreenController@storeModule')->name('screens.modules_store');
            Route::delete('modules/{module}','ScreenController@destroyModule')->name('screens.modules_destroy');
        });
        /** SCREEN ROUTES **/
    
        /** MODULE ROUTES **/
        Route::group(['prefix' => 'modules', 'exculde' => ['modules.filter', 'modules.store', 'modules.update']], function(){
            Route::get('/','ModuleController@index')->name('modules.index');
            Route::post('/','ModuleController@index')->name('modules.filter');
            Route::get('create','ModuleController@create')->name('modules.create');
            Route::post('create','ModuleController@store')->name('modules.store');
            Route::get('{module}/edit','ModuleController@edit')->name('modules.edit');
            Route::put('{module}','ModuleController@update')->name('modules.update');
            Route::delete('{module}','ModuleController@destroy')->name('modules.destroy');
        });
        /** MODULE ROUTES **/
    
        /** MENU ROUTES **/
        Route::group(['prefix' => 'menus', 'exculde' => ['menus.filter', 'menus.store', 'menus.update', 'menus.order', 'menus.item_store', 'menus.item_update', 'menus.item.destory']], function(){
            Route::get('/','MenuController@index')->name('menus.index');
            Route::post('/','MenuController@index')->name('menus.filter');
            Route::get('create','MenuController@create')->name('menus.create');
            Route::post('create','MenuController@store')->name('menus.store');
            Route::get('{menu}/edit','MenuController@edit')->name('menus.edit');
            Route::put('{menu}','MenuController@update')->name('menus.update');
            Route::delete('{menu}','MenuController@destroy')->name('menus.destroy');
            Route::get('{menu}/builder','MenuController@builder')->name('menus.builder');
            Route::post('{menu}/order','MenuController@orderItem')->name('menus.order');
            Route::post('{menu}/item','MenuController@itemStore')->name('menus.item_store');
            Route::put('{menu}/item','MenuController@itemUpdate')->name('menus.item_update');
            Route::delete('{menu}/item', 'MenuController@itemDestroy')->name('menus.item.destory');
        });
        /** MENU ROUTES **/
        
        /** CATEGORY ROUTES **/
        Route::group(['prefix' => 'categories', 'exculde' => ['p_categories.filter', 'p_categories.store', 'p_categories.update', 'categories.filter', 'categories.store', 'categories.update']], function(){
            Route::get('/','CategoryParentController@index')->name('p_categories.index');
            Route::post('/','CategoryParentController@index')->name('p_categories.filter');
            Route::get('create','CategoryParentController@create')->name('p_categories.create');
            Route::post('create','CategoryParentController@store')->name('p_categories.store');
            Route::get('{p_category}/edit','CategoryParentController@edit')->name('p_categories.edit');
            Route::put('{p_category}','CategoryParentController@update')->name('p_categories.update');
            Route::delete('{p_category}','CategoryParentController@destroy')->name('p_categories.destroy');
            
            Route::get('{p_category}','CategoryController@index')->name('categories.index');
            Route::post('{p_category}','CategoryController@index')->name('categories.filter');
            Route::get('{p_category}/create','CategoryController@create')->name('categories.create');
            Route::post('{p_category}/create','CategoryController@store')->name('categories.store');
            Route::get('/{p_category}/{category}/edit','CategoryController@edit')->name('categories.edit');
            Route::put('{p_category}/{category}','CategoryController@update')->name('categories.update');
            Route::delete('{p_category}/{category}','CategoryController@destroy')->name('categories.destroy');
        });
        /** CATEGORY ROUTES **/
        
        /** SETTING ROUTES **/
        Route::group(['prefix' => 'settings', 'exculde' => ['settings.store']], function(){
            Route::get('/','SiteSettingController@create')->name('settings.create');
            Route::post('/','SiteSettingController@store')->name('settings.store');
        });	
        /** SETTING ROUTES **/
            
        /** DOCUMENT ROUTES **/
        Route::get('guide','DocsController@index')->name('docs.index');
        Route::get('/icons','DocsController@icons')->name('docs.icons');
        
    });
    
     /** ERROR ROUTES **/
     Route::group(['prefix' => 'error'], function(){
          Route::get('/401','ErrorController@noPermission')->name('errors.401');		   
     });
     /** ERROR ROUTES **/
    
    
});


/**** LARASNAP ROUTES END ****/


/*** other routes**/
Route::group(['namespace' => '\App\Http\Controllers','prefix' => 'admin', 'middleware' => ['web', 'auth', 'check-userstatus'], 'roles' => '' ], function(){
	
    Route::group(['middleware' => ['check-roles'] ], function(){

 /* Employee Routs starts*/
 Route::group(['prefix' => 'employee', 'exculde' => ['employee.filter', 'employee.store', 'employee.update']], function(){
    Route::get('/','EmployeeController@index')->name('employee.index');
    Route::post('/','EmployeeController@index')->name('employee.filter');
    Route::get('create','EmployeeController@create')->name('employee.create');
    Route::post('create','EmployeeController@store')->name('employee.store');
    Route::get('{employee}/edit','EmployeeController@edit')->name('employee.edit');
    Route::put('{employee}','EmployeeController@update')->name('employee.update');
    Route::get('{employee}','EmployeeController@show')->name('employee.show');
    Route::get('{employee}/delete','EmployeeController@destroy')->name('employee.destroy');
});
/* Employee Routs ends*/
 /* Image Routs starts*/
 Route::group(['prefix' => 'image', 'exculde' => ['image.filter', 'image.store', 'image.update']], function(){
    Route::get('{image}/imageupload','ImageController@imageupload')->name('imageupload');
    Route::post('/','ImageController@index')->name('image.filter');
    Route::post('store','ImageController@store')->name('image.store');
    Route::get('{image}/destroy','ImageController@destroy')->name('image.destroy');
    Route::get('/export','ImageController@downloadImage')->name('image.image_export');


});
/* image Routs ends*/
    });
});