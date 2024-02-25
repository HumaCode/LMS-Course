<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
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


Route::get('/', [UserController::class, 'index'])->name('index');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'roles:user', 'verified'])->name('dashboard');

// user
Route::middleware('auth')->group(function () {

    // user profile
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');


    // user wishlist
    Route::controller(WishListController::class)->group(function () {
        Route::get('/user/wishlist', 'allWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-course/', 'getWishlistCourse');
        Route::get('/wishlist-remove/{id}', 'removeWishlist');
    });

    // my course
    Route::controller(OrderController::class)->group(function () {
        Route::get('/my/course', 'myCourse')->name('my.course');
        Route::get('/course/view/{id}', 'courseView')->name('course.view');
    });

    // Q&A route
    Route::controller(QuestionController::class)->group(function () {
        Route::post('/user/question', 'userQuestion')->name('user.question');
    });

    // change password 
    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'userPasswordUpdate'])->name('user.password.update');

    // logout user
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
});




require __DIR__ . '/auth.php';


// admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    // profile
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    // change password
    Route::get('/admin/change/store', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    // logout
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');



    // category manage
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::get('/category/checkSlug', 'checkSlug');
        Route::get('/edit/category/{slug}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{slug}', 'deleteCategory')->name('delete.category');
    });

    // subcategory manage
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'allSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'addSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'storeSubCategory')->name('store.subcategory');
        Route::get('/subcategory/checkSlugSubCategory', 'checkSlugSubCategory');
        Route::get('/edit/subcategory/{slug}', 'editSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'updateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{slug}', 'deleteSubCategory')->name('delete.subcategory');
    });


    // instructor  manage
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/instructor', 'allInstructor')->name('all.instructor');
        Route::post('/update/user/stauts', 'updateUserStauts')->name('update.user.stauts');
    });

    // courses  manage
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/all/courses', 'adminAllCourses')->name('admin.all.courses');
        Route::post('/update/course/stauts', 'updateCourseStauts')->name('update.course.stauts');
        Route::get('/update/course/detail/{slug}', 'updateCourseDetail')->name('admin.course.detail');
    });

    // coupon  manage
    Route::controller(CouponController::class)->group(function () {
        Route::get('/admin/all/coupon', 'adminAllCoupon')->name('admin.all.coupon');
        Route::get('/admin/add/coupon', 'adminAddCoupon')->name('admin.add.coupon');
        Route::post('/admin/store/coupon', 'adminStoreCoupon')->name('admin.store.coupon');
        Route::get('/admin/edit/coupon/{id}', 'adminEditCoupon')->name('admin.edit.coupon');
        Route::post('/admin/update/coupon', 'adminUpdateCoupon')->name('admin.update.coupon');
        Route::get('/admin/delete/coupon/{id}', 'adminDeleteCoupon')->name('admin.delete.coupon');
    });

    // order manage
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending/order', 'adminPendingOrder')->name('admin.pending.order');
        Route::get('/admin/order/detail/{id}', 'adminOrderDetail')->name('admin.order.details');
        Route::get('/admin-pending-confirm/{id}', 'pendingToConfirm')->name('admin-pending-confirm');
        Route::get('/admin-confirm-order', 'adminConfirmOrder')->name('admin-confirm-order');
    });

    // manage report
    Route::controller(ReportController::class)->group(function () {
        Route::get('/admin/report/view', 'adminReportView')->name('admin.report.view');
        Route::post('/admin/search/by/date', 'adminSearchByDate')->name('admin.search.by.date');
        Route::post('/admin/search/by/month', 'adminSearchByMonth')->name('admin.search.by.month');
        Route::post('/admin/search/by/year', 'adminSearchByYear')->name('admin.search.by.year');
    });

    // setting smpt
    Route::controller(SettingController::class)->group(function () {
        Route::get('/admin/smpt/setting', 'adminSmptSetting')->name('admin.smpt.setting');
        Route::post('/admin/update/smpt', 'adminUpdateSmpt')->name('admin.update.smpt');
    });
}); // end admin group middleware

// login admin
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);


Route::get('/become/instructor', [AdminController::class, 'becomeInstructor'])->name('become.instructor');
Route::post('/instructor/register', [AdminController::class, 'instructorRegister'])->name('instructor.register');



