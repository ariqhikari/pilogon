<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get("/","AdminController@dashboard")->name("dashboard");
            Route::get("users","AdminController@userIndex")->name("userIndex");
            Route::post("users-search","AdminController@userSearch")->name("userSearch");
            Route::get("{id}/upload","AdminController@upload")->name("upload");
            Route::get("{id}/tolak","AdminController@tolak")->name("tolak");
            Route::get("courses","AdminController@courseIndex")->name("coursesIndex");
            Route::get("{id}/drop","AdminController@drop")->name("drop");
            Route::get("forums","AdminController@forumIndex")->name("forumIndex");
            Route::get("blogs","AdminController@blogIndex")->name("blogIndex");
    });

    Route::prefix('categorys')
        ->name('categorys.')
        ->middleware(['admin'])
        ->group(function () {
            Route::post("search","CategoryController@search")->name("search");
    });
    
    Route::prefix('user')
        ->name('user.')
        ->group(function () {
            Route::post("/","UserController@store")->name("store");
            Route::get("/","UserController@index")->name("index");
            Route::get("create","UserController@create")->name("create");
            Route::put("{user}","UserController@update")->name("update");
            Route::delete("{user}","UserController@destroy")->name("destroy");
            Route::get("{user}/edit","UserController@edit")->name("edit");
            Route::get("artikel-ku","PostController@user")->name("artikelku");
            Route::get("pilihan-kelas","UserController@pilihan")->name("pilihan");
            Route::get("kelas-yang-dipelajari","UserController@learned_course")->name("learned");
    });

    Route::prefix('class')
        ->name('class.')
        ->group(function () {
            Route::get("create-cover","ClassController@create_cover")->name("create_cover");
            Route::post("store-cover","ClassController@store_cover")->name("store_cover");
            Route::post("image-upload","ClassController@image")->name("upload.image");
            Route::post("delete-upload","ClassController@deleteImage")->name("delete.image");
            Route::get("{slug}/daftar","ClassController@daftar")->name("daftar");
            Route::get("{slug}/{id}/belajar","ClassController@belajar")->name("belajar");
    });

    Route::prefix('created-course')
        ->name('created-course.')
        ->group(function () {
            Route::get("{covercourse}/delete-course","CoverCourseController@delete")->name("delete");
    });

    Route::prefix('modules')
        ->name('modules.')
        ->group(function () {
            Route::get("/","ModuleController@index")->name("index");
            Route::get("{id}/{slug}/edit","ModuleController@edit")->name("edit");
            Route::post("/","ModuleController@store")->name("store");
            Route::patch("{id}","ModuleController@update")->name("update");
            Route::get("{id}/delete","ModuleController@destroy")->name("delete");
            Route::get("{id}/{slug}/view","ModuleController@show")->name("show");
            Route::get("{id}/download","ModuleController@download")->name("download");
    });

    Route::prefix('verifikasi')
        ->name('verifikasi.')
        ->group(function () {
            Route::get("delete-riwayat","VerifikasiController@deleteRiwayat")->name("delete");
            Route::post("verifikasi/drop","VerifikasiController@drop")->name("drop");
    });

    Route::prefix('likes')
        ->name('likes.')
        ->group(function () {
            Route::get("{forum}/like","Like_ForumController@like")->name("like");
            Route::get("{forum}/unlike","Like_ForumController@unlike")->name("unlike");
    });

    Route::prefix('forum')
        ->name('forum.')
        ->group(function () {
            Route::post("/","ForumController@store")->name("store");
            Route::get("create","ForumController@create")->name("create");
            Route::put("{forum}","ForumController@update")->name("update");
            Route::delete("{forum}","ForumController@destroy")->name("destroy");
            Route::get("{forum}/edit","ForumController@edit")->name("edit");
            Route::get("user","ForumController@user")->name("user");
            Route::get("{forum}/delete","ForumController@delete")->name("delete");
            Route::post("search","ForumController@search")->name("search");
            Route::get("{forum}/balas/{id}","CommentForumController@balas")->name("balas");
    });

    Route::prefix('jawaban-forum')
        ->name('jawaban-forum.')
        ->group(function () {
            Route::post("storeBalasan","CommentForumController@storeBalasan")->name("storeBalasan");
    });

    Route::prefix('blogs')
        ->name('blogs.')
        ->group(function () {
            Route::post("/","PostController@store")->name("store");
            Route::get("create","PostController@create")->name("create");
            Route::delete("{blog}","PostController@destroy")->name("destroy");
            Route::put("{blog}","PostController@update")->name("update");
            Route::get("{blog}/edit","PostController@edit")->name("edit");
            Route::get("{blog}/draft","PostController@draft")->name("draft");
            Route::get("{blog}/upload","PostController@upload")->name("upload");
            Route::get("{blog}/preview","PostController@preview")->name("preview");
            Route::get("{id}/hapus-blog","PostController@delete")->name("delete");
            Route::get("{blog}/balas/{id}","PostCommentController@balas")->name('balas');
    });

    Route::prefix('post-comment')
        ->name('post-comment.')
        ->group(function () {
            Route::post("storeBalasan","PostCommentController@storeBalasan")->name("storeBalasan");
    });

    Route::resources([
        'categorys' => 'CategoryController',
        'created-course' => 'CoverCourseController',
        'verifikasi' => 'VerifikasiController',
        'jawaban-forum' => 'CommentForumController',
        'post-comment' => 'PostCommentController',
    ]);
});

Auth::routes(['verify' => true]);

Route::get('/','LandingPageController@index')->name("LandingPage.index");

Route::prefix('class')
        ->name('class.')
        ->group(function () {
            Route::post("filter","ClassController@filter")->name("filter");
            Route::get("/","ClassController@index")->name("index");
            Route::get("{slug}","ClassController@show")->name("show");
            Route::post("search-course","ClassController@search_cover")->name("search");
});

Route::prefix('blogs')
    ->name('blogs.')
    ->group(function () {
        Route::get("/","PostController@index")->name("index");
        Route::get("viewmore","PostController@viewMore")->name("view");
        Route::get("{blog}","PostController@show")->name("show");
        Route::get("category/{category}","PostController@viewCategory")->name("categoryView");
});

Route::prefix('forum')
    ->name('forum.')
    ->group(function () {
        Route::get("/","ForumController@index")->name("index");
        Route::get("search","ForumController@search")->name("search");
        Route::get("{forum}","ForumController@show")->name("show");
});

Route::prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get("{user}","UserController@show")->name("show");
});

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('google/callback', 'Auth\GoogleController@handleGoogleCallback');