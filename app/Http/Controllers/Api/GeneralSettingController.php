<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\GeneralSettingCollection;
use App\Models\GeneralSetting;

class GeneralSettingController extends Controller
{
    public function index()
    {
        return new GeneralSettingCollection(GeneralSetting::all());
    }

    public function getSocialLinks()
    {
        return new GeneralSettingCollection(GeneralSetting::select('facebook', 'instagram', 'twitter', 'youtube', 'google_plus') 
        ->get());
    }
}
