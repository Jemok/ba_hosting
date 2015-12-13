<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function() {
    /*
     * Home routes
     */
    get('/', [
        'as' => 'home', 'uses' => 'DashboardController@home'
    ]);
    get('/home', [
        'as' => 'home', 'uses' => 'DashboardController@home'
    ]);
    /*
     *Logout Route(s)
     */
    get('logout',[
        'as' => 'logout', 'uses' =>   'Auth\AuthController@getLogout'
    ]);
    /*
     * Home routes
     */
    get('/', [
        'as' => 'home', 'uses' => 'DashboardController@home'
    ]);


    /*
     *Logout Route(s)
     */
    get('logout',[
        'as' => 'logout', 'uses' =>   'Auth\AuthController@getLogout'
    ]);
    /*
     * Routes for the innovations
     */
    get('innovation/{id}', [
        'as' => 'specificInnovation', 'uses' => 'InnovationController@show'
    ]);

    get('innovations/open', 'InnovationController@open');

    get('innovations/funded', 'InnovationController@funded');

    get('innovation/{id}/update', [
        'as' => 'editInnovation', 'uses' => 'InnovationController@edit'
    ]);

    get('innovation/{id}/delete', [
        'as' => 'deleteInnovation', 'uses' => 'InnovationController@destroy'
    ]);


    post('create/innovation/', [
        'as' => 'createInnovation', 'uses' => 'InnovationController@store'
    ]);

    post('innovation/{id}/update', [
        'as' => 'updateInnovation', 'uses' => 'InnovationController@update'
    ]);

    get('innovation/fund/{id}', [
        'as' => 'fundInnovation', 'uses' => 'InnovationController@fund'
    ]);

    post('innovation/fund/{id}', 'InnovationController@fundPartial');

    get('innovation/portfolio/{is}', 'InnovationController@getPortfolio');

    get('innovations', function()
    {
        $query = Request::get('q');

        $repo = App::make('Md\Repos\Innovation\InnovationRepository');

        $innovations = $query

            ? $repo->search($query)
            : $repo->getAll();

        return View('dashboards.innovator')->withInnovations($innovations);
    });

    //Dashboard retrieval routes
    get('dashboard/innovator', [
        'as' => 'innovatorDashboard', 'uses' => 'DashboardController@innovator'
    ]);

    get('dashboard/investor', [
        'as' => 'investorDashboard', 'uses' => 'DashboardController@investor'
    ]);

    get('dashboard/bongo/admin', [
        'as' => 'bongoDashboard', 'uses' => 'DashboardController@bongoEmployee'
    ]);

    get('request/bongo/send/{request_id}/', 'InvestorRequestsController@bongoSendLink');

    get('request/bongo-employee/send/{request_id}/', 'BongoRequestController@bongoSendLink');

    get('request/bongo/confirm/{request_link}', 'InvestorRequestsController@bongoConfirmLink');

    get('request/bongo-employee/confirm/{request_link}', 'BongoRequestController@bongoConfirmLink');


    //Logout Route(s)
    get('auth/logout',[
        'as' => 'logout', 'uses' =>   'Auth\AuthController@getLogout'
    ]);

    get('request/all/investors', 'InvestorRequestsController@getAll');


    get('request/all/employees/', 'BongoRequestController@getAll');

    /*
     * Profile routes
     */
    get('innovator/profile/{innovator_id}', 'ProfileController@loadProfile');

    /**Route::resource('chats', 'ChatController',
    ['except' => ['create', 'edit']]);*/

    Route::get('get-innovation', 'InnovationController@viewInnovation');

    //Route::get('messages', 'ChatController@index');

    //Route::post('chats/make', 'ChatController@store');

});


Route::group(['middleware' => 'guest'], function() {

    // Login routes
    get('/auth/login', [
        'as' => '/auth/login', 'uses' => 'Auth\AuthController@getLogin'
    ]);

    get('/about', 'DashboardController@about');

    post('login', [
        'as' => 'login', 'uses' => 'Auth\AuthController@postLogin'
    ]);

// Registration routes...
    get('auth/register', [
        'as' => 'register', 'uses' => 'Auth\AuthController@getRegister'
    ]);

    post('auth/register/innovator', [
        'as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister'
    ]);

    post('auth/register/investor', [
        'as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister'
    ]);

    post('auth/register/bongo-employee', [
        'as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister'
    ]);

    /*
     * Request routes
     */

    get('request/investor/send/', 'InvestorRequestsController@getSendRequest');

    get('request/bongo/send', 'BongoRequestController@getSendRequest');

    post('request/investor/send/', 'InvestorRequestsController@persistRequest');

    post('request/bongo/send/', 'BongoRequestController@persistRequest');
});

Route::group(['prefix' => 'messages', 'before' => 'auth'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::get('{innovation_id}/create-mother', ['as' => 'messages.create-mother', 'uses' => 'MessagesController@createMother']);
    Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
    Route::get('unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});


