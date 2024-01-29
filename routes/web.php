<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

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
}); // end admin group middleware

// login admin
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');


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

    // logout
    Route::get('/instructor/logout', [InstructorController::class, 'instructorLogout'])->name('instructor.logout');
}); // end instructor group middleware


// login instructor
Route::get('/instructor/login', [InstructorController::class, 'instructorLogin'])->name('instructor.login');
// user

// frontend
Route::get('/course/details/{id}/{slug}', [IndexController::class, 'courseDetail']);
Route::get('/category/{id}/{slug}', [IndexController::class, 'categoryCourse']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'subcategoryCourse']);

// wishlist
Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'addToWishlist']);

// add to cart
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);


Route::get('/instructor/details/{id}', [IndexController::class, 'instructorDetail'])->name('instructor.details');
