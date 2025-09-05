<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\OptimizedNavigationService;

class OptimizedDashboardComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $navigation = OptimizedNavigationService::getAllNavigation();
        
        $view->with([
            'items' => $navigation['main'],
            'adminItems' => $navigation['admin'],
            'user' => auth()->user(),
            'quickStats' => OptimizedNavigationService::getQuickStats(),
            'quickAccessLinks' => OptimizedNavigationService::getQuickAccessLinks(),
            'breadcrumbs' => OptimizedNavigationService::getBreadcrumbs(),
            'keyboardShortcuts' => OptimizedNavigationService::getKeyboardShortcuts(),
        ]);
    }
}
