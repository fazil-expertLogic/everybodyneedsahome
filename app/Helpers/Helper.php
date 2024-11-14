<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\PageContent;
use App\Models\PlanPermission;


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

    public static function check_plan_rights($plan_right_id)
    {
        $plan_role_right_actions = PlanPermission::where('plan_menu_id', $plan_right_id)
            ->where('plan_id', Auth::user()->purchasePlans->id)
            ->select('is_view')
            ->first();
            
        return $plan_role_right_actions ?? (object)[
            'is_view' => false,
        ];
    }

    public static function pageContent($page_url){
        $page_content = PageContent::where('page_url', $page_url)
            ->select( 'variable','text')
            ->get()->pluck('text','variable');
        
        return $page_content ?? null;
    }

}