// instructor group middleware
Route::middleware(['auth', 'roles:instructor'])->group(function () {

    // instructor dashboard
    Route::get('/instructor/dashboard', [InstructorController::class, 'instructorDashboard'])->name('instructor.dashboard');

    // instructor profile
    Route::get('/instructor/profile', [InstructorController::class, 'instructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'instructorProfileStore'])->name('instructor.profile.store');

    // change password
    Route::get('/instructor/change/store', [InstructorController::class, 'instructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 'instructorPasswordUpdate'])->name('instructor.password.update');

    // courses  manage
    Route::controller(CourseController::class)->group(function () {
        Route::get('/all/course', 'allCourse')->name('all.course');
        Route::get('/add/course', 'addCourse')->name('add.course');
        Route::post('/store/course', 'storeCourse')->name('store.course');
        Route::get('/edit/course/{slug}', 'editCourse')->name('edit.course');
        Route::post('/update/course', 'updateCourse')->name('update.course');
        Route::post('/update/course/image', 'updateCourseImage')->name('update.course.image');
        Route::post('/update/course/video', 'updateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal', 'updateCourseGoal')->name('update.course.goal');
        Route::get('/delete/course/{slug}', 'deleteCourse')->name('delete.course');

        Route::get('/course/checkSlug', 'checkSlugCourse');
        Route::get('/subcategory/ajax/{category_id}', 'getSubCategory');
    });

    // courses section & lecture manage
    Route::controller(CourseController::class)->group(function () {
        Route::get('/add/course/lecture/{id}', 'addCourseLecture')->name('add.course.lecture');
        Route::post('/all/course/section', 'addCourseSection')->name('add.course.section');
        Route::post('/save-lecture/', 'saveLecture')->name('save-lecture');
        Route::get('/edit/lecture/{id}', 'editLecture')->name('edit.lecture');
        Route::post('/update/course/lecture', 'updateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}', 'deleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}', 'deleteSection')->name('delete.section');
    });


    // order manage
    Route::controller(OrderController::class)->group(function () {
        Route::get('/instructor/all/order/', 'instructorAllOrder')->name('instructor.all.order');
        Route::get('/instructor/order/detail/{id}', 'instructorOrderDetail')->name('instructor.order.detail');
        Route::get('/instructor-pending-confirm/{id}', 'instructorPendingConfirm')->name('instructor.pending.confirm');

        // invoice
        Route::get('/instructor/order/invoice/{id}', 'instructorOrderInvoice')->name('instructor.order.invoice');
    });


    // order question
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/instructor/all/question/', 'instructorAllQuestion')->name('instructor.all.question');
        Route::get('/instructor/question/details/{id}', 'instructorQuestionDetail')->name('instructor.question.detail');
        Route::post('/instructor/replay', 'instructorReplay')->name('instructor.replay');
    });

    // coupon  manage
    Route::controller(CouponController::class)->group(function () {
        Route::get('/instructor/all/coupon', 'instructorAllCoupon')->name('instructor.all.coupon');
    });

    // logout
    Route::get('/instructor/logout', [InstructorController::class, 'instructorLogout'])->name('instructor.logout');
}); // end instructor group middleware


// login instructor
Route::get('/instructor/login', [InstructorController::class, 'instructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);
// user

// frontend
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'courseDetail']);
Route::get('/category/{id}/{slug}', [IndexController::class, 'categoryCourse']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'subcategoryCourse']);

// wishlist
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'addToWishlist']);

// route cart
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/data/', [CartController::class, 'cartData']);
Route::get('/course/mini/cart/', [CartController::class, 'miniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'miniCartCourseRemove']);

// buy course
Route::post('/buy/course/{id}', [CartController::class, 'buyToCart']);

// cart
Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'myCart')->name('mycart');
    Route::get('/get-cart-course', 'getCartCourse');
    Route::get('/cart-remove/{rowId}', 'cartRemove');
});

// apply coupon
Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'couponRemove']);

// checkout
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');

// paymenr
Route::post('/payment', [CartController::class, 'payment'])->name('payment');
Route::post('/strip_order', [CartController::class, 'stripeOrder'])->name('strip.order');

Route::get('/instructor/details/{id}', [IndexController::class, 'instructorDetail'])->name('instructor.details');
