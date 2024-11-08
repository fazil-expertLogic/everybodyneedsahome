<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\PageContent;


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

    public static function pageContent($page_url,$variable){
        $page_content = PageContent::where('page_url', $page_url)
            ->where('variable', $variable)
            ->select('text')
            ->first();
            
        return $page_content;
    }

}
