<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    { {
            //Redis::rpush('names', 'فهد', 'سعود', 'عبدالله', 'زيد', 'يوسف');
            // $values = Redis::lrange('names', 0, 3);
            //  echo implode(', ', $values); // يطبع: سعود, عبدالله, زيد

            //  $a = 'hello';
            // $$a = 'world';
            //echo "$a $hello";
            //abort(403, 'Unauthorized action.');
            Log::info('أهلاً!'); // طباعة جملة "أهلاً" في سجل الأحداث
            view()->composer('welcome', function ($view) {
                //  Cache::set('F', 'f');
                $key = Cache::get('F');
                //return Cache::get('key');
                $view->with('hi', $key);


                /////////////////////////////////////////////////////////
                // storage\app\files\the file
                if ($filePath = 'C:\Users\samaa\Downloads\Compressed\g.txt') {
                    $fileContents = file_get_contents($filePath);
                    Storage::disk('local')->append('files\file.txt', $fileContents);

                }
                if (Storage::disk('local')->exists('files\file.txt')) {
                    echo "find it.";
                    echo Session::get('name');

                }
                Storage::disk('local')->copy('files\file.txt', 'files/new_file.txt');
            });
        }

    }
}