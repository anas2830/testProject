<?php
Route::get('/', 'IndexController@index');
Route::get('/about', function(){
    return view('website.about');
});
Route::get('/category', function(){
    return view('website.category');
});
Route::get('/post', function(){
    return view('website.post');
});

Route::get('/single/{id}', 'IndexController@single');
Route::post('/sign-up', 'Auth\RegisterController@signUp')->name('sign-up');

Route::get('/login/moderator', 'ModeratorLoginController@showModeratorLoginForm');
Route::post('/login/moderator', 'ModeratorLoginController@moderatorLogin');

Route::get('/login/admin', 'AdminLoginController@showAdminLoginForm');
Route::post('/login/admin', 'AdminLoginController@adminLogin');



// user after login
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/userProfile', 'HomeController@userProfile')->name('userProfile');
Route::post('/profileUpdate', 'HomeController@profileUpdate')->name('profileUpdate');

Route::resource('userBlog', 'User\BlogController');
Route::resource('comment', 'User\CommentController');

//exam
        
Route::get('classExamRunning', 'User\ClassExamController@classExam')->name('classExamRunning');                              
Route::post('classExamSubmit', 'User\ClassExamController@classExamSubmit')->name('classExamSubmit');
Route::get('studentResult', 'User\ClassExamController@examResultShow')->name('studentResult');


Route::group(['middleware' => 'auth:admin'], function () {
    //Route::view('/admin', 'admin');
    Route::get('/admin', 'SuperAdmin\HomeController@index')->name('admin');
    Route::get('/dashboard', 'SuperAdmin\HomeController@index')->name('dashboard');
    
    //handle moderator 
    Route::resource('handleModerator', 'SuperAdmin\ModeratorController');

    //handle blog
    Route::resource('handleBlogAdmin', 'SuperAdmin\BlogController');
    Route::get('blogAdminCommentList/{id}', 'SuperAdmin\BlogController@blogAdminCommentList')->name('blogAdminCommentList');
    Route::get('blogAdminCommentUpdate/{id}', 'SuperAdmin\BlogController@blogAdminCommentUpdate')->name('blogAdminCommentUpdate');
    Route::put('blogAdminCommentUpdateAction/{id}', 'SuperAdmin\BlogController@blogAdminCommentUpdateAction')->name('blogAdminCommentUpdateAction');
    Route::delete('blogAdminCommentDelete/{id}', 'SuperAdmin\BlogController@blogAdminCommentDelete')->name('blogAdminCommentDelete');

    //handle profile
    Route::get('/adminProfile', 'SuperAdmin\HomeController@adminProfile')->name('adminProfile');
    Route::post('/adminProfileUpdate', 'SuperAdmin\HomeController@adminProfileUpdate')->name('adminProfileUpdate');


    // exam
    Route::resource('courseQuestionArchive', 'SuperAdmin\ArchiveQuestionController');

    Route::get('classExamConfig', 'SuperAdmin\ClassExamController@examConfig')->name('classExamConfig');
    Route::post('classExamConfig', 'SuperAdmin\ClassExamController@saveExamConfig')->name('classExamConfig');

});
