<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\StuffController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Trash\RoleTrashController;
use App\Http\Controllers\Trash\UserTrashController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Trash\StuffTrashController;
use App\Http\Controllers\Backend\CopyrightController;
use App\Http\Controllers\Trash\ModuleTrashController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\BreadcrumbController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Trash\BookingTrashController;
use App\Http\Controllers\Trash\ServiceTrashController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Backend\LogoFaviconController;
use App\Http\Controllers\Backend\WebsiteLinkController;
use App\Http\Controllers\Frontend\UserLogoutController;
use App\Http\Controllers\Backend\PhotoGalleryController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\PhotoCategoryController;
use App\Http\Controllers\Frontend\ProfileImageController;
use App\Http\Controllers\Trash\DepartmentTrashController;
use App\Http\Controllers\Trash\PermissionTrashController;
use App\Http\Controllers\Trash\PhotoGalleryTrashController;
use App\Http\Controllers\Trash\VideoGalleryTrashController;
use App\Http\Controllers\Trash\PhotoCategoryTrashController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\BookingController as BackendBookingController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\Trash\TestimonialTrashController;

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

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('about', [WebsiteController::class, 'about'])->name('about');
Route::get('rooms', [WebsiteController::class, 'rooms'])->name('rooms');
Route::get('services', [WebsiteController::class, 'services'])->name('services');
Route::get('photogallery', [WebsiteController::class, 'photoGallery'])->name('photo.gallery');
Route::get('videogallery', [WebsiteController::class, 'videoGallery'])->name('video.gallery');
Route::get('room/details/{id}', [WebsiteController::class, 'roomDetails'])->name('room.details');
Route::get('booking/{id}', [WebsiteController::class, 'booking'])->name('booking');

Route::prefix('user')->middleware('auth', 'is_user')->group(function(){
    Route::get('/dashboard', [ProfileController::class, 'userDashboard'])->name('user.dashboard');
    Route::post('/logout', [UserLogoutController::class, 'logout'])->name('user.logout');
    Route::post('/general_store', [ProfileController::class, 'generalStore'])->name('general.store');
    Route::post('/profile_store', [ProfileController::class, 'profileStore'])->name('profile.store');
    Route::post('myupdate/password', [ProfileController::class, 'updatePassword'])->name('mypostupdate.password');

    Route::post('image/crop',[ProfileImageController::class, 'crop'])->name('image.crop');

    Route::get('booking_history', [BookingController::class, 'bookingHistory'])->name('booking.history');
    Route::post('booking/store', [BookingController::class, 'bookingStore'])->name('booking.store');
    Route::post('/booking/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');

    //Payment Getway Route
    Route::get('stripe', [StripePaymentController::class, 'stripe']);
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

    //Testimonial Route
    Route::get('testimonial_view', [FrontendTestimonialController::class, 'testimonialView'])->name('testimonial.view');
    Route::post('testimonial_store', [FrontendTestimonialController::class, 'testimonialStore'])->name('testimonial.store');

});

