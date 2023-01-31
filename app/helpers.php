<?php

use App\Models\DigitalOffice;
use App\Models\DigitalOfficeEmployee;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

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
function buildMenuUrl(&$menuItems)
{
    foreach ($menuItems as &$menuItem) {

        if (!isset($menuItem['data']['url']) && !empty($menuItem['type'])) {
            $menuItem['data']['url'] = $menuItem['type'] != null ? generateResourceUrl($menuItem['type'], $menuItem['data']) : '#';
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

    if ($resourceType == 'khdm') {
        $service = \App\Models\Service::find($data['service_id']);
        return route('search.listing', ['service' => $service->slug]);
    }

    if ($resourceType == 'mhn') {
        $profession = \App\Models\Profession::find($data['profession_id']);
        return route('search.listing', ['service' => $profession->service->slug, 'profession' => $profession->slug,]);
    }

    return '';
}
