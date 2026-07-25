<?php

use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\AdminReviewController;
use App\Http\Controllers\Backend\AwardController;
use App\Http\Controllers\Backend\BatchController;
use App\Http\Controllers\Backend\BookCategoryController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\BookOrderController;
use App\Http\Controllers\Backend\BookSubcategoryController;
use App\Http\Controllers\Backend\BreadcrumbController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildcategoryController;
use App\Http\Controllers\Backend\ContactController as BackendContactController;
use App\Http\Controllers\Backend\CopyrightController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CorevalueController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseOrderController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\ExamCategoryController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\ExamResultController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\Backend\HomeSliderController;
use App\Http\Controllers\Backend\HowweworkController;
use App\Http\Controllers\Backend\InstructorCommissionController;
use App\Http\Controllers\Backend\InstructorEarningsController;
use App\Http\Controllers\Backend\InstructorRequestController;
use App\Http\Controllers\Backend\InstructorWithdrawalController;
use App\Http\Controllers\Backend\LogoFaviconController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\NewsCategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PdfBookCategoryController;
use App\Http\Controllers\Backend\PdfBookController;
use App\Http\Controllers\Backend\PdfBookOrderController;
use App\Http\Controllers\Backend\PdfBookSubcategoryController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PhotoCategoryController;
use App\Http\Controllers\Backend\PhotoGalleryController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PrivacyPolicyController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductSubcategoryController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CompanyOverviewController;
use App\Http\Controllers\Backend\AchievementSectionController;
use App\Http\Controllers\Backend\MissionVisionController;
use App\Http\Controllers\Backend\StoryofgrowthController;
use App\Http\Controllers\Backend\ServiceConsultationController as BackendServiceConsultationController;
use App\Http\Controllers\Backend\ServiceConsultationTimeslotController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\ServicetwocategoryController;
use App\Http\Controllers\Backend\ServicetwoController;
use App\Http\Controllers\Backend\ServicetwoSubcategoryController;
use App\Http\Controllers\Backend\ShurjopayAPIController;
use App\Http\Controllers\Backend\SSLCommerzAPIController;
use App\Http\Controllers\Backend\StuffController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TermsAndConditionsController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\WebsiteLinkController;
use App\Http\Controllers\Backend\WhatyougetController;
use App\Http\Controllers\Backend\WhychooseusController;
use App\Http\Controllers\Frontend\BookPaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CourseController as FrontendCourseController;
use App\Http\Controllers\Frontend\CoursePaymentController;
use App\Http\Controllers\Frontend\CourseReviewController;
use App\Http\Controllers\Frontend\ExamController as FrontendExamController;
use App\Http\Controllers\Frontend\InstructorRequestController as FrontendInstructorRequestController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\PDFBookController as FrontendPDFBookController;
use App\Http\Controllers\Frontend\PdfBookPaymentController;
use App\Http\Controllers\Frontend\PhysicalBookController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProfileImageController;
use App\Http\Controllers\Frontend\ServiceConsultationController;
use App\Http\Controllers\Frontend\ShurjopayBookController;
use App\Http\Controllers\Frontend\ShurjopayCourseController;
use App\Http\Controllers\Frontend\ShurjopayPdfController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\Frontend\UserLogoutController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Trash\AwardTrashController;
use App\Http\Controllers\Trash\BookCategoryTrashController;
use App\Http\Controllers\Trash\BookSubcategoryTrashController;
use App\Http\Controllers\Trash\BookTrashController;
use App\Http\Controllers\Trash\CategoryTrashController;
use App\Http\Controllers\Trash\ChildcategoryTrashController;
use App\Http\Controllers\Trash\CouponTrashController;
use App\Http\Controllers\Trash\CourseTrashController;
use App\Http\Controllers\Trash\DepartmentTrashController;
use App\Http\Controllers\Trash\ExamCategoryTrashController;
use App\Http\Controllers\Trash\ExamTrashController;
use App\Http\Controllers\Trash\FaqTrashController;
use App\Http\Controllers\Trash\ModuleTrashController;
use App\Http\Controllers\Trash\NewsTrashController;
use App\Http\Controllers\Trash\PdfBookCategoryTrashController;
use App\Http\Controllers\Trash\PdfBookSubcategoryTrashController;
use App\Http\Controllers\Trash\PdfBookTrashController;
use App\Http\Controllers\Trash\PermissionTrashController;
use App\Http\Controllers\Trash\PhotoCategoryTrashController;
use App\Http\Controllers\Trash\PhotoGalleryTrashController;
use App\Http\Controllers\Trash\PostCategoryTrashController;
use App\Http\Controllers\Trash\PostTrashController;
use App\Http\Controllers\Trash\ProductTrashController;
use App\Http\Controllers\Trash\QuestionTrashController;
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

