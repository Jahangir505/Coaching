<?php

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


Route::get('/', function () {
    return view('admin.home.home');
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('/user-registration',[
        'uses'=>'UserRegistrationController@showRegistrationForm',
        'as'=>'user-registration'
    ]);
    
    Route::post('/user-registration',[
        'uses'=>'UserRegistrationController@userSave',
        'as'=>'user-save'
    ]);
    
    Route::get('/user-list',[
        'uses'=>'UserRegistrationController@userList',
        'as'=>'user-list'
    ]);
    
    Route::get('/user-profile/{userId}',[
        'uses'=>'UserRegistrationController@userProfile',
        'as'=>'user-profile'
    ]);
    
    Route::get('/change-user-info/{id}',[
        'uses'=>'UserRegistrationController@userUpdate',
        'as'=>'change-user-info'
    ]);
    
    Route::post('/user-info-update',[
        'uses'=>'UserRegistrationController@userInfoUpdate',
        'as'=>'user-info-update'
    ]);
    
    Route::get('/change-user-avatar/{id}',[
        'uses'=>'UserRegistrationController@changeUserAvatar',
        'as'=>'change-user-avatar'
    ]);
    
    Route::post('/update-user-photo',[
        'uses'=>'UserRegistrationController@updateUserPhoto',
        'as'=>'update-user-photo'
    ]);
    
    Route::get('/change-user-password/{id}',[
        'uses'=>'UserRegistrationController@changeUserPassword',
        'as'=>'change-user-password'
    ]);
    
    Route::post('/user-password-update',[
        'uses'=>'UserRegistrationController@userPasswordUpdate',
        'as'=>'user-password-update'
    ]);

    // General Section

    Route::get('/add-header-footer',[
        'uses' => 'HomePageController@addHeaderFooter',
        'as'   => 'add-header-footer'
    ]);

    Route::post('/add-header-footer',[
        'uses' => 'HomePageController@headerAndFooterSave',
        'as'   => 'header-and-footer-save'
    ]);

    Route::get('/manage-header-footer/{id}',[
        'uses' => 'HomePageController@manageHeaderFooter',
        'as'   => 'manage-header-footer'
    ]);

    Route::post('/header-and-footer-update',[
        'uses' => 'HomePageController@headerAndFooterUpdate',
        'as'   => 'header-and-footer-update'
    ]);


    // Slider Section Start


    Route::get('/add-slide',[
        'uses' => 'SliderController@addSlide',
        'as'   => 'add-slide'
    ]);

    Route::post('/upload-slide',[
        'uses' => 'SliderController@uploadSlide',
        'as'   => 'upload-slide'
    ]);

    Route::get('/manage-slide',[
        'uses' => 'SliderController@manageSlide',
        'as'   => 'manage-slide'
    ]);

    Route::get('/slide-unpublished/{id}',[
        'uses' => 'SliderController@slideUnpublished',
        'as'   => 'slide-unpublished'
    ]);


    Route::get('/slide-published/{id}',[
        'uses' => 'SliderController@slidePublished',
        'as'   => 'slide-published'
    ]);

    Route::get('/photo-gallery',[
        'uses' => 'SliderController@photoGallery',
        'as'   => 'photo-gallery'
    ]);

    Route::get('/slider-edit/{id}',[
        'uses' => 'SliderController@sliderEdit',
        'as'   => 'slider-edit'
    ]);

    Route::post('/update-slide',[
        'uses' => 'SliderController@updateSlide',
        'as'   => 'update-slide'
    ]);

    Route::get('/slide-delete/{id}',[
        'uses' => 'SliderController@slideDelete',
        'as'   => 'slide-delete'
    ]);

    // Slider Section End

    
    // School Management Start

    Route::get('/school/add',[
        'uses' => 'SchoolManagementController@addSchool',
        'as'   => 'add-school'
    ]);

    Route::post('/school/add',[
        'uses' => 'SchoolManagementController@schoolSave',
        'as'   => 'school-save'
    ]);

    Route::get('/school/list',[
        'uses' => 'SchoolManagementController@schoolList',
        'as'   => 'school-list'
    ]);

    Route::get('/school/unpublished/{id}',[
        'uses' => 'SchoolManagementController@schoolUnpublished',
        'as'   => 'school-unpublished'
    ]);

    Route::get('/school/published/{id}',[
        'uses' => 'SchoolManagementController@schoolPublished',
        'as'   => 'school-published'
    ]);

    Route::get('/school/edit/{id}',[
        'uses' => 'SchoolManagementController@schoolEdit',
        'as'   => 'school-edit'
    ]);

    Route::post('/school/update',[
        'uses' => 'SchoolManagementController@schoolUpdate',
        'as'   => 'school-update'
    ]);


    Route::get('/school/delete{id}',[
        'uses' => 'SchoolManagementController@schoolDelete',
        'as'   => 'school-delete'
    ]);

    // School Management End



    // Class Management Start

    Route::get('/add/class',[
        'uses' => 'ClassManagementController@addClass',
        'as'   => 'add-class'
    ]);

    Route::post('/add/class',[
        'uses' => 'ClassManagementController@classSave',
        'as'   => 'class-save'
    ]);

    Route::get('/class/list',[
        'uses' => 'ClassManagementController@classList',
        'as'   => 'class-list'
    ]);

    Route::get('/class/unpublished/{id}',[
        'uses' => 'ClassManagementController@classUnpublished',
        'as'   => 'class-unpublished'
    ]);

    Route::get('/class/published/{id}',[
        'uses' => 'ClassManagementController@classPublished',
        'as'   => 'class-published'
    ]);

    
    Route::get('/class/edit/{id}',[
        'uses' => 'ClassManagementController@classEdit',
        'as'   => 'class-edit'
    ]);


    Route::post('/class/update',[
        'uses' => 'ClassManagementController@classUpdate',
        'as'   => 'class-update'
    ]);

    Route::get('/class/delete/{id}',[
        'uses' => 'ClassManagementController@classDelete',
        'as'   => 'school-delete'
    ]);


    // Class Management End

    // Batch Management Start

    Route::get('/add/batch',[
        'uses' => 'BatchManagementController@addBatch',
        'as'   => 'add-batch'
    ]);

    Route::get('/class-wise-student-type',[
        'uses' => 'BatchManagementController@classWiseStudentType',
        'as'   => 'class-wise-student-type'
    ]);

    Route::post('/add/batch',[
        'uses' => 'BatchManagementController@batchSave',
        'as'   => 'batch-save'
    ]);

    
    Route::get('/batch/list',[
        'uses' => 'BatchManagementController@batchList',
        'as'   => 'batch-list'
    ]);

    Route::get('/batch/list-by-ajax',[
        'uses' => 'BatchManagementController@batchListByAjax',
        'as'   => 'batch-list-by-ajax'
    ]);

    Route::get('/batch/unpublished',[
        'uses' => 'BatchManagementController@batchUnpublished',
        'as'   => 'batch-unpublished'
    ]);

    Route::get('/batch/published',[
        'uses' => 'BatchManagementController@batchPublished',
        'as'   => 'batch-published'
    ]);

    Route::get('/batch/edit/{id}',[
        'uses' => 'BatchManagementController@batchEdit',
        'as'   => 'batch-edit'
    ]);

    Route::post('/batch/update',[
        'uses' => 'BatchManagementController@batchUpdate',
        'as'   => 'batch-update'
    ]);

    Route::get('/batch/delete',[
        'uses' => 'BatchManagementController@batchDelete',
        'as'   => 'batch-delete'
    ]);


    // Batch Management End

    // Student Type Start
    Route::get('/student-type',[
        'uses' => 'StudentTypeController@index',
        'as'   => 'student-type'
    ]);

    Route::post('/student-type-add',[
        'uses' => 'StudentTypeController@studentTypeAdd',
        'as'   => 'student-type-add'
    ]);
    Route::get('/studentTypeList',[
        'uses' => 'StudentTypeController@studentTypeList',
        'as'   => 'student-tyoe-list'
    ]);

     Route::get('/student-type-un-publish',[
        'uses' => 'StudentTypeController@studentTypeUnpublish',
        'as'   => 'student-type-un-publish'
    ]);

     Route::get('/student-type-publish',[
        'uses' => 'StudentTypeController@studentTypePublish',
        'as'   => 'student-type-publish'
    ]);

     Route::post('/student-type-update',[
        'uses' => 'StudentTypeController@studentTypeUpdate',
        'as'   => 'student-type-update'
    ]);

    Route::get('/student-type-delete',[
        'uses' => 'StudentTypeController@studentTypeDelete',
        'as'   => 'student-type-delete'
    ]);
    // Student Type Start
    

    // Student Registration Start

    Route::get('/student/registration-form',[
        'uses' => 'StudentController@studentRegistrationForm',
        'as'   => 'student-registration-form'
        ]);

    Route::get('/bring-student-type',[
        'uses' => 'StudentController@bringStudentType',
        'as'   => 'bring-student-type'
        ]);

    Route::get('/batch-roll-form',[
        'uses' => 'StudentController@batchRollForm',
        'as'   => 'batch-roll-form'
        ]);

    Route::post('/student/registration-form',[
        'uses' => 'StudentController@studentSave',
        'as'   => 'student-save'
        ]);

    Route::get('/student/all-runing-student-list',[
        'uses' => 'StudentController@allRuningStudentList',
        'as'   => 'all-runing-student-list'
        ]);

    Route::get('/student/class-selection-form',[
        'uses' => 'StudentController@classSelectionForm',
        'as'   => 'class-selection-form'
        ]);

    Route::get('/student/class-wise-student-type',[
        'uses' => 'StudentController@classWiseStudentType',
        'as'   => 'class-wise-student-type'
        ]);

    Route::get('/student/class-and-type-wise-student',[
        'uses' => 'StudentController@classAndTypeWiseStudent',
        'as'   => 'class-and-type-wise-student'
        ]);

    Route::get('/student/details/{id}',[
        'uses' => 'StudentController@studentDetails',
        'as'   => 'student-details'
        ]);
    
});









Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
