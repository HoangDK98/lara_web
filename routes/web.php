<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

// ============Admin===============
Route::get('admin/home', 'AdminController@index');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// admin
Route::group(['prefix' =>'admin','namespace' => 'Admin'], function () {
	Route::get('/', 'LoginController@showLoginForm')->name('admin.login');
	Route::post('/', 'LoginController@login');
	// Password Reset Routes...
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('admin-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('reset/password/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('update/reset', 'ResetPasswordController@reset')->name('admin.reset.update');
	

	//Admin section
		//category
	Route::group(['prefix' =>'category'], function () {
		Route::get('/', 'Category\CategoryController@category')->name('categories');
		Route::post('store', 'Category\CategoryController@storeCategory')->name('category.store');
		Route::get('delete/{id}', 'Category\CategoryController@deleteCategory')->name('category.delete');
		Route::get('edit/{id}', 'Category\CategoryController@editCategory')->name('category.edit');
		Route::post('update/{id}', 'Category\CategoryController@updateCategory')->name('category.update');
	});

		//brand
	Route::group(['prefix' =>'brand'], function () {
		Route::get('/', 'Category\BrandController@brand')->name('brands');
		Route::post('store', 'Category\BrandController@storeBrand')->name('brand.store');
		Route::get('delete/{id}', 'Category\BrandController@deleteBrand')->name('brand.delete');
		Route::get('edit/{id}', 'Category\BrandController@editBrand')->name('brand.edit');
		Route::post('update/{id}', 'Category\BrandController@updateBrand')->name('brand.update');
	});
		//subcategory
	Route::group(['prefix' =>'subcategory'], function () {
		Route::get('/', 'Category\SubCategoryController@subCategory')->name('sub.categories');
		Route::post('store', 'Category\SubCategoryController@storeSubCategory')->name('subcategory.store');
		Route::get('delete/{id}', 'Category\SubCategoryController@deleteSubCategory')->name('subcategory.delete');
		Route::get('edit/{id}', 'Category\SubCategoryController@editSubCategory')->name('subcategory.edit');
		Route::post('update/{id}', 'Category\SubCategoryController@updateSubCategory')->name('subcategory.update');
	});

		//product
		Route::group(['prefix' =>'product'], function () {
			Route::get('all', 'Product\ProductController@index')->name('product.all');
			Route::get('add', 'Product\ProductController@createProduct')->name('product.add');
			Route::post('store', 'Product\ProductController@storeProduct')->name('product.store');
			Route::get('active/{id}', 'Product\ProductController@activeProduct')->name('product.active');
			Route::get('inactive/{id}', 'Product\ProductController@inactiveProduct')->name('product.inactive');
			Route::get('delete/{id}', 'Product\ProductController@deleteProduct')->name('product.delete');
			Route::get('view/{id}', 'Product\ProductController@viewProduct')->name('product.view');
			Route::get('edit/{id}', 'Product\ProductController@editProduct')->name('product.edit');
			Route::post('update/withoutimg/{id}', 'Product\ProductController@updateWithoutImg')->name('product.updateWithoutImg');
			Route::post('update/img/{id}', 'Product\ProductController@updateImg')->name('product.updateimg');
			
		});

		//Coupon
	
	Route::group(['prefix' =>'coupon'], function () {
		Route::get('/','Coupon\CouponController@Coupon')->name('coupons');
		Route::post('store', 'Coupon\CouponController@storeCoupon')->name('coupon.store');
		Route::get('delete/{id}', 'Coupon\CouponController@deleteCoupon')->name('coupon.delete');
		Route::get('edit/{id}', 'Coupon\CouponController@editCoupon')->name('coupon.edit');
		Route::post('update/{id}', 'Coupon\CouponController@updateCoupon')->name('coupon.update');
	});

		//News Letters
	Route::group(['prefix' =>'newsletter'], function () {
		Route::get('/','Newsletter\NewsletterController@Coupon')->name('newsletters');
		Route::get('delete/{id}', 'FrontController@deleteNewsletter')->name('newsletter.delete');

	});	

	
});

//show subcategory with ajax

Route::get('get/subcategory/{category_id}', 'Admin\Product\ProductController@getSubCate');




//Client
   //News Letters
Route::post('newsletter/store', 'FrontController@storeNewsletter')->name('newsletter.store');



