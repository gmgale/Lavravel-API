<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations as OA;

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
    $router->get('/api/posts', function () {

        $posts = Cache::get('1', function () {
            $posts = DB::select("SELECT * FROM posts");
            Cache::add('1', $posts, $seconds = env('CACHE_TIME'));
        });
        return response()->json($posts);
    });

    /**
     * @OA\Get(
     *     path="/api/post/{id}",
     *     @OA\Response(response="200", description="Get a post by it's id.")
     * )
     */
    $router->get('api/post/{id}', function ($id) {

        $post = Cache::get($id);
        if ($post == null) {
            $post = DB::table('posts')->where('id', $id)->first();
            Cache::add($post->id, $post, $seconds = env('CACHE_TIME'));
        };

        return response()->json([$post]);
    });
});
