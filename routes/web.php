<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\CampaignFeatureController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LahzaTransactionController;
use App\Http\Controllers\WinnerController;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\TwoFactorController;


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

// Auth Routes
require __DIR__.'/auth.php';


// Route::get('/user/two-factor-authentication-setup', [TwoFactorController::class, 'show'])
//     ->name('two-factor.setup');

// // Route to enable 2FA for the user (POST request)
// Route::post('/user/two-factor-authentication-setup', [TwoFactorController::class, 'enable']);

// // Route to show the 2FA verification view (GET request)
// Route::get('/user/two-factor-challenge', [TwoFactorController::class, 'challenge'])
//     ->name('two-factor.challenge');

// // Route to verify the 2FA code (POST request)
// Route::post('/user/two-factor-challenge', [TwoFactorController::class, 'verify']);

// // Route to disable 2FA for the user (DELETE request)
// Route::delete('/user/two-factor-authentication-setup', [TwoFactorController::class, 'disable']);
// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('terms', 'FrontendController@terms')->name('terms');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);

        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get('profile/changePassword/{id}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch('profile/changePassword/{id}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/campaigns", ['as' => "$module_name.campaigns", 'uses' => "$controller_name@getCampaigns"]);

    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::patch("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::patch("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
});


//Campaign
Route::resource('campaigns', CampaignController::class);
// Route::get('/campaigns/show-campaigns', [CampaignController::class, 'showAllCampaigns'])->name('campaigns.show-campaigns');
Route::get('/campaigns/{campaign}/create-features', [CampaignFeatureController::class, 'createFeatures'])->name('campaigns.features-create');
Route::get('/create-subscription', [CampaignController::class, 'createSubscription'])->name('campaigns.create-subscription');
Route::get('/active-campaigns', [CampaignController::class, 'activeCampaigns'])->name('active-campaigns.index');
Route::get('/completed-campaigns', [CampaignController::class, 'completedCampaigns'])->name('completed-campaigns.index');

Route::post('/campaigns/{campaign}/features', [CampaignFeatureController::class, 'store'])->name('campaigns.features.store');
Route::put('/campaigns/{campaign}/features/{feature}', [CampaignFeatureController::class, 'update'])->name('campaigns.features.update');
Route::delete('/campaigns/{campaign}/features/{feature}', [CampaignFeatureController::class, 'destroy'])->name('campaigns.features.destroy');
// Route::post('/subscribe', 'CampaignController@subscribe');
// Route::get('/winners', 'CampaignController@winners');

Route::resource('subscriptions', SubscriptionController::class);
Route::get('/my-campaigns', [CampaignController::class, 'myCampaigns'])
->name('my-campaigns.index');

Route::get('/all-campaigns', [CampaignController::class, 'allCampaigns'])
->name('show-all-campaigns');
//winner // Route to display the winner selection form
Route::get('/campaigns/{campaignId}/select-winner', [CampaignController::class, 'showSelectWinnerForm'])
->name('campaigns.select-winner');

// Route to actually select the winner
Route::post('/campaigns/{campaignId}/select-winner', [WinnerController::class, 'selectWinner'])
->name('campaigns.do-select-winner');

//features
Route::resource('features', FeatureController::class);






//payment
Route::post('/create-payment-page', [PaymentController::class, 'createPaymentPage']);
Route::get('/list-payment-pages', [PaymentController::class, 'listPaymentPages']);
Route::get('/fetch-payment-page/{idOrSlug}', [PaymentController::class, 'fetchPaymentPage']);
Route::put('/update-payment-page/{idOrSlug}', [PaymentController::class, 'updatePaymentPage']);
Route::get('/check-slug-availability/{slug}', [PaymentController::class, 'checkSlugAvailability']);


//transaction
Route::post('/create-transaction', [LahzaTransactionController::class, 'createTransaction']);
Route::get('/transaction/verify/{reference}', [LahzaTransactionController::class, 'verifyTransaction']);
Route::get('/transactions', [LahzaTransactionController::class, 'listTransactions']);
Route::get('/transaction/{id}', [LahzaTransactionController::class, 'fetchTransaction']);
Route::post('/charge-authorization', [LahzaTransactionController::class, 'chargeAuthorization']);
Route::get('/transaction/timeline/{idOrReference}', [LahzaTransactionController::class, 'viewTransactionTimeline']);


Route::get('/payment/{campaignId}', [PaymentController::class, 'showPaymentInterface'])->name('payment');
Route::post('/process-card-payment', [PaymentController::class, 'processCardPayment'])->name('process-card-payment');
Route::post('/process-usdt-payment', [PaymentController::class, 'processUsdtPayment'])->name('process-usdt-payment');


