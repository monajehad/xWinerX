<?php

namespace Modules\Category\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        \Menu::make('admin_sidebar', function ($menu) {
            // Categories
            $menu->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('Campaigns'), [
                'route' => 'campaigns.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 83,
                    'activematches' => ['Campaigns*'],
                    'permission' => ['view_campaigns'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);
                $menu->add('<i class="nav-icon fa-solid fa-user"></i> '.__('Customers  '), [
                    'route' => 'backend.users.index',
                    'class' => 'nav-item',
                ])
                    ->data([
                        'order' => 83,
                        'activematches' => 'admin/users*',
                        'permission' => ['view_users'],
                    ])
                    ->link->attr([
                        'class' => 'nav-link',
                    ]);
                    $menu->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('My Campaigns '), [
                        'route' => 'my-campaigns.index',
                        'class' => 'nav-item',
                    ])
                        ->data([
                            'order' => 83,
                            'activematches' => ['Campaigns*'],
                            'permission' => ['view_mycampaigns'],
                        ])
                        ->link->attr([
                            'class' => 'nav-link',
                        ]);
                $menu->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('Active Campaigns '), [
                    'route' => 'active-campaigns.index',
                    'class' => 'nav-item',
                ])
                    ->data([
                        'order' => 83,
                        'activematches' => ['Campaigns*'],
                        'permission' => ['view_activecampaigns'],
                    ])
                    ->link->attr([
                        'class' => 'nav-link',
                    ]);
                    $menu->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('Completed  Campaigns  '), [
                        'route' => 'completed-campaigns.index',
                        'class' => 'nav-item',
                    ])
                        ->data([
                            'order' => 83,
                            'activematches' => ['Campaigns*'],
                            'permission' => ['view_completedcampaigns'],
                        ])
                        ->link->attr([
                            'class' => 'nav-link',
                        ]);
                        $menu

                        ->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('My Account '), [
                            'class' => 'nav-item',
                        ]);
                        $menu->add('<i class="nav-icon fa-solid fa-sitemap"></i> '.__('Ads '), [
                            'route' => 'smart-ad-manager',
                            'class' => 'nav-item',
                        ])
                            ->data([
                                'order' => 83,
                                'activematches' => ['Campaigns*'],
                                'permission' => ['ads'],
                            ])
                            ->link->attr([
                                'class' => 'nav-link',
                            ]);
                //   dd(auth()->user()->id);
                    if (auth()->check()) {
                        $menu->add(['<i class="nav-icon fa-solid fa-sitemap"></i> '.__('My Account' ),
                            'route' => ['backend.users.profileEdit', ['id' => auth()->user()->id]],
                        ])
                        
                            ->data([
                                'order' => 83,
                                'activematches' => ['admin/users*'],
                                'permission' => ['edit_profile
                                '],
                            ])
                            ->link->attr([
                                'class' => 'nav-link',
                            ]);
                        }
        })->sortBy('order');

        return $next($request);
    }
}
