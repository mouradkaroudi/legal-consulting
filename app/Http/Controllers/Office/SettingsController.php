<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\DigitalOffice;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $settingsRoute = route('office.settings');

        $menu = [
            [
                'label' => __('General settings'),
                'icon' => 'heroicon-o-cog',
                'link' => $settingsRoute
            ],
            [
                'label' => __('Withdrawal settings'),
                'icon' => 'heroicon-o-credit-card',
                'link' => $settingsRoute . '?tab=withdrawal'
            ],
        ];

        if($request->user()->currentOffice->haveSubscriptionPlan()) {
            $menu[] = [
                'label' => __('Subscription settings'),
                'icon' => 'heroicon-o-user',
                'link' => $settingsRoute . '?tab=subscription'
            ];
        }

        return view('pages.office.settings', [
            'digitalOffice' => auth()->user()->currentOffice,
            'tab' => $request['tab'],
            'menu' => $menu
        ]);
    }
}