//Socialite Login Routes
Route::group(['as' => 'login.', 'prefix' => 'login'], function() {
    Route::get('/{provider}', [SocialiteLoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback'])
    ->name('provider.callback');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function(){

    Route::get('/login', [AdminLoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')->middleware('auth', 'is_admin')->group(function(){
    Route::get('/dashboard', [BackendHomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');

    // Module Route
    Route::get('modules/trash', [ModuleTrashController::class, 'trash'])
    ->name('modules.trash');
    Route::get('modules/{module_slug}/restore', [ModuleTrashController::class, 'restore'])
    ->name('modules.restore');
    Route::delete('modules/{module_slug}/forcedelete', [ModuleTrashController::class, 'forceDelete'])
    ->name('modules.forcedelete');
    Route::resource('/modules', ModuleController::class);

    // Permission Route
    Route::get('permissions/trash', [PermissionTrashController::class, 'trash'])
    ->name('permissions.trash');
    Route::get('permissions/{permission_slug}/restore', [PermissionTrashController::class, 'restore'])
    ->name('permissions.restore');
    Route::delete('permissions/{permission_slug}/forcedelete', [PermissionTrashController::class, 'forceDelete'])
    ->name('permissions.forcedelete');
    Route::resource('/permissions', PermissionController::class);

    // Role Route
    Route::get('roles/trash', [RoleTrashController::class, 'trash'])
    ->name('roles.trash');
    Route::get('roles/{role_slug}/restore', [RoleTrashController::class, 'restore'])
    ->name('roles.restore');
    Route::delete('roles/{role_slug}/forcedelete', [RoleTrashController::class, 'forceDelete'])
    ->name('roles.forcedelete');
    Route::resource('roles', RoleController::class);

    // User Route
    Route::get('/users/trash', [UserTrashController::class, 'trash'])->name('users.trash');
    Route::get('/users/restore/{id}', [UserTrashController::class, 'restore'])
    ->name('users.restore');
    Route::delete('/users/forcedelete/{id}', [UserTrashController::class, 'forceDelete'])
    ->name('users.forcedelete');
    // Ajax Call Active
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])
        ->name('user.is_active.ajax');
    Route::resource('/users', UserController::class);

    // Page Route
    Route::resource('/pages', PageController::class);

    /*
    | General Setting Start                    |
    |------------------------------------------|
    */

    // Logo_Favicon Route
    Route::resource('logo_fav', LogoFaviconController::class);

    // Breadcrumb Route
    Route::resource('breadcrumb', BreadcrumbController::class);

    // Websitelink Route
    Route::resource('website_link', WebsiteLinkController::class);

    // Home Slider Route
    Route::resource('home_slider', HomeSliderController::class);

    // Copyright Route
    Route::resource('copyright', CopyrightController::class);

    /*
    | General Setting End                      |
    |------------------------------------------|
    */

    //About Setting Start
    Route::resource('about', AboutController::class);
    //About Setting End

    // Room Type Route
    Route::resource('room_types', RoomTypeController::class);

    // Room Route
    // Ajax Call Active
    Route::get('check/room/is_wifi/{room_id}', [RoomController::class, 'checkActiveWifi'])
    ->name('room.is_wifi.ajax');
    Route::get('check/room/is_ac/{room_id}', [RoomController::class, 'checkActiveAC'])
    ->name('room.is_ac.ajax');
    Route::get('check/room/is_tv/{room_id}', [RoomController::class, 'checkActiveTV'])
    ->name('room.is_tv.ajax');
    Route::get('check/room/is_balcony/{room_id}', [RoomController::class, 'checkActiveBalcony'])
    ->name('room.is_balcony.ajax');
    Route::get('check/room/is_mini_fridge/{room_id}', [RoomController::class, 'checkActiveMiniFridge'])
    ->name('room.is_mini_fridge.ajax');
    Route::get('check/room/is_kitchenette/{room_id}', [RoomController::class, 'checkActiveKitchenette'])
    ->name('room.is_kitchenette.ajax');
    Route::get('check/room/is_living_area/{room_id}', [RoomController::class, 'checkActiveLivingArea'])
    ->name('room.is_living_area.ajax');
    // Delete a single multiple image by ajax
    Route::delete('/room/image/{id}', [RoomController::class, 'deleteRoomImage'])->name('room.image.delete');
    Route::resource('rooms', RoomController::class);

    // Department Route
    Route::get('/departments/trash', [DepartmentTrashController::class, 'trash'])->name('departments.trash');
    Route::get('/departments/restore/{id}', [DepartmentTrashController::class, 'restore'])
    ->name('departments.restore');
    Route::delete('/departments/forcedelete/{id}', [DepartmentTrashController::class, 'forceDelete'])
    ->name('departments.forcedelete');
    // Text Editor Image Upload With Ajax
    Route::post('departments/upload-image', [DepartmentController::class, 'uploadImage'])->name('departments.upload-image');
    Route::resource('departments', DepartmentController::class);

    // Stuff Route
    Route::get('/staffs/trash', [StuffTrashController::class, 'trash'])->name('staffs.trash');
    Route::get('/staffs/restore/{id}', [StuffTrashController::class, 'restore'])
    ->name('staffs.restore');
    Route::delete('/staffs/forcedelete/{id}', [StuffTrashController::class, 'forceDelete'])
    ->name('staffs.forcedelete');
    // Text Editor Image Upload With Ajax
    Route::post('staffs/upload-image', [StuffController::class, 'uploadImage'])->name('staffs.upload-image');
    Route::get('staff_payment/{id}', [StuffController::class, 'staffPayment'])->name('staff.payment');
    Route::post('staff_payment/save/{id}', [StuffController::class, 'staffPaymentSave'])->name('staff.payment.save');
    Route::delete('staff_payment/delete/{id}', [StuffController::class, 'staffPaymentDelete'])->name('staff.payment.delete');
    Route::resource('staffs', StuffController::class);

    //Bookin Route
    Route::get('/bookings/trash', [BookingTrashController::class, 'trash'])->name('bookings.trash');
    Route::get('/bookings/restore/{id}', [BookingTrashController::class, 'restore'])
    ->name('bookings.restore');
    Route::delete('/bookings/forcedelete/{id}', [BookingTrashController::class, 'forceDelete'])
    ->name('bookings.forcedelete');
    // Ajax Call Active
    Route::get('check/booking/payment_status/{booking_id}', [BackendBookingController::class, 'checkActivePaymentStatus'])
    ->name('booking.payment_status.ajax');
    Route::resource('bookings', BackendBookingController::class);


    //Service Route
    Route::get('/services/trash', [ServiceTrashController::class, 'trash'])->name('services.trash');
    Route::get('/services/restore/{id}', [ServiceTrashController::class, 'restore'])
    ->name('services.restore');
    Route::delete('/services/forcedelete/{id}', [ServiceTrashController::class, 'forceDelete'])
    ->name('services.forcedelete');
    // Ajax Call Active
    Route::get('check/service/is_active/{service_id}', [ServiceController::class, 'checkActiveActive'])
    ->name('service.is_active.ajax');
    Route::get('check/service/is_home/{service_id}', [ServiceController::class, 'checkActiveHome'])
    ->name('service.is_home.ajax');
    Route::resource('services', ServiceController::class);


    //Photo Category Route
    Route::get('/photocategories/trash', [PhotoCategoryTrashController::class, 'trash'])->name('photocategories.trash');
    Route::get('/photocategories/restore/{id}', [PhotoCategoryTrashController::class, 'restore'])
    ->name('photocategories.restore');
    Route::delete('/photocategories/forcedelete/{id}', [PhotoCategoryTrashController::class, 'forceDelete'])
    ->name('photocategories.forcedelete');
    // Ajax Call Active
    Route::get('check/photocategory/is_active/{category_id}', [PhotoCategoryController::class, 'checkActiveActive'])
    ->name('category.is_active.ajax');
    Route::get('check/photocategory/is_home/{category_id}', [PhotoCategoryController::class, 'checkActiveHome'])
    ->name('category.is_home.ajax');
    Route::resource('photocategories', PhotoCategoryController::class);

    //Photo Gallery Route
    Route::get('/photogalleries/trash', [PhotoGalleryTrashController::class, 'trash'])->name('photogalleries.trash');
    Route::get('/photogalleries/restore/{id}', [PhotoGalleryTrashController::class, 'restore'])
    ->name('photogalleries.restore');
    Route::delete('/photogalleries/forcedelete/{id}', [PhotoGalleryTrashController::class, 'forceDelete'])
    ->name('photogalleries.forcedelete');
    // Ajax Call Active
    Route::get('check/photogallery/is_active/{gallery_id}', [PhotoGalleryController::class, 'checkActiveActive'])
    ->name('gallery.is_active.ajax');
    Route::get('check/photogallery/is_home/{gallery_id}', [PhotoGalleryController::class, 'checkActiveHome'])
    ->name('gallery.is_home.ajax');
    Route::resource('photogalleries', PhotoGalleryController::class);


    //Video Gallery Route
    Route::get('/videogalleries/trash', [VideoGalleryTrashController::class, 'trash'])->name('videogalleries.trash');
    Route::get('/videogalleries/restore/{id}', [VideoGalleryTrashController::class, 'restore'])
    ->name('videogalleries.restore');
    Route::delete('/videogalleries/forcedelete/{id}', [VideoGalleryTrashController::class, 'forceDelete'])
    ->name('videogalleries.forcedelete');
    // Ajax Call Active
    Route::get('check/videogallery/is_active/{video_id}', [VideoGalleryController::class, 'checkActiveActive'])
    ->name('videogallery.is_active.ajax');
    Route::get('check/videogallery/is_home/{video_id}', [VideoGalleryController::class, 'checkActiveHome'])
    ->name('videogallery.is_home.ajax');
    Route::resource('videogalleries', VideoGalleryController::class);

    //Testimonial Route
    Route::get('/testimonials/trash', [TestimonialTrashController::class, 'trash'])->name('testimonials.trash');
    Route::get('/testimonials/restore/{id}', [TestimonialTrashController::class, 'restore'])
    ->name('testimonials.restore');
    Route::delete('/testimonials/forcedelete/{id}', [TestimonialTrashController::class, 'forceDelete'])
    ->name('testimonials.forcedelete');
    // Ajax Call Active
    Route::get('check/testimonial/is_active/{testimonial_id}', [TestimonialController::class, 'checkActiveActive'])
    ->name('testimonial.is_active.ajax');
    Route::get('check/testimonial/is_home/{testimonial_id}', [TestimonialController::class, 'checkActiveHome'])
    ->name('testimonial.is_home.ajax');
    Route::resource('testimonials', TestimonialController::class);
});
