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
     * Routes for the innovations
     *
     * Get a specific innovation
     */
    get('innovation/{id}', [
        'as' => 'specificInnovation', 'uses' => 'InnovationController@show'
    ]);

    /*
     * Route for getting all open innovations
     */

    get('innovations/open', [

        'as' => 'allOpenInnovations', 'uses' => 'InnovationController@open'
    ]);

    /*
     *Route for getting all funded innovations
     */
    get('innovations/funded', [
        'as' => 'allFundedInnovations', 'uses' => 'InnovationController@funded'
    ]);

    /*
     * Route for getting all innovations funded by an investor
     */

    get('innovations/investor/funded', [

        'as' => 'investorFundedInnovations', 'uses' => 'InnovationController@investorFunded'
    ]);

    /*
     * Route for getting innovation edit page
     */

    get('innovation/{innovation_id}/edit', [

        'as' => 'getEditInnovationPage', 'uses' =>  'InnovationController@editInnovation'

    ]);

    /*
     *Route for updating an innovation
     */



    post('create/innovation/', [
        'as' => 'createInnovation', 'uses' => 'InnovationController@store'
    ]);

    post('innovation/{innovation_id}/update', [
        'as' => 'updateInnovation', 'uses' => 'InnovationController@updateInnovation'
    ]);

    post('innovation/{id}/fund', [

        'as' => 'fundInnovation', 'uses' =>  'InnovationController@fundPartial'
    ]);

    get('innovation/{is}/portfolio', [
        'as' => 'innovationPortfolio', 'uses' => 'InnovationController@getPortfolio'
    ]);

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

    //Logout Route(s)
    get('auth/logout',[
        'as' => 'logout', 'uses' =>   'Auth\AuthController@getLogout'
    ]);

    get('request/all/investors', 'InvestorRequestsController@getAll');


    get('request/all/experts/', 'BongoRequestController@getAll');

    /*
     * Profile routes
     */
    get('innovator/profile/{innovator_id}', 'ProfileController@loadProfile');
    get('investor/profile/{innovator_id}', 'ProfileController@loadProfile');
    get('expert/profile/{innovator_id}', 'ProfileController@loadProfile');
    get('mother/profile/{innovator_id}', 'ProfileController@loadProfile');

    /**Route::resource('chats', 'ChatController',
    ['except' => ['create', 'edit']]);*/

    Route::get('get-innovation', 'InnovationController@viewInnovation');

    //Route::get('messages', 'ChatController@index');

    //Route::post('chats/make', 'ChatController@store');

    Route::post('investor/add-finance', 'ProfileController@SetInvestorAmount');

    post('innovator/profile/update/{profile_id}', 'ProfileController@updateProfileInnovator');
    post('investor/profile/update/{profile_id}', 'ProfileController@updateProfileInvestor');
    post('expert/profile/update/{profile_id}', 'ProfileController@updateProfileExpert');
    post('mother/profile/update/{profile_id}', 'ProfileController@updateProfileMother');

});

Route::group(['prefix' => 'messages', 'before' => 'auth'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::get('{innovation_id}/create-expert', ['as' => 'messages.create-expert', 'uses' => 'MessagesController@createExpert']);
    Route::get('{innovation_id}/create-mother', ['as' => 'messages.create-mother', 'uses' => 'MessagesController@createMother']);
    Route::get('{innovation_id}/create-investor', ['as' => 'messages.create-investor', 'uses' => 'MessagesController@createInvestor']);
    Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
    Route::get('unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});


    get('request/expert/confirm/{request_link}', 'BongoRequestController@bongoConfirmLink');

    get('request/investor/confirm/{request_link}', 'InvestorRequestsController@bongoConfirmLink');





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

    post('auth/register/expert', [
        'as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister'
    ]);

    /*
     * Request routes
     */

    get('request/investor/send/', 'InvestorRequestsController@getSendRequest');

    get('request/expert/send', 'BongoRequestController@getSendRequest');

    post('request/investor/send/', 'InvestorRequestsController@persistRequest');

    post('request/expert/send/', 'BongoRequestController@persistRequest');

    // Password reset link request routes...
    get('password/email', 'Auth\PasswordController@getEmail');
    post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    get('password/reset/{token}', 'Auth\PasswordController@getReset');
    post('password/reset', 'Auth\PasswordController@postReset');
});




