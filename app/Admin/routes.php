<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('article-categories', ArticleCategoryController::class);
    $router->resource('articles', ArticleController::class);
    $router->resource('banners', BannerController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('manufacturers', ManufacturerController::class);
    $router->resource('languages', LanguageController::class);
    $router->resource('messages', MessageController::class);
    $router->resource('enquiries', EnquiryController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('products', ProductController::class);
    $router->resource('attributes', AttributeController::class);
    $router->resource('seos', SeoController::class);
    $router->resource('site-infos', SiteInfoController::class);
    $router->resource('cities', CityController::class);
    $router->resource('countries', CountryController::class);
    $router->resource('states', StateController::class);
});
