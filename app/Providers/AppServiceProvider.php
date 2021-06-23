<?php

namespace App\Providers;

use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //когда будет загружаться pages._sidebar независимо где его вызывают, мы хотим чтоб сработала колбэк функция которая принимает вид как параметр 
        //мы хотим загрузить вид и передать переменные и результаты запросов 
        view()->composer('pages._sidebar' , function($view){
            $view->with('popularPosts' , Post::getPopularPosts());
            $view->with('featuredPosts' , Post::getFeaturedPosts());
            $view->with('recentPosts' , Post::getRecentPosts());
            $view->with('categories' ,Category::all());
        });

        view()->composer('admin._sidebar' , function($view){
            $view->with('newCommentsCount' , Comment::where('status' , 0)->count());
            
        });
    }
}
