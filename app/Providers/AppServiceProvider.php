<?php

namespace App\Providers;

use App\Classes\YiwuMailer;
use App\Models\SearchData;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Category;
use App\Models\Banner;
use Carbon\Carbon;
use View;
use Session;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(0);
        \Schema::defaultStringLength(191);
        view()->composer('*', function ($view){

            /*$admin_lang = DB::table('admin_languages')->where('is_default','=',1)->first();
        App::setlocale($admin_lang->name);*/

            $gs = App\Models\Generalsetting::find(1);
            $seo = App\Models\Seotool::find(1);

            $categories         = Category::where('status','=',1)->whereIn('type',['product','both'])->orderBy('sort_order','ASC')->get();// Product Categories
            $service_categories  = Category::where('status','=',1)->whereIn('type',['services','both'])->orderBy('sort_order','ASC')->get();// Service Categories

            $previous_searches = SearchData::where('ip_address','=',getRealIpAddr())->orderBy('id','desc')->limit(3)->get()->toArray();

            $bannerTop = Banner::where('type','=','TopSmall')->first();

            $languages = App\Models\Language::orderBy('is_default','DESC')->get()->toArray();
            $languages_by_id = makeSecondLevelValueToParentIndex($languages,'id',false);
            if(Session::has('language') && isset($languages_by_id[Session::get('language')])){
                $data_results = file_get_contents(public_path().'/assets/languages/'.$languages_by_id[Session::get('language')]['file']);
                $selected_lang = $languages_by_id[Session::get('language')]['id'];
            }else{
                $data_results = file_get_contents(public_path().'/assets/languages/'.$languages[0]['file']);
                $selected_lang = $languages_by_id[0]['id'];
            }
            $langg = json_decode($data_results);
            if (!Session::has('popup')) {
                $visited = 1;
            }
            Session::put('popup' , 1);

            $currencies = App\Models\Currency::orderBy('is_default','desc')->get()->toArray();
            //debug($currencies,1);
            $currencies_by_id = makeSecondLevelValueToParentIndex($currencies,'id',false);

            if(Session::has('currency') && isset($currencies_by_id[Session::get('currency')])){
                $selected_currency = $currencies_by_id[Session::get('currency')]['id'];
                $selected_currency_sign = $currencies_by_id[Session::get('currency')]['sign'];
            }else{
                $selected_currency = $currencies_by_id[0]['id'];
                $selected_currency_sign = $currencies_by_id[0]['sign'];
            }
            $header_pages = App\Models\Page::where('header','=',1)->get();
            $reg_countries = App\Models\Countries::pluck('country_name','country_name')->toArray();

            $view->with('gs', $gs);
            $view->with('seo', $seo);
            $view->with('categories', $categories);
            //$view->with('serviceCategories ', $serviceCategories );
            $view->with('service_categories', $service_categories);
            $view->with('previous_searches', $previous_searches);
            $view->with('bannerTop', $bannerTop);
            $view->with('langg', $langg);
            $view->with('selected_lang', $selected_lang);
            $view->with('languages', $languages_by_id);
            $view->with('visited', $visited);

            $view->with('currencies', $currencies_by_id);
            $view->with('selected_currency', $selected_currency);
            $view->with('selected_currency_sign', $selected_currency_sign);
            $view->with('header_pages', $header_pages);
            $view->with('reg_countries', $reg_countries);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

    }
}
