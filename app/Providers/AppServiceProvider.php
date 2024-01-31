<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//バリデーションのために追加

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(CustomServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Validator::extend('no_spaces', function ($attribute, $value, $parameters, $validator) {
        //     // スペースのみの場合は false を返す
        //     return !preg_match('/^\s+$/', $value);
        // });

        // Validator::replacer('no_spaces', function ($message, $attribute, $rule, $parameters) {
        //     //バリデーションの文言を置き換える
        //     return str_replace(':attribute', $attribute, 'スペースのみの投稿はできません。');
        // });
    }
}
