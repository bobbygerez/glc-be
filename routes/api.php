<?php

Route::post('login', 'Auth\LoginController@login');
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser');

Route::group(['namespace' => 'Auth', 'prefix' => 'password'], function () {
    Route::post('create', 'ResetPasswordController@create');
    Route::get('find/{token}', 'ResetPasswordController@find');
   
});
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@getDetails');
Route::post('password/reset/{token}', 'Auth\ResetPasswordController@newPassword');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'Api\User\UserController');
    Route::post('profile-update/{id}', 'Api\User\UserController@profileUpdate');
    Route::resource('roles', 'Api\Role\RoleController');
    // Route::resource('role_menu', 'Api\Role\RoleMenuController');
    Route::resource('role_menus', 'Api\Role\MenuController');
    Route::resource('dashboard_categories', 'Api\Category\DashboardCategoryController');
    Route::get('categories-all', 'Api\Category\DashboardCategoryController@categoriesAll');
    Route::resource('dashboard_role', 'Api\Role\DashboardRoleController');
    Route::resource('menus', 'Api\Menu\MenuController');
    Route::get('search-menus', 'Api\Menu\MenuController@search');
    Route::resource('dashboard_menus', 'Api\Menu\DashboardMenuController');
    Route::resource('access_rights', 'Api\AccessRight\AccessRightController');
    Route::post('users/change-password', 'Api\User\UserController@changePassword');
    Route::get('get-stores', 'Api\Branch\BranchController@getStores');
    Route::resource('branches', 'Api\Branch\BranchController');
    Route::get('get-main-categories', 'Api\Category\CategoryController@mainCategories');
    Route::get('get-sub-categories', 'Api\Category\CategoryController@subCategories');
    Route::get('get-more-categories', 'Api\Category\CategoryController@moreCategories');
    Route::resource('dashboard_products', 'Api\Product\DashboardProductController');
    Route::post('dashboard-products-update/{id}', 'Api\Product\DashboardProductController@productUpdate');
    Route::resource('payments', 'Api\Payment\PaymentController');
    Route::resource('groups', 'Api\Group\GroupController');
    Route::resource('catalogs', 'Api\Catalog\CatalogController');
    Route::resource('product_groups', 'Api\Product\GroupController');
    Route::resource('product_catalogs', 'Api\Product\CatalogController');
   

});

/*** Single field validations */
Route::get('user/validator/username', 'API\User\UserValidationController@userName' );
Route::get('user/validator/email', 'API\User\UserValidationController@email' );
Route::get('user/validator/mobile', 'API\User\UserValidationController@mobile' );


Route::post('register/{activation_code}', 'Api\User\UserController@activationCode');
Route::post('user_register', 'Api\User\UserController@store');
Route::resource('delivery_price', 'Api\DeliveryPrice\DeliveryPriceController');
Route::resource('payment_options', 'Api\PaymentOption\PaymentOptionController');
Route::resource('products', 'Api\Product\ProductController');
Route::get('product-search', 'Api\Product\ProductController@search');
Route::get('provinces', 'Api\Places\PlacesController@provinces');
Route::get('cities/{provinceId}', 'Api\Places\PlacesController@cities');
Route::get('brgys/{cityId}', 'Api\Places\PlacesController@brgys');
Route::resource('categories', 'Api\Category\CategoryController');
Route::get('search-category', 'Api\Category\CategoryController@search');
Route::resource('category_products', 'Api\Product\CategoryProductController');
Route::resource('subcategory_products', 'Api\Product\SubCategoryProductController');
