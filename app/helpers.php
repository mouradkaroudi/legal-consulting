<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Post;
use App\Models\Setting;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * 
 */
function get_privacy_checkbox()
{

    $url = '#';
    $page = setting('links_privacy_page');

    if(!empty($page)) {
        $post = Post::find($page);
        if(!empty($post)) {
            $url = route('posts', ['post' => $post, 'slug' => $post->slug]);
        }
    }

    return Checkbox::make("terms")
        ->label(new HtmlString( __('auth.privacy') . ' ' . '<a href=" '.$url.' ">'.__("Privacy & Policy") .'</a>'))
        ->inline()
        ->required();
}

/**
 * 
 */
function isRtl()
{
    return app()->getLocale() == 'ar';
}

/**
 * 
 * 
 * @return string
 */
function setting($name)
{
    $opt = Setting::option($name)->first();
    return  $opt ? $opt->value : null;
}

/**
 * 
 */
function site_name()
{

    $name = setting('general_settings_site_name_' . app()->getLocale());

    return $name ? $name : config('app.name');
}

/**
 * 
 */
function buildMenuUrl(&$menuItems)
{
    foreach ($menuItems as &$menuItem) {

        if (!isset($menuItem['data']['url']) && !empty($menuItem['type'])) {
            $menuItem['data']['url'] = generateResourceUrl($menuItem['type'], $menuItem['data']);
        }

        if (!empty($menuItem['children'])) {
            $menuItem['children'] = buildMenuUrl($menuItem['children']);
        }
    }

    return $menuItems;
}

/**
 * 
 */
function generateResourceUrl($resourceType, $data)
{

    if ($resourceType == 'service') {
        $service = \App\Models\Service::find($data['service_id']);
        if($service) {
            return route('search.listing', ['service' => $service->slug]);
        }
    }

    if ($resourceType == 'profession') {
        $profession = \App\Models\Profession::find($data['profession_id']);
        if($profession) {
            return route('search.listing', ['service' => $profession->service->slug, 'profession' => $profession->slug,]);
        }
    }

    if ($resourceType == 'page') {
        $post = \App\Models\Post::find($data['page_id']);
        if($post) {
            return route('posts', ['post' => $post, 'slug' => $post->slug]);
        }
    }

    return '';
}
