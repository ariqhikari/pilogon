<?php

use Illuminate\Support\Facades\Route;

Route::get('/','LandingPageController@index')->name("LandingPage.index");
Route::post("/class/filter","ClassController@filter")->name("class.filter");
Route::get("/class","ClassController@index")->name("class.index");
Route::post("/class/search-course","ClassController@search_cover")->name("class.search");

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get("/dashboard","AdminController@dashboard")->name("dashboard");
    Route::get("/admin/users","AdminController@userIndex")->name("admin.userIndex");
    Route::post("/admin/users-search","AdminController@userSearch")->name("admin.userSearch");
    Route::get("/admin/{id}/upload","AdminController@upload")->name("admin.upload");
    Route::get("/admin/{id}/tolak","AdminController@tolak")->name("admin.tolak");
    Route::get("/admin/courses","AdminController@courseIndex")->name("admin.coursesIndex");
    Route::get("/admin/{id}/drop","AdminController@drop")->name("admin.drop");
    Route::get("/admin/forums","AdminController@forumIndex")->name("admin.forumIndex");
    Route::get("/admin/blogs","AdminController@blogIndex")->name("admin.blogIndex");

    Route::post("/categorys/search","CategoryController@search")->name("categorys.search");
    Route::resource("/categorys","CategoryController");
    
    Route::get("/user/artikel-ku","PostController@user")->name("user.artikelku");
    Route::get("/user/pilihan-kelas","UserController@pilihan")->name("user.pilihan");
    Route::get("/user/kelas-yang-dipelajari","UserController@learned_course")->name("user.learned");
    Route::resource("/user","UserController");

    Route::get("/class/create-cover","ClassController@create_cover")->name("class.create_cover");
    Route::post("/class/store-cover","ClassController@store_cover")->name("class.store_cover");
    Route::post("/class/image-upload","ClassController@image")->name("class.image");
    Route::get("/class/{slug}","ClassController@show")->name("class.show");
    Route::get("/class/{slug}/daftar","ClassController@daftar")->name("class.daftar");
    Route::get("/class/{slug}/{id}/belajar","ClassController@belajar")->name("class.belajar");
    Route::get("/created-course/{covercourse}/delete-course","CoverCourseController@delete")->name("created-course.delete");
    Route::resource("/created-course","CoverCourseController");

    Route::get("/modules","ModuleController@index")->name("modules.index");
    Route::get("/modules/{id}/{slug}/edit","ModuleController@edit")->name("modules.edit");
    Route::post("/modules","ModuleController@store")->name("modules.store");
    Route::patch("/modules/{id}","ModuleController@update")->name("modules.update");
    Route::get("/modules/{id}/delete","ModuleController@destroy")->name("modules.delete");
    Route::get("/modules/{id}/{slug}/view","ModuleController@show")->name("modules.show");
    Route::get("/modules/{id}/download","ModuleController@download")->name("modules.download");

    Route::get("/verifikasi/delete-riwayat","VerifikasiController@deleteRiwayat")->name("verifikasi.delete");
    Route::post("verifikasi/drop","VerifikasiController@drop")->name("verifikasi.drop");
    Route::resource("/verifikasi","VerifikasiController");

    Route::get("/likes/{forum}/like","Like_ForumController@like")->name("likes.like");
    Route::get("/likes/{forum}/unlike","Like_ForumController@unlike")->name("likes.unlike");

    Route::get("/forum/user","ForumController@user")->name("forum.user");
    Route::resource("/forum","ForumController");
    Route::get("/forum/{forum}/delete","ForumController@delete")->name("forum.delete");
    Route::post("/forum/search","ForumController@search")->name("forum.search");

    Route::post("/jawaban-forum/storeBalasan","Comment_ForumController@storeBalasan")->name("jawaban-forum.storeBalasan");
    Route::resource("/jawaban-forum","Comment_ForumController");
    Route::get("/jawaban-forum/{id}/{forum}/balas","Comment_ForumController@balas")->name("jawaban-forum.balas");

    Route::get("/blogs/{blog}/draft","PostController@draft")->name("blogs.draft");
    Route::get("/blogs/{blog}/upload","PostController@upload")->name("blogs.upload");
    Route::get("/blogs/{blog}/preview","PostController@preview")->name("blogs.preview");
    Route::get("/blogs/{id}/hapus-blog","PostController@delete")->name("blogs.delete");
    Route::get("/blogs/category/{category}","PostController@viewCategory")->name("blogs.categoryView");
    Route::get("/blogs/viewmore","PostController@viewMore")->name("blogs.view");
    Route::resource("/blogs","PostController");

    Route::resource("/post-comment","Post_CommentController");
    Route::get("/post-comment/{id}/{blog}/balas","Post_CommentController@balas")->name('post-comment.balas');
    Route::post("/post-comment/storeBalasan","Post_CommentController@storeBalasan")->name("post-comment.storeBalasan");
});
Auth::routes(['verify' => true]);