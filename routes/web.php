<?php

/*
 * Admin Routes
 */
Route::get('e2care/login', [
    'uses' => 'LoginController@getLoginPage',
    'as' => 'adminLogin'
]);
Route::post('e2care/login', [
    'uses' => 'LoginController@postAdminLogin',
    'as' => 'postAdminLogin'
]);
Route::get('shop/login', [
    'uses' => 'LoginController@getShopLogin',
    'as' => 'getShopLogin'
]);
Route::post('shop/login', [
    'uses' => 'LoginController@postServiceCenterLogin',
    'as' => 'postServiceCenterLogin'
]);


Route::group([
    'prefix' => 'e2care',
    'middleware' => 'admin'
], function () {
    Route::get('/', [
        'uses' => 'AdminController@getHome',
        'as' => 'adminHome'
    ]);
    Route::get('logout', [
        'as' => 'adminLogout',
        'uses' => 'LoginController@adminLogout',
    ]);
    Route::get('new-service-center-registrations', [
        'as' => 'newCenters',
        'uses' => 'AdminController@getNewCenters',
    ]);
    Route::get('service-center/{id}', [
        'as' => 'serviceCenter',
        'uses' => 'AdminController@getServiceCenterDetails',
    ]);
    Route::get('change-service-center-status/{id}', [
        'as' => 'centerStatus',
        'uses' => 'AdminController@changeCenterStatus',
    ]);
    Route::get('shop-types', [
        'as' => 'shopTypes',
        'uses' => 'AdminController@getShopTypes',
    ]);
    Route::post('shop-type', [
        'as' => 'postShopType',
        'uses' => 'AdminController@postShopType',
    ]);
    Route::get('all-shops', [
        'as' => 'allShops',
        'uses' => 'AdminController@getAllShops',
    ]);
});

Route::get('shop/register', [
    'uses' => 'ServiceCenterController@getRegistration',
    'as' => 'getShopRegister'
]);
Route::post('shop/register', [
    'uses' => 'ServiceCenterController@postRegistration',
    'as' => 'postShopRegister'
]);
Route::group([
    'prefix' => 'shop',
    'middleware' => 'shop'
], function () {
    Route::get('/', [
        'uses' => 'ServiceCenterController@getHome',
        'as' => 'shopHome'
    ]);
    Route::get('logout', [
        'as' => 'shopLogout',
        'uses' => 'LoginController@shopLogout',
    ]);
    Route::get('service-requests', [
        'uses' => 'ServiceCenterController@getServiceRequests',
        'as' => 'serviceRequests'
    ]);
    Route::get('service-request/{id}', [
        'uses' => 'ServiceCenterController@getServiceRequest',
        'as' => 'serviceRequest'
    ]);
    Route::get('accept-service-request/{id}', [
        'uses' => 'ServiceCenterController@getAcceptServiceRequestPage',
        'as' => 'acceptServiceRequestPage'
    ]);
    Route::post('accept-service-request', [
        'uses' => 'ServiceCenterController@acceptServiceRequest',
        'as' => 'acceptServiceRequest'
    ]);
    Route::post('edit-service-response', [
        'uses' => 'ServiceCenterController@editServiceResponse',
        'as' => 'editServiceResponse'
    ]);
    Route::get('edit-service-response/{id}', [
        'uses' => 'ServiceCenterController@getEditServiceResponsePage',
        'as' => 'getEditServiceResponse'
    ]);
    Route::get('change-request-status/{id}/{status}', [
        'uses' => 'ServiceCenterController@changeRequestStatus',
        'as' => 'changeRequestStatus'
    ]);
    Route::get('generate-bill/{id}', [
        'uses' => 'ServiceCenterController@generateBill',
        'as' => 'generateBill'
    ]);
    Route::get('close-service-entry/{id}', [
        'uses' => 'ServiceCenterController@closeEntry',
        'as' => 'closeServiceEntry'
    ]);
    Route::post('close-service', [
        'uses' => 'ServiceCenterController@postCloseEntry',
        'as' => 'postEntry'
    ]);
    Route::get('view-bill/{id}', [
        'uses' => 'ServiceCenterController@viewBill',
        'as' => 'viewBill'
    ]);
    Route::post('close-service-entry', [
        'uses' => 'ServiceCenterController@postCloseServiceEntry',
    ]);
    Route::get('customers', [
        'uses' => 'ServiceCenterController@getCustomers',
        'as'=>'getCustomers',
    ]);
    Route::get('customer/{id}', [
        'uses' => 'ServiceCenterController@getCustomer',
        'as'=>'getCustomer',
    ]);
    Route::get('view-bills', [
        'uses' => 'ServiceCenterController@viewBills',
        'as'=>'viewBills',
    ]);
    Route::get('view-reports', [
        'uses' => 'ServiceCenterController@viewReport',
        'as'=>'viewReports',
    ]);
});

/**
 * User routes
 */
Route::get('/', [
    'uses' => 'UserController@getHome',
    'as' => 'home'
]);
Route::get('register', [
    'uses' => 'UserController@getUserRegistration',
    'as' => 'register'
]);
Route::post('register', [
    'uses' => 'UserController@postUserRegistration',
    'as' => 'postRegister'
]);
Route::get('login', [
    'uses' => 'LoginController@getUserLogin',
    'as' => 'login'
]);
Route::get('logout', [
    'uses' => 'LoginController@logout',
    'as' => 'logout'
]);
Route::post('login', [
    'uses' => 'LoginController@postUserLogin',
    'as' => 'postLogin'
]);
Route::get('service-center/{id}', [
    'uses' => 'UserController@getUserServiceCenter',
    'as' => 'getServiceCenter'
]);
Route::get('search', [
    'uses' => 'UserController@search',
    'as' => 'search'
]);
Route::get('category/{id}/{name?}', [
    'uses' => 'UserController@categoryShops',
    'as' => 'categoryShops'
]);

Route::group([
    'middleware' => 'user'
], function () {
    Route::get('request-service/{id}', [
        'uses' => 'UserController@getRequestService',
        'as' => 'getRequestService'
    ]);
    Route::get('my-account', [
        'uses' => 'UserController@getMyAccount',
        'as' => 'myAccount'
    ]);
    Route::get('request-status/{id}', [
        'uses' => 'UserController@getRequestStatus',
        'as' => 'requestStatus'
    ]);
    Route::post('request-service', [
        'uses' => 'UserController@postRequestService',
        'as' => 'postRequestService'
    ]);
    Route::get('view-bill/{id}', [
        'uses' => 'UserController@viewBill',
        'as' => 'viewUserBill'
    ]);
    Route::get('payment/{id}', [
        'uses' => 'UserController@getPayment',
        'as' => 'getPayment'
    ]);
    Route::get('bank', [
        'uses' => 'UserController@getBank',
        'as' => 'getBank'
    ]);
    Route::post('payment', [
        'uses' => 'UserController@postPayment',
        'as' => 'postPayment'
    ]);
    Route::post('confirm-payment', [
        'uses' => 'UserController@confirmPayment',
        'as' => 'confirmPayment'
    ]);
});

Route::get('file/{filename}', [
    'uses' => 'FileController@getFile'
])->where('filename', '^(.+)/([^/]+)$');


