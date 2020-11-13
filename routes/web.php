<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

Route::group(['namespace' => 'Admin'], function () {
	Route::get('admin', 'LoginController@showLoginForm')->name('admin.login');
	Route::post('admin', 'LoginController@login');
	// Password Reset Routes...
	Route::get('admin/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('admin-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('admin/reset/password/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('admin/update/reset', 'ResetPasswordController@reset')->name('admin.reset.update');
	

	//Admin section
			//Category
	Route::get('admin/categories', 'Category\CategoryController@category')->name('categories');
	Route::post('admin/store/category', 'Category\CategoryController@storeCategory')->name('store.category');
	Route::get('admin/delete/category/{id}', 'Category\CategoryController@deleteCategory')->name('delete.category');
});