// General Website Routes
Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('about', [WebsiteController::class, 'about'])->name('about');
Route::get('services', [WebsiteController::class, 'services'])->name('services');
Route::get('photogallery', [WebsiteController::class, 'photoGallery'])->name('photo.gallery');
Route::get('videogallery', [WebsiteController::class, 'videoGallery'])->name('video.gallery');
Route::get('blogs', [WebsiteController::class, 'search'])->name('news.search');
Route::get('blogs/details/{id}', [WebsiteController::class, 'newsDetails'])->name('news.details');
Route::get('faqs', [WebsiteController::class, 'faq'])->name('faq.page');
Route::get('contacts', [WebsiteController::class, 'contact'])->name('contact.page');
Route::get('mentors', [WebsiteController::class, 'mentors'])->name('mentors');
Route::get('verify-certificate', [WebsiteController::class, 'verifyCertificate'])->name('verify.certificate');
Route::post('verify-certificate', [WebsiteController::class, 'checkCertificate'])->name('check.certificate');
Route::get('service/category/{id}', [WebsiteController::class, 'serviceCategory'])->name('service.category');
Route::get('service/details/{id}', [WebsiteController::class, 'serviceDetails'])->name('service.details');
Route::get('service/track/{service}', [WebsiteController::class, 'trackServiceClick'])->name('service.track');
Route::get('service/subcategory/{id}', [WebsiteController::class, 'serviceSubcategory'])->name('service.subcategory');
Route::post('service/consultations', [ServiceConsultationController::class, 'store'])->name('service.consultations.store');

// Course Routes
Route::get('courses', [FrontendCourseController::class, 'courses'])->name('courses');
Route::get('academy', [FrontendCourseController::class, 'academy'])->name('academy');
Route::get('category/{id}/courses', [FrontendCourseController::class, 'categoryCourses'])->name('category.courses');
Route::get('subcategory/{id}/courses', [FrontendCourseController::class, 'subcategoryCourses'])->name('subcategory.courses');
Route::get('course/details/{id}', [FrontendCourseController::class, 'courseDetails'])->name('course.details');
Route::get('course/{course_id}/video/{module_id?}', [FrontendCourseController::class, 'courseVideo'])->name('course.video');
Route::post('course/video/inspect-logout', [FrontendCourseController::class, 'inspectLogout'])->name('course.video.inspect-logout')->middleware('auth');
Route::get('course/{course_id}/exam/{exam_id}/start', [FrontendExamController::class, 'startExam'])->name('frontend.exam.start');
Route::post('exam/{exam_id}/submit', [FrontendExamController::class, 'submitExam'])->name('frontend.exam.submit');
Route::get('ajax/course/video/data/{module_id}', [FrontendCourseController::class, 'ajaxCourseVideoData'])->name('ajax.course.video.data');
Route::post('course/mark-as-completed', [FrontendCourseController::class, 'markAsCompleted'])->name('course.mark-as-completed')->middleware('auth');
Route::get('ajax/live-class-notifications', [FrontendCourseController::class, 'getLiveClassNotifications'])->name('ajax.live-class-notifications')->middleware('auth');

// Book Routes
Route::get('books', [PhysicalBookController::class, 'books'])->name('books');
Route::get('book/details/{id}', [PhysicalBookController::class, 'bookDetails'])->name('book.details');
Route::get('book/category/{slug}', [PhysicalBookController::class, 'bookCategory'])->name('book.category');
Route::get('book/subcategory/{slug}', [PhysicalBookController::class, 'bookSubcategory'])->name('book.subcategory');

// PDF Books Routes
Route::get('pdf-books', [FrontendPDFBookController::class, 'pdfBooks'])->name('pdf.books');
Route::get('pdf-book/details/{id}', [FrontendPDFBookController::class, 'pdfBookDetails'])->name('pdf.book.details');
Route::get('pdf-book/category/{slug}', [FrontendPDFBookController::class, 'pdfBookCategory'])->name('pdf.book.category');
Route::get('pdf-book/subcategory/{slug}', [FrontendPDFBookController::class, 'pdfBookSubcategory'])->name('pdf.book.subcategory');

