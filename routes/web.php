<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
| Post routes
*/
$router->group([], function () use ($router) {
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     @OA\Response(response="200", description="Get all posts.")
     * )
     */
    $router->get('api/posts', function () {
        $posts = DB::select("SELECT * FROM posts");
        return response()->json($posts);
    });

    /**
     * @OA\Get(
     *     path="/api/post/'{id}",
     *     @OA\Response(response="200", description="Get a post by it's id.")
     * )
     */
    $router->get('api/post/{id}', function ($id) {
        $post = DB::table('posts')->where('id', $id)->first();
        return response()->json([$post->id, $post->title, $post->description]);
    });
});
