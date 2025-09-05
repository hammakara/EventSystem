<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\AdminNavigationService;

class DashboardComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $navigation = AdminNavigationService::getAllNavigation();
        
        $view->with([
            'items' => $navigation['main'],
            'adminItems' => $navigation['admin'],
            'quickAccessLinks' => AdminNavigationService::getQuickAccessLinks(),
            'breadcrumbs' => AdminNavigationService::getBreadcrumbs(),
        ]);
    }
}
