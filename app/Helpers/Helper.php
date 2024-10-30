<?php

namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\Models\Permission;


// use App\BlogBookmark;
// use App\NewsBookmark;

class Helper
{
    public static function check_rights($right_id)
    {
        $role_right_actions = Permission::where('menu_id', $right_id)
            ->where('role_id', Auth::user()->role_id)
            ->select('is_listing', 'is_show', 'is_create', 'is_edit','is_delete')
            ->first();
            
        return $role_right_actions ?? (object)[
            'is_listing' => false,
            'is_show' => false,
            'is_create' => false,
            'is_edit' => false,
            'is_delete' => false,
        ];
    }

}
