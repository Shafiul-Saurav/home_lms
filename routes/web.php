<?php

use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\BookCategoryController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\BookSubcategoryController;
use App\Http\Controllers\Backend\BreadcrumbController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildcategoryController;
use App\Http\Controllers\Backend\ContactController as BackendContactController;
use App\Http\Controllers\Backend\CopyrightController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\ExamCategoryController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\Backend\LogoFaviconController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PdfBookCategoryController;
use App\Http\Controllers\Backend\PdfBookController;
use App\Http\Controllers\Backend\PdfBookSubcategoryController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PhotoCategoryController;
use App\Http\Controllers\Backend\PhotoGalleryController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PrivacyPolicyController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\StuffController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TermsAndConditionsController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\WebsiteLinkController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProfileImageController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\Frontend\UserLogoutController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Trash\BookCategoryTrashController;
use App\Http\Controllers\Trash\BookSubcategoryTrashController;
use App\Http\Controllers\Trash\BookTrashController;
use App\Http\Controllers\Trash\CategoryTrashController;
use App\Http\Controllers\Trash\ChildcategoryTrashController;
use App\Http\Controllers\Trash\CourseTrashController;
use App\Http\Controllers\Trash\DepartmentTrashController;
use App\Http\Controllers\Trash\ExamCategoryTrashController;
use App\Http\Controllers\Trash\ExamTrashController;
use App\Http\Controllers\Trash\FaqTrashController;
use App\Http\Controllers\Trash\ModuleTrashController;
use App\Http\Controllers\Trash\PdfBookCategoryTrashController;
use App\Http\Controllers\Trash\PdfBookSubcategoryTrashController;
use App\Http\Controllers\Trash\PdfBookTrashController;
use App\Http\Controllers\Trash\PermissionTrashController;
use App\Http\Controllers\Trash\PhotoCategoryTrashController;
use App\Http\Controllers\Trash\PhotoGalleryTrashController;
use App\Http\Controllers\Trash\PostCategoryTrashController;
use App\Http\Controllers\Trash\PostTrashController;
use App\Http\Controllers\Trash\ProductTrashController;
use App\Http\Controllers\Trash\RoleTrashController;
use App\Http\Controllers\Trash\ServiceTrashController;
use App\Http\Controllers\Trash\StuffTrashController;
use App\Http\Controllers\Trash\SubcategoryTrashController;
use App\Http\Controllers\Trash\TestimonialTrashController;
use App\Http\Controllers\Trash\UserTrashController;
use App\Http\Controllers\Trash\VideoGalleryTrashController;
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

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [WebsiteController::class, 'home'])->name('home');

Route::get('about', [WebsiteController::class, 'about'])->name('about');
Route::get('courses', [WebsiteController::class, 'courses'])->name('courses');
Route::get('category/{id}/courses', [WebsiteController::class, 'categoryCourses'])->name('category.courses');
Route::get('subcategory/{id}/courses', [WebsiteController::class, 'subcategoryCourses'])->name('subcategory.courses');
Route::get('course/details/{id}', [WebsiteController::class, 'courseDetails'])->name('course.details');
Route::get('course/{course_id}/video/{module_id?}', [WebsiteController::class, 'courseVideo'])->name('course.video');
Route::get('ajax/course/video/data/{module_id}', [WebsiteController::class, 'ajaxCourseVideoData'])->name('ajax.course.video.data');
Route::get('booking/{id}', [WebsiteController::class, 'booking'])->name('booking');
Route::get('services', [WebsiteController::class, 'services'])->name('services');
Route::get('photogallery', [WebsiteController::class, 'photoGallery'])->name('photo.gallery');
Route::get('videogallery', [WebsiteController::class, 'videoGallery'])->name('video.gallery');
Route::get('news', [WebsiteController::class, 'search'])->name('news.search');
Route::get('news/details/{id}', [WebsiteController::class, 'newsDetails'])->name('news.details');
Route::get('faqs', [WebsiteController::class, 'faq'])->name('faq.page');
Route::get('contacts', [WebsiteController::class, 'contact'])->name('contact.page');
Route::get('product/{slug}', [WebsiteController::class, 'productDetails'])->name('product.details');

Route::get('category/{id}/products', [WebsiteController::class, 'categoryProducts'])->name('category.products');
Route::get('search', [WebsiteController::class, 'searchResults'])->name('search.results');
Route::get('search/suggestions', [WebsiteController::class, 'searchSuggestions'])->name('search.suggestions');

