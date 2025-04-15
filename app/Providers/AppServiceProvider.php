<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;


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
         // Komposer untuk semua halaman KECUALI halaman penilaian.create
         View::composer('*', function ($view) {
             if (Auth::check()) {
                 if (request()->route() && request()->route()->getName() === 'penilaian.create') {
                     // Jika di halaman create penilaian, tampilkan semua upload
                     $uploads = Upload::all();
                 } else {
                     // Jika di halaman lain, hanya tampilkan upload milik user yang login
                     $uploads = Upload::where('user_id', Auth::id())->get();
                 }
     
                 $view->with('uploads', $uploads);
             }
         });
     }
    }     
