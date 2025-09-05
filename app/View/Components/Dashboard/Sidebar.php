<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render()
    {
        $items = [
            [
                'label' => 'Dashboard',
                'href' => route('dashboard'),
                'icon' => 'home',
                'active' => request()->routeIs('dashboard')
            ],
            [
                'label' => 'Events',
                'href' => route('events.index', [], false),
                'icon' => 'sparkles',
                'active' => request()->routeIs('events.*')
            ],
            [
                'label' => 'Attendees',
                'href' => route('attendees.index'),
                'icon' => 'users',
                'active' => request()->routeIs('attendees.*')
            ],
            [
                'label' => 'Venues',
                'href' => '#',
                'icon' => 'building',
                'active' => request()->routeIs('venues.*')
            ],
            [
                'label' => 'Vendors',
                'href' => '#',
                'icon' => 'briefcase',
                'active' => request()->routeIs('vendors.*')
            ],
            [
                'label' => 'Organizers',
                'href' => '#',
                'icon' => 'user-group',
                'active' => request()->routeIs('organizers.*')
            ]
        ];

        return view('components.dashboard.sidebar', compact('items'));
    }
}
