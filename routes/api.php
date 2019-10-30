<?php

use App\Categories;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', function () {
    try {
        // نمایش پست های دسته بندی انتخاب شده و تمامی زیر مجموعه های آن
        $posts = Categories::findOrFail(1)->with('posts')->get()->pluck('posts')->flatten();

        // نمایش تمام دسته بندی ها به صورت آبشاری
        $categories = Categories::with('children')->get();
        return response()->json([
            'data' => [
                'categories' => $categories,
                'posts' => $posts,
            ],
            'status' => true
        ]);
    } catch (Exception $exception) {
        return response()->json([
            'data' => $exception->getMessage(),
            'status' => false
        ]);
    }
});

Route::get('posts', function () {
    try {
        // نمایش 10 پست آخر
        $posts = Posts::orderBy('id', 'desc')->take(10)->get();
        return response()->json([
            'data' => $posts,
            'status' => true
        ]);
    } catch (Exception $exception) {
        return response()->json([
            'data' => $exception->getMessage(),
            'status' => false
        ]);
    }
});

Route::post('post/create', function (Request $request) {
    try {
        $post = Posts::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'text' => $request->text,
            'tags' => $request->tags,
        ]);
        return response()->json([
            'data' => $post,
            'status' => true
        ]);
    } catch (Exception $exception) {
        return response()->json([
            'data' => $exception->getMessage(),
            'status' => false
        ]);
    }
});