Route::get('bookingSuccess/{id}', [WebsiteController::class, 'bookingSuccess'])->name('booking.success');


Route::prefix('user')->middleware('auth', 'is_user')->group(function(){
    Route::get('/dashboard', [ProfileController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/generalSetting', [ProfileController::class, 'generalSetting'])->name('general.setting');
    Route::post('/general_store', [ProfileController::class, 'generalStore'])->name('general.store');
    Route::get('/personalSetting', [ProfileController::class, 'personalSetting'])->name('personal.setting');
    Route::post('/personal_store', [ProfileController::class, 'personalStore'])->name('personal.store');
    Route::post('myupdate/password', [ProfileController::class, 'updatePassword'])->name('mypostupdate.password');
    Route::post('/logout', [UserLogoutController::class, 'logout'])->name('user.logout');

    Route::post('image/crop',[ProfileImageController::class, 'crop'])->name('image.crop');


    //Testimonial Route
    Route::get('testimonial_view', [FrontendTestimonialController::class, 'testimonialView'])->name('testimonial.view');
    Route::post('testimonial_store', [FrontendTestimonialController::class, 'testimonialStore'])->name('testimonial.store');

});

// Course Review AJAX Routes
Route::get('course-reviews/{course_id}', [\App\Http\Controllers\Frontend\CourseReviewController::class, 'index'])->name('course.reviews.index');
Route::post('course-reviews', [\App\Http\Controllers\Frontend\CourseReviewController::class, 'store'])->name('course.reviews.store')->middleware('auth');

//Comment Route
Route::resource('posts.comments', CommentController::class)->only(['store', 'update', 'destroy'])->middleware('auth');

//Socialite Login Routes
Route::group(['as' => 'login.', 'prefix' => 'login'], function() {
    Route::get('/{provider}', [SocialiteLoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback'])
    ->name('provider.callback');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//Contact Route
Route::post('contact_store', [ContactController::class, 'contactStore'])->name('contacts.store');

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

    //Super Admin, Admin, Moderator Profile Route
    Route::get('/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');


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
    Route::get('/users/system-owner', [UserController::class, 'systemOwner'])->name('users.system-owner');
    Route::get('/users/student', [UserController::class, 'student'])->name('users.student');
    Route::get('/users/teacher', [UserController::class, 'teacher'])->name('users.teacher');

    // Teacher Routes
    Route::post('teachers/update-or-create/{userId}', [TeacherController::class, 'updateOrCreateFromUser'])->name('teachers.update-or-create');
    Route::post('teachers/{id}/assign-courses', [TeacherController::class, 'assignCourses'])->name('teachers.assign-courses');
    Route::delete('teachers/{teacher_id}/remove-course/{course_id}', [TeacherController::class, 'removeCourse'])->name('teachers.remove-course');
    Route::resource('teachers', TeacherController::class);
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

    //Privacy Policy Setting Start
    Route::resource('privacy_policy', PrivacyPolicyController::class);
    //Privacy Policy Setting End

    //Terms & Conditions Setting Start
    Route::resource('terms_and_conditions', TermsAndConditionsController::class);
    //Terms & Conditions Setting End

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
    ->name('photocategory.is_active.ajax');
    Route::get('check/photocategory/is_home/{category_id}', [PhotoCategoryController::class, 'checkActiveHome'])
    ->name('photocategory.is_home.ajax');
    Route::resource('photocategories', PhotoCategoryController::class);

    // Category Route
    Route::get('/categories/trash', [CategoryTrashController::class, 'trash'])->name('categories.trash');
    Route::get('/categories/restore/{id}', [CategoryTrashController::class, 'restore'])
    ->name('categories.restore');
    Route::delete('/categories/forcedelete/{id}', [CategoryTrashController::class, 'forceDelete'])
    ->name('categories.forcedelete');
    // Ajax Call Active
    Route::get('check/category/is_active/{category_id}', [CategoryController::class, 'checkActive'])
    ->name('category.is_active.ajax');
    Route::get('check/category/is_home/{category_id}', [CategoryController::class, 'checkHome'])
    ->name('category.is_home.ajax');
    Route::resource('categories', CategoryController::class);

    // Subcategory Route
    Route::get('/subcategories/trash', [SubcategoryTrashController::class, 'trash'])->name('subcategories.trash');
    Route::get('/subcategories/restore/{id}', [SubcategoryTrashController::class, 'restore'])
    ->name('subcategories.restore');
    Route::delete('/subcategories/forcedelete/{id}', [SubcategoryTrashController::class, 'forceDelete'])
    ->name('subcategories.forcedelete');
    // Ajax Call Active
    Route::get('check/subcategory/is_active/{subcategory_id}', [SubcategoryController::class, 'checkActive'])
    ->name('subcategory.is_active.ajax');
    Route::get('check/subcategory/is_home/{subcategory_id}', [SubcategoryController::class, 'checkHome'])
    ->name('subcategory.is_home.ajax');

    // Ajax Call for getting subcategories by category
    Route::get('get-subcategories/{category_id}', [SubcategoryController::class, 'getSubcategoriesByCategory']);

    Route::resource('subcategories', SubcategoryController::class);

    // Childcategory Route
    Route::get('/childcategories/trash', [ChildcategoryTrashController::class, 'trash'])->name('childcategories.trash');
    Route::get('/childcategories/restore/{id}', [ChildcategoryTrashController::class, 'restore'])
    ->name('childcategories.restore');
    Route::delete('/childcategories/forcedelete/{id}', [ChildcategoryTrashController::class, 'forceDelete'])
    ->name('childcategories.forcedelete');
    // Ajax Call Active
    Route::get('check/childcategory/is_active/{childcategory_id}', [ChildcategoryController::class, 'checkActive'])
    ->name('childcategories.checkActive');
    Route::get('check/childcategory/is_home/{childcategory_id}', [ChildcategoryController::class, 'checkHome'])
    ->name('childcategories.checkHome');

    // Ajax Call for getting childcategories by subcategory
    Route::get('get-childcategories/{subcategory_id}', [ChildcategoryController::class, 'getChildcategories']);

    Route::resource('childcategories', ChildcategoryController::class);

    //Product Route
    Route::get('/products/trash', [ProductTrashController::class, 'trash'])->name('products.trash');
    Route::get('/products/restore/{id}', [ProductTrashController::class, 'restore'])
    ->name('products.restore');
    Route::delete('/products/forcedelete/{id}', [ProductTrashController::class, 'forceDelete'])
    ->name('products.forcedelete');
    // Ajax Call Active
    Route::get('check/product/is_active/{product_id}', [ProductController::class, 'checkActive'])
    ->name('product.is_active.ajax');
    Route::get('check/product/is_home/{product_id}', [ProductController::class, 'checkHome'])
    ->name('product.is_home.ajax');
    // Delete individual image
    Route::delete('/product/image/{id}', [ProductController::class, 'deleteProductImage'])
    ->name('product.image.delete');

    // Get subcategories and childcategories for dependent dropdown
    Route::get('/admin/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('get.subcategories');
    Route::get('/admin/get-childcategories/{subcategoryId}', [ProductController::class, 'getChildcategories'])->name('get.childcategories');

    Route::resource('products', ProductController::class);

    //Course Route
    Route::get('/courses/trash', [CourseTrashController::class, 'trash'])->name('courses.trash');
    Route::get('/courses/restore/{id}', [CourseTrashController::class, 'restore'])
    ->name('courses.restore');
    Route::delete('/courses/forcedelete/{id}', [CourseTrashController::class, 'forceDelete'])
    ->name('courses.forcedelete');
    Route::delete('/course/lesson/{id}', [CourseController::class, 'deleteLesson'])
    ->name('course.lesson.delete');
    Route::post('/course/lesson/{id}/update', [CourseController::class, 'updateLessonAjax'])
    ->name('course.lesson.update.ajax');
    Route::delete('/course/module/{id}', [CourseController::class, 'deleteModule'])
    ->name('course.module.delete');
    Route::post('/course/module/{id}/update', [CourseController::class, 'updateModuleAjax'])
    ->name('course.module.update.ajax');
    // Ajax Call Active
    Route::get('check/course/is_active/{course_id}', [CourseController::class, 'checkActive'])
    ->name('course.is_active.ajax');
    // Get subcategories for dependent dropdown
    Route::get('get-course-subcategories/{categoryId}', [CourseController::class, 'getSubcategories'])
    ->name('course.get.subcategories');
    Route::resource('courses', CourseController::class);

    //Book Route
    Route::get('/books/trash', [BookTrashController::class, 'trash'])->name('books.trash');
    Route::get('/books/restore/{id}', [BookTrashController::class, 'restore'])
    ->name('books.restore');
    Route::delete('/books/forcedelete/{id}', [BookTrashController::class, 'forceDelete'])
    ->name('books.forcedelete');
    // Ajax Call Active
    Route::get('check/book/is_active/{book_id}', [BookController::class, 'checkActive'])
    ->name('book.is_active.ajax');
    // Get subcategories for dependent dropdown
    Route::get('get-book-subcategories/{categoryId}', [BookController::class, 'getSubcategories'])
    ->name('book.get.subcategories');
    Route::resource('books', BookController::class);

    // Book Category Route
    Route::get('/book_categories/trash', [BookCategoryTrashController::class, 'trash'])->name('book_categories.trash');
    Route::get('/book_categories/restore/{id}', [BookCategoryTrashController::class, 'restore'])->name('book_categories.restore');
    Route::delete('/book_categories/forcedelete/{id}', [BookCategoryTrashController::class, 'forceDelete'])->name('book_categories.forcedelete');
    Route::get('check/book_category/is_active/{id}', [BookCategoryController::class, 'checkActive'])->name('book_category.is_active.ajax');
    Route::get('check/book_category/is_home/{id}', [BookCategoryController::class, 'checkHome'])->name('book_category.is_home.ajax');
    Route::resource('book_categories', BookCategoryController::class);

    // Book Subcategory Route
    Route::get('/book_subcategories/trash', [BookSubcategoryTrashController::class, 'trash'])->name('book_subcategories.trash');
    Route::get('/book_subcategories/restore/{id}', [BookSubcategoryTrashController::class, 'restore'])->name('book_subcategories.restore');
    Route::delete('/book_subcategories/forcedelete/{id}', [BookSubcategoryTrashController::class, 'forceDelete'])->name('book_subcategories.forcedelete');
    Route::get('check/book_subcategory/is_active/{id}', [BookSubcategoryController::class, 'checkActive'])->name('book_subcategory.is_active.ajax');
    Route::get('check/book_subcategory/is_home/{id}', [BookSubcategoryController::class, 'checkHome'])->name('book_subcategory.is_home.ajax');
    Route::resource('book_subcategories', BookSubcategoryController::class);

    //PDF Book Route
    Route::get('/pdf_books/trash', [PdfBookTrashController::class, 'trash'])->name('pdf_books.trash');
    Route::get('/pdf_books/restore/{id}', [PdfBookTrashController::class, 'restore'])->name('pdf_books.restore');
    Route::delete('/pdf_books/forcedelete/{id}', [PdfBookTrashController::class, 'forceDelete'])->name('pdf_books.forcedelete');
    Route::get('check/pdf_book/is_active/{book_id}', [PdfBookController::class, 'checkActive'])->name('pdf_book.is_active.ajax');
    Route::get('get-pdf-book-subcategories/{categoryId}', [PdfBookController::class, 'getSubcategories'])->name('pdf_book.get.subcategories');
    Route::resource('pdf_books', PdfBookController::class);

    // PDF Book Category Route
    Route::get('/pdf_book_categories/trash', [PdfBookCategoryTrashController::class, 'trash'])->name('pdf_book_categories.trash');
    Route::get('/pdf_book_categories/restore/{id}', [PdfBookCategoryTrashController::class, 'restore'])->name('pdf_book_categories.restore');
    Route::delete('/pdf_book_categories/forcedelete/{id}', [PdfBookCategoryTrashController::class, 'forceDelete'])->name('pdf_book_categories.forcedelete');
    Route::get('check/pdf_book_category/is_active/{id}', [PdfBookCategoryController::class, 'checkActive'])->name('pdf_book_category.is_active.ajax');
    Route::get('check/pdf_book_category/is_home/{id}', [PdfBookCategoryController::class, 'checkHome'])->name('pdf_book_category.is_home.ajax');
    Route::resource('pdf_book_categories', PdfBookCategoryController::class);

    // PDF Book Subcategory Route
    Route::get('/pdf_book_subcategories/trash', [PdfBookSubcategoryTrashController::class, 'trash'])->name('pdf_book_subcategories.trash');
    Route::get('/pdf_book_subcategories/restore/{id}', [PdfBookSubcategoryTrashController::class, 'restore'])->name('pdf_book_subcategories.restore');
    Route::delete('/pdf_book_subcategories/forcedelete/{id}', [PdfBookSubcategoryTrashController::class, 'forceDelete'])->name('pdf_book_subcategories.forcedelete');
    Route::get('check/pdf_book_subcategory/is_active/{id}', [PdfBookSubcategoryController::class, 'checkActive'])->name('pdf_book_subcategory.is_active.ajax');
    Route::get('check/pdf_book_subcategory/is_home/{id}', [PdfBookSubcategoryController::class, 'checkHome'])->name('pdf_book_subcategory.is_home.ajax');
    Route::resource('pdf_book_subcategories', PdfBookSubcategoryController::class);

    // Exam Category Route
    Route::get('/exam_categories/trash', [ExamCategoryTrashController::class, 'trash'])->name('exam_categories.trash');
    Route::get('/exam_categories/restore/{id}', [ExamCategoryTrashController::class, 'restore'])->name('exam_categories.restore');
    Route::delete('/exam_categories/forcedelete/{id}', [ExamCategoryTrashController::class, 'forceDelete'])->name('exam_categories.forcedelete');
    Route::get('check/exam_category/is_active/{id}', [ExamCategoryController::class, 'checkActive'])->name('exam_category.is_active.ajax');
    Route::resource('exam_categories', ExamCategoryController::class);

    // Exam Route
    Route::get('/exams/trash', [ExamTrashController::class, 'trash'])->name('exams.trash');
    Route::get('/exams/restore/{id}', [ExamTrashController::class, 'restore'])->name('exams.restore');
    Route::delete('/exams/forcedelete/{id}', [ExamTrashController::class, 'forceDelete'])->name('exams.forceDelete');
    Route::get('check/exam/is_active/{id}', [ExamController::class, 'checkActive'])->name('exam.is_active.ajax');
    Route::resource('exams', ExamController::class);

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


    //Post Category Route
    Route::get('/postcategories/trash', [PostCategoryTrashController::class, 'trash'])->name('postcategories.trash');
    Route::get('/postcategories/restore/{id}', [PostCategoryTrashController::class, 'restore'])
    ->name('postcategories.restore');
    Route::delete('/postcategories/forcedelete/{id}', [PostCategoryTrashController::class, 'forceDelete'])
    ->name('postcategories.forcedelete');
    // Ajax Call Active
    Route::get('check/postcategory/is_active/{category_id}', [PostCategoryController::class, 'checkActiveActive'])
    ->name('postcategory.is_active.ajax');
    Route::get('check/postcategory/is_home/{category_id}', [PostCategoryController::class, 'checkActiveHome'])
    ->name('postcategory.is_home.ajax');
    Route::resource('postcategories', PostCategoryController::class);

    //Post Route
    Route::get('/posts/trash', [PostTrashController::class, 'trash'])->name('posts.trash');
    Route::get('/posts/restore/{id}', [PostTrashController::class, 'restore'])
    ->name('posts.restore');
    Route::delete('/posts/forcedelete/{id}', [PostTrashController::class, 'forceDelete'])
    ->name('posts.forcedelete');
    // Ajax Call Active
    Route::get('check/post/is_active/{post_id}', [PostController::class, 'checkActiveActive'])
    ->name('post.is_active.ajax');
    Route::get('check/post/is_home/{post_id}', [PostController::class, 'checkActiveHome'])
    ->name('post.is_home.ajax');
    Route::resource('posts', PostController::class);

    //FAQ Route
    Route::get('/faqs/trash', [FaqTrashController::class, 'trash'])->name('faqs.trash');
    Route::get('/faqs/restore/{id}', [FaqTrashController::class, 'restore'])
    ->name('faqs.restore');
    Route::delete('/faqs/forcedelete/{id}', [FaqTrashController::class, 'forceDelete'])
    ->name('faqs.forcedelete');
    Route::resource('faqs', FaqController::class);

    //Contact Route
    Route::resource('contact', BackendContactController::class);

    // Course Review Route
    Route::get('course-reviews/toggle-approval/{id}', [AdminReviewController::class, 'toggleApproval'])->name('course-reviews.toggle-approval');
    Route::resource('course-reviews', AdminReviewController::class)->only(['index', 'update', 'destroy']);

});

// OTP Routes for password reset
Route::get('/forgot-password', [OtpController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [OtpController::class, 'sendOtp'])->name('password.email');
Route::get('/otp/verify', [OtpController::class, 'showVerifyOtpForm'])->name('otp.verify.form');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
Route::get('/reset-password', [OtpController::class, 'showResetPasswordForm'])->name('password.reset.form');
Route::post('/reset-password', [OtpController::class, 'resetPassword'])->name('password.update');