Route::get('products', [WebsiteController::class, 'products'])->name('products');
Route::get('category/{id}/products', [WebsiteController::class, 'categoryProducts'])->name('category.products');
Route::get('subcategory/{id}/products', [WebsiteController::class, 'subcategoryProducts'])->name('subcategory.products');
Route::get('product/{slug}', [WebsiteController::class, 'productDetails'])->name('product.details');
Route::get('search', [WebsiteController::class, 'searchResults'])->name('search.results');
Route::get('search/suggestions', [WebsiteController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('checkout', [CartController::class, 'processCheckout'])->name('cart.checkout.process');
Route::get('checkout/success', [CartController::class, 'success'])->name('cart.checkout.success');
// Teachers listing (frontend)
Route::get('teachers', [WebsiteController::class, 'teachers'])->name('teachers');
// Teacher details (frontend)
Route::get('teacher/{id}', [WebsiteController::class, 'teacherDetails'])->name('teacher.show');

// News Routes (Frontend)
Route::get('news-list', [FrontendNewsController::class, 'index'])->name('frontend.news.index');
Route::get('news/{id}', [FrontendNewsController::class, 'show'])->name('frontend.news.show');
Route::get('news/search', [FrontendNewsController::class, 'search'])->name('frontend.news.search');



Route::prefix('user')->middleware(['auth', 'is_user'])->group(function(){
    Route::get('/dashboard', [ProfileController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/posts/create', [ProfileController::class, 'createPost'])->name('user.posts.create');
    Route::post('/posts/store', [ProfileController::class, 'storePost'])->name('user.posts.store');

    // News Routes (User submission)
    Route::get('/news/create', [FrontendNewsController::class, 'create'])->name('frontend.news.create');
    Route::post('/news/store', [FrontendNewsController::class, 'store'])->name('frontend.news.store');
    Route::get('/generalSetting', [ProfileController::class, 'generalSetting'])->name('general.setting');
    Route::post('/general_store', [ProfileController::class, 'generalStore'])->name('general.store');
    Route::get('/personalSetting', [ProfileController::class, 'personalSetting'])->name('personal.setting');
    Route::get('/aboutMe', [ProfileController::class, 'aboutMe'])->name('user.about.me');
    Route::post('/personal_store', [ProfileController::class, 'personalStore'])->name('personal.store');
    Route::post('myupdate/password', [ProfileController::class, 'updatePassword'])->name('mypostupdate.password');
    Route::get('/my-courses', [ProfileController::class, 'myCourses'])->name('my.courses');
    Route::get('/course-orders', [ProfileController::class, 'courseOrders'])->name('user.course.orders');
    Route::get('/course-order/{order}', [ProfileController::class, 'courseOrderDetails'])->name('course.order.details');
    Route::get('/product-orders', [ProfileController::class, 'productOrders'])->name('user.product.orders');
    Route::get('/product-order/{order}', [ProfileController::class, 'productOrderDetails'])->name('product.order.details');
    Route::get('/book-orders', [ProfileController::class, 'bookOrders'])->name('user.book.orders');
    Route::get('/book-order/{order}', [ProfileController::class, 'bookOrderDetails'])->name('book.order.details');
    Route::get('/pdf-book-orders', [ProfileController::class, 'pdfBookOrders'])->name('user.pdf.book.orders');
    Route::get('/pdf-book-order/{order}', [ProfileController::class, 'pdfBookOrderDetails'])->name('pdf.book.order.details');
    Route::post('/logout', [UserLogoutController::class, 'logout'])->name('user.logout');

    Route::post('image/crop',[ProfileImageController::class, 'crop'])->name('image.crop');

    // Certificate Routes
    Route::get('/certificates', [ProfileController::class, 'myCertificates'])->name('user.certificates');
    Route::post('/certificates/apply', [ProfileController::class, 'applyCertificate'])->name('certificates.apply');
    Route::get('/certificates/{certificate}', [ProfileController::class, 'certificateDetails'])->name('certificate.details');

    // Instructor Request Routes
    Route::post('/request-instructor', [FrontendInstructorRequestController::class, 'store'])->name('instructor.request.store');
    Route::post('/cancel-instructor-request', [FrontendInstructorRequestController::class, 'cancel'])->name('instructor.request.cancel');

    //Testimonial Route
    Route::get('testimonial_view', [FrontendTestimonialController::class, 'testimonialView'])->name('testimonial.view');
    Route::post('testimonial_store', [FrontendTestimonialController::class, 'testimonialStore'])->name('testimonial.store');

    // Exam Result Routes
    Route::get('exam/result/{id}', [FrontendExamController::class, 'viewResult'])->name('user.exam.result');

    // Course Payment Routes (SSLCommerz)
    Route::get('/checkout/{course_id}', [CoursePaymentController::class, 'checkoutPage'])->name('checkout');
    Route::post('/course/process-payment', [CoursePaymentController::class, 'checkout'])->name('course.payment.process');
    Route::get('/course/payment/success', [CoursePaymentController::class, 'success'])->name('course.payment.success');
    Route::get('/course/payment/fail', [CoursePaymentController::class, 'fail'])->name('course.payment.fail');
    Route::get('/course/payment/cancel', [CoursePaymentController::class, 'cancel'])->name('course.payment.cancel');
    Route::get('/course/thankyou/{order_id}', [CoursePaymentController::class, 'thankyou'])->name('course.payment.thankyou');
    Route::post('/validate-coupon', [CoursePaymentController::class, 'validateCoupon'])->name('coupon.validate');

    // Course Payment Routes (ShurjoPay)
    Route::post('/course/shurjopay-payment', [ShurjopayCourseController::class, 'checkout'])->name('course.shurjopay.payment');
    Route::get('/course/shurjopay/success', [ShurjopayCourseController::class, 'success'])->name('course.shurjopay.success');
    Route::get('/course/shurjopay/cancel', [ShurjopayCourseController::class, 'cancel'])->name('course.shurjopay.cancel');

    // Book Payment Routes (SSLCommerz)
    Route::get('/book/checkout/{book_id}', [BookPaymentController::class, 'checkoutPage'])->name('book.checkout');
    Route::post('/book/process-payment', [BookPaymentController::class, 'checkout'])->name('book.payment.process');
    Route::get('/book/payment/success', [BookPaymentController::class, 'success'])->name('book.payment.success');
    Route::get('/book/payment/fail', [BookPaymentController::class, 'fail'])->name('book.payment.fail');
    Route::get('/book/payment/cancel', [BookPaymentController::class, 'cancel'])->name('book.payment.cancel');
    Route::get('/book/thankyou/{order_id}', [BookPaymentController::class, 'thankyou'])->name('book.payment.thankyou');

    // Book Payment Routes (ShurjoPay)
    Route::post('/book/shurjopay-payment', [ShurjopayBookController::class, 'bookCheckout'])->name('book.shurjopay.payment');
    Route::get('/book/shurjopay/success', [ShurjopayBookController::class, 'bookSuccess'])->name('book.shurjopay.success');
    Route::get('/book/shurjopay/cancel', [ShurjopayBookController::class, 'bookCancel'])->name('book.shurjopay.cancel');

    // PDF Book Payment Routes (SSLCommerz)
    Route::get('/pdf-book/checkout/{book_id}', [PdfBookPaymentController::class, 'checkoutPage'])->name('pdf.book.checkout');
    Route::post('/pdf-book/process-payment', [PdfBookPaymentController::class, 'checkout'])->name('pdf.book.payment.process');
    Route::get('/pdf-book/payment/success', [PdfBookPaymentController::class, 'success'])->name('pdf.book.payment.success');
    Route::get('/pdf-book/payment/fail', [PdfBookPaymentController::class, 'fail'])->name('pdf.book.payment.fail');
    Route::get('/pdf-book/payment/cancel', [PdfBookPaymentController::class, 'cancel'])->name('pdf.book.payment.cancel');
    Route::get('/pdf-book/thankyou/{order_id}', [PdfBookPaymentController::class, 'thankyou'])->name('pdf.book.payment.thankyou');

    // PDF Book Payment Routes (ShurjoPay)
    Route::post('/pdf-book/shurjopay-payment', [ShurjopayPdfController::class, 'pdfBookCheckout'])->name('pdf.book.shurjopay.payment');
    Route::get('/pdf-book/shurjopay/success', [ShurjopayPdfController::class, 'pdfBookSuccess'])->name('pdf.book.shurjopay.success');
    Route::get('/pdf-book/shurjopay/cancel', [ShurjopayPdfController::class, 'pdfBookCancel'])->name('pdf.book.shurjopay.cancel');
});

// Course Review AJAX Routes
Route::get('course-reviews/{course_id}', [CourseReviewController::class, 'index'])->name('course.reviews.index');
Route::post('course-reviews', [CourseReviewController::class, 'store'])->name('course.reviews.store')->middleware('auth');

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

// Course Payment Routes (SSLCommerz)
Route::post('/sslcommerz/ipn', [CoursePaymentController::class, 'ipn']);

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function(){

    Route::get('/login', [AdminLoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function(){
    Route::get('/dashboard', [BackendHomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');

    //Super Admin, Admin, Moderator Profile Route
    Route::get('/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/profile', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');

    // Enrollment Order Routes
    Route::prefix('orders')->group(function () {
        Route::get('course-enrollment/manual', [CourseOrderController::class, 'manualEnroll'])->name('orders.course_enrollment.manual');
        // AJAX: return enrolled course ids for a user (used by manual enrollment form)
        Route::get('user/{user_id}/enrolled-courses', [CourseOrderController::class, 'getEnrolledCourses'])
            ->name('orders.user.enrolled_courses');
        Route::post('course-enrollment/manual', [CourseOrderController::class, 'manualEnrollConfirm'])->name('orders.course_enrollment.manual_confirm');
        Route::get('course-enrollment', [CourseOrderController::class, 'index'])->name('orders.course_enrollment');
        Route::get('course-enrollment/live', [CourseOrderController::class, 'liveIndex'])->name('orders.course_enrollment.live');
        Route::get('course-enrollment/recorded', [CourseOrderController::class, 'recordedIndex'])->name('orders.course_enrollment.recorded');
        Route::get('course-enrollment/{id}/edit', [CourseOrderController::class, 'edit'])->name('orders.course_enrollment.edit');
        Route::put('course-enrollment/{id}', [CourseOrderController::class, 'update'])->name('orders.course_enrollment.update');
        Route::delete('course-enrollment/{id}', [CourseOrderController::class, 'destroy'])->name('orders.course_enrollment.destroy');

        Route::get('book-orders', [BookOrderController::class, 'index'])->name('orders.bookorders');
        Route::get('book-orders/{id}/edit', [BookOrderController::class, 'edit'])->name('orders.bookorders.edit');
        Route::put('book-orders/{id}', [BookOrderController::class, 'update'])->name('orders.bookorders.update');
        Route::delete('book-orders/{id}', [BookOrderController::class, 'destroy'])->name('orders.bookorders.destroy');

        Route::get('pdf-book-orders', [PdfBookOrderController::class, 'index'])->name('orders.pdfbookorders');
        Route::get('pdf-book-orders/{id}/edit', [PdfBookOrderController::class, 'edit'])->name('orders.pdfbookorders.edit');
        Route::put('pdf-book-orders/{id}', [PdfBookOrderController::class, 'update'])->name('orders.pdfbookorders.update');
        Route::delete('pdf-book-orders/{id}', [PdfBookOrderController::class, 'destroy'])->name('orders.pdfbookorders.destroy');
    });

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
    Route::get('/users/blocked', [UserController::class, 'blockedUsers'])->name('users.blocked');
    Route::delete('/users/unblock/{id}', [UserController::class, 'unblockUser'])->name('users.unblock');
    Route::post('/users/block-manual', [UserController::class, 'blockManual'])->name('users.block-manual');

    // Teacher Routes
    Route::post('teachers/update-or-create/{userId}', [TeacherController::class, 'updateOrCreateFromUser'])->name('teachers.update-or-create');
    Route::post('teachers/{id}/assign-courses', [TeacherController::class, 'assignCourses'])->name('teachers.assign-courses');
    Route::delete('teachers/{teacher_id}/remove-course/{course_id}', [TeacherController::class, 'removeCourse'])->name('teachers.remove-course');
    Route::resource('teachers', TeacherController::class);
    // Batch Routes (batch-course many-to-many)
    Route::post('batches/{id}/assign-courses', [BatchController::class, 'assignCourses'])->name('batches.assign-courses');
    Route::delete('batches/{batch_id}/remove-course/{course_id}', [BatchController::class, 'removeCourse'])->name('batches.remove-course');
    Route::resource('batches', BatchController::class);
    // Ajax Call Active for Batches
    Route::get('check/batch/is_active/{batch_id}', [BatchController::class, 'checkActive'])
        ->name('batch.is_active.ajax');
    Route::get('/users/trash', [UserTrashController::class, 'trash'])->name('users.trash');
    Route::get('/users/restore/{id}', [UserTrashController::class, 'restore'])
    ->name('users.restore');
    Route::delete('/users/forcedelete/{id}', [UserTrashController::class, 'forceDelete'])
    ->name('users.forcedelete');
    // Ajax Call Active
    Route::get('check/user/is_active/{user_id}', [UserController::class, 'checkActive'])
        ->name('user.is_active.ajax');

    // Admin certificate management
    Route::get('certificates', [AdminCertificateController::class, 'index'])->name('certificates.index');
    Route::get('certificates/{certificate}', [AdminCertificateController::class, 'show'])->name('certificates.show');
    Route::post('certificates/{certificate}/approve', [AdminCertificateController::class, 'approve'])->name('certificates.approve');
    Route::post('certificates/{certificate}/reject', [AdminCertificateController::class, 'reject'])->name('certificates.reject');
    Route::delete('certificates/{certificate}', [AdminCertificateController::class, 'destroy'])->name('certificates.destroy');

    Route::resource('/users', UserController::class);

    // Instructor Request Routes
    Route::get('instructor-requests', [InstructorRequestController::class, 'index'])->name('instructor-requests.index');
    Route::get('instructor-requests/{id}', [InstructorRequestController::class, 'show'])->name('instructor-requests.show');
    Route::post('instructor-requests/{id}/approve', [InstructorRequestController::class, 'approve'])->name('instructor-requests.approve');
    Route::post('instructor-requests/{id}/reject', [InstructorRequestController::class, 'reject'])->name('instructor-requests.reject');

    // Page Route
    Route::resource('/pages', PageController::class);

    /*
    | General Setting Start                    |
    |------------------------------------------|
    */

    // Logo_Favicon Route
    Route::resource('logo_fav', LogoFaviconController::class);

    // SSLCommerz Setting Route
    Route::get('sslcommerz-settings', [SSLCommerzAPIController::class, 'index'])->name('sslcommerz.index');
    Route::post('sslcommerz-settings', [SSLCommerzAPIController::class, 'store'])->name('sslcommerz.store');

    // Shurjopay Setting Route
    Route::get('shurjopay-settings', [ShurjopayAPIController::class, 'index'])->name('shurjopay.index');
    Route::post('shurjopay-settings', [ShurjopayAPIController::class, 'store'])->name('shurjopay.store');

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
    Route::resource('company_overview', CompanyOverviewController::class);
    Route::resource('achievement_section', AchievementSectionController::class);
    Route::resource('mission_vision', MissionVisionController::class);
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

    //Service Two Category Route
    Route::get('check/servicetwocategory/is_active/{category_id}', [ServicetwocategoryController::class, 'checkActive'])
    ->name('servicetwocategory.is_active.ajax');
    Route::post('servicetwocategories/update-order', [ServicetwocategoryController::class, 'updateOrder'])
    ->name('servicetwocategories.update_order');
    Route::resource('servicetwocategories', ServicetwocategoryController::class);

    //Service Two Route
    Route::get('check/servicetwo/is_active/{service_id}', [ServicetwoController::class, 'checkActive'])
    ->name('servicetwo.is_active.ajax');
    Route::resource('servicetwos', ServicetwoController::class);

    //Service Consultation Timeslot Routes
    Route::get('check/service-consultation-timeslot/is_active/{timeslot_id}', [ServiceConsultationTimeslotController::class, 'checkActive'])
        ->name('service_consultation_timeslot.is_active.ajax');
    Route::resource('service_consultation_timeslots', ServiceConsultationTimeslotController::class);

    //Service Consultation Routes
    Route::get('check/service-consultation/is_active/{consultation_id}', [BackendServiceConsultationController::class, 'checkActive'])
        ->name('service_consultations.is_active.ajax');
    Route::resource('service_consultations', BackendServiceConsultationController::class);
    Route::get('service-clicks', [BackendHomeController::class, 'serviceClickTracking'])->name('service.clicks');

    //Service Two Subcategory Route
    Route::get('check/servicetwosubcategory/is_active/{subcategory_id}', [ServicetwoSubcategoryController::class, 'checkActive'])
    ->name('servicetwosubcategory.is_active.ajax');
    Route::get('servicetwo/get-subcategories/{category_id}', [ServicetwoSubcategoryController::class, 'getSubcategories'])
    ->name('servicetwo.get.subcategories');
    Route::resource('servicetwosubcategories', ServicetwoSubcategoryController::class);

    Route::resource('partners', PartnerController::class);
// AJAX toggle active status for partners
Route::get('check/partner/is_active/{id}', [PartnerController::class, 'checkActive'])->name('partner.is_active.ajax');

    //How We Work Route
    Route::get('check/corevalue/is_active/{id}', [CorevalueController::class, 'checkActive'])
    ->name('corevalue.is_active.ajax');
    Route::resource('corevalues', CorevalueController::class);

    Route::get('check/howwework/is_active/{id}', [HowweworkController::class, 'checkActive'])
    ->name('howwework.is_active.ajax');
    Route::resource('howweworks', HowweworkController::class);

    //What You Get Route
    Route::get('check/whatyouget/is_active/{id}', [WhatyougetController::class, 'checkActive'])
    ->name('whatyouget.is_active.ajax');
    Route::resource('whatyougets', WhatyougetController::class);

    //Why Choose Us Route
    Route::get('check/whychooseus/is_active/{id}', [WhychooseusController::class, 'checkActive'])
    ->name('whychooseus.is_active.ajax');
    Route::resource('whychooseuses', WhychooseusController::class);

    //Story of Growth Route
    Route::get('storyofgrowths', [StoryofgrowthController::class, 'index'])->name('storyofgrowths.index');
    Route::post('storyofgrowths', [StoryofgrowthController::class, 'store'])->name('storyofgrowths.store');
    Route::get('storyofgrowths/{storyofgrowth}/edit', [StoryofgrowthController::class, 'edit'])->name('storyofgrowths.edit');
    Route::put('storyofgrowths/{storyofgrowth}', [StoryofgrowthController::class, 'update'])->name('storyofgrowths.update');
    Route::delete('storyofgrowths/{storyofgrowth}', [StoryofgrowthController::class, 'destroy'])->name('storyofgrowths.destroy');

    //Coupon Route
    Route::get('/coupons/trash', [CouponTrashController::class, 'trash'])->name('coupons.trash');
    Route::get('/coupons/restore/{id}', [CouponTrashController::class, 'restore'])
    ->name('coupons.restore');
    Route::delete('/coupons/forcedelete/{id}', [CouponTrashController::class, 'forceDelete'])
    ->name('coupons.forcedelete');
    // Ajax Call Active
    Route::get('check/coupon/is_active/{coupon_id}', [CouponController::class, 'checkActive'])
    ->name('coupon.is_active.ajax');
    Route::resource('coupons', CouponController::class);


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

    // Instructor Commission Negotiation Route
    Route::resource('commissions', InstructorCommissionController::class)->except(['show']);
    Route::get('instructor-earnings', [InstructorEarningsController::class, 'index'])->name('instructor.earnings');
    Route::get('instructor-earnings/{teacher_id}', [InstructorEarningsController::class, 'show'])->name('instructor.earnings.details');
    Route::get('instructor-withdrawals', [InstructorWithdrawalController::class, 'index'])->name('instructor.withdrawals.index');
    Route::post('instructor-withdrawals', [InstructorWithdrawalController::class, 'store'])->name('instructor.withdrawals.store');
    Route::post('instructor-withdrawals/{id}/approve', [InstructorWithdrawalController::class, 'approve'])->name('instructor.withdrawals.approve');
    Route::post('instructor-withdrawals/{id}/reject', [InstructorWithdrawalController::class, 'reject'])->name('instructor.withdrawals.reject');

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

    // Product Category Route
    Route::get('check/product/category/is_active/{category_id}', [ProductCategoryController::class, 'checkActive'])
        ->name('product_category.is_active.ajax');
    Route::get('check/product/category/is_home/{category_id}', [ProductCategoryController::class, 'checkHome'])
        ->name('product_category.is_home.ajax');
    Route::resource('product_categories', ProductCategoryController::class);

    // Product Subcategory Route
    Route::get('check/product/subcategory/is_active/{subcategory_id}', [ProductSubcategoryController::class, 'checkActive'])
        ->name('product_subcategory.is_active.ajax');
    Route::get('check/product/subcategory/is_home/{subcategory_id}', [ProductSubcategoryController::class, 'checkHome'])
        ->name('product_subcategory.is_home.ajax');
    Route::get('product-subcategories/by-category/{categoryId}', [ProductSubcategoryController::class, 'getSubcategories'])
        ->name('product_subcategory.get_by_category');
    Route::resource('product_subcategories', ProductSubcategoryController::class);

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
    Route::post('/course/lessons/update-order', [CourseController::class, 'updateLessonsOrder'])
    ->name('course.lessons.update_order');
    Route::delete('/course/module/{id}', [CourseController::class, 'deleteModule'])
    ->name('course.module.delete');
    Route::post('/course/module/{id}/update', [CourseController::class, 'updateModuleAjax'])
    ->name('course.module.update.ajax');
    Route::post('/course/modules/update-order', [CourseController::class, 'updateModulesOrder'])
    ->name('course.modules.update_order');
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

    // Award Route
    // Ajax Call Active
    Route::get('check/award/is_active/{award_id}', [AwardController::class, 'checkActive'])
        ->name('award.is_active.ajax');
    Route::get('/awards/trash', [AwardTrashController::class, 'trash'])->name('awards.trash');
    Route::get('/awards/restore/{id}', [AwardTrashController::class, 'restore'])->name('awards.restore');
    Route::delete('/awards/forcedelete/{id}', [AwardTrashController::class, 'forceDelete'])->name('awards.forcedelete');
    Route::resource('awards', AwardController::class);

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
    Route::get('/exams/{id}/questions', [ExamController::class, 'assignedQuestions'])->name('exams.questions');
    Route::get('/exams/{id}/results', [ExamController::class, 'examResults'])->name('exams.results');
    Route::post('/exams/unassign-questions', [ExamController::class, 'unassignQuestions'])->name('exams.questions.unassign');
    Route::resource('exams', ExamController::class);

    // Exam Results Route
    Route::get('/exam-results', [ExamResultController::class, 'index'])->name('exam_results.index');
    Route::get('/exam-results/{id}', [ExamResultController::class, 'show'])->name('exam_results.show');
    Route::get('/exam-results/{id}/grade', [ExamResultController::class, 'grade'])->name('exam_results.grade');
    Route::post('/exam-results/{id}/update-grades', [ExamResultController::class, 'updateGrades'])->name('exam_results.update_grades');
    Route::delete('/exam-results/{id}', [ExamResultController::class, 'destroy'])->name('exam_results.destroy');
    Route::get('/exam-results/{examId}/statistics', [ExamResultController::class, 'statistics'])->name('exam_results.statistics');

    // Question Route
    Route::get('/questions/trash', [QuestionTrashController::class, 'trash'])->name('questions.trash');
    Route::get('/questions/restore/{id}', [QuestionTrashController::class, 'restore'])->name('questions.restore');
    Route::delete('/questions/forcedelete/{id}', [QuestionTrashController::class, 'forceDelete'])->name('questions.forceDelete');
    Route::get('check/question/is_active/{id}', [QuestionController::class, 'checkActive'])->name('question.is_active.ajax');
    Route::get('/questions/csv/import', [QuestionController::class, 'csvImportForm'])->name('questions.csv.import');
    Route::post('/questions/csv/import', [QuestionController::class, 'csvImport'])->name('questions.csv.import.store');
    Route::get('/questions/csv/sample', [QuestionController::class, 'csvSample'])->name('questions.csv.sample');
    Route::post('/questions/assign-to-exam', [QuestionController::class, 'assignToExam'])->name('questions.assign_to_exam');
    Route::resource('questions', QuestionController::class);

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

    //News Category Route
    Route::get('/newscategories/trash', [NewsTrashController::class, 'trash'])->name('newscategories.trash');
    Route::get('/newscategories/restore/{id}', [NewsTrashController::class, 'restore'])
    ->name('newscategories.restore');
    Route::delete('/newscategories/forcedelete/{id}', [NewsTrashController::class, 'forceDelete'])
    ->name('newscategories.forcedelete');
    // Ajax Call Active
    Route::get('check/newscategory/is_active/{category_id}', [NewsCategoryController::class, 'checkActiveActive'])
    ->name('newscategory.is_active.ajax');
    Route::get('check/newscategory/is_home/{category_id}', [NewsCategoryController::class, 'checkActiveHome'])
    ->name('newscategory.is_home.ajax');
    Route::resource('newscategories', NewsCategoryController::class);

    //News Route
    Route::get('/news/trash', [NewsTrashController::class, 'trash'])->name('admin.news.trash');
    Route::get('/news/restore/{id}', [NewsTrashController::class, 'restore'])
    ->name('admin.news.restore');
    Route::delete('/news/forcedelete/{id}', [NewsTrashController::class, 'forceDelete'])
    ->name('admin.news.forcedelete');
    // Ajax Call Active
    Route::get('check/news/is_active/{news_id}', [NewsController::class, 'checkActiveActive'])
    ->name('news.is_active.ajax');
    Route::get('check/news/is_home/{news_id}', [NewsController::class, 'checkActiveHome'])
    ->name('news.is_home.ajax');
    Route::resource('news', NewsController::class, ['as' => 'admin']);

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

