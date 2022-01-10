<?php

use OpenJournalTeam\Core\Navigation\NavigationItem;

return [


  'enabled' => env('CORE_ENABLED', true),
  'cache' => [
    'enable' => false,
    'time' => 60 * 60 * 24,
  ],

  /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Panel Backend route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

  'middleware' => [
    'web',
  ],


  'navigation' => [
    NavigationItem::make()
      ->label('Dashboard')
      ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><rect x="10" y="12" width="4" height="4" /></svg>', true)
      ->route('core.home'),
    NavigationItem::make()
      ->label("Admin")
      ->permission("Admin")
      ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 20.4l-6.9 -6.9c-.781 -.781 -.781 -2.219 0 -3l6.9 -6.9c.781 -.781 2.219 -.781 3 0l6.9 6.9c.781 .781 .781 2.219 0 3l-6.9 6.9c-.781 .781 -2.219 .781 -3 0z" /></svg>', true)
      ->subNavigationItems(function () {
        return [
          NavigationItem::make()
            ->label('Users & Roles')
            ->permission('User & Roles')
            ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="1" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="8" y1="4" x2="8" y2="8" /></svg>', true)
            ->route('core.admin.access.index'),
          NavigationItem::make()
            ->label('Menu')
            ->permission('Menu')
            ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="6" x2="20" y2="6" /><line x1="4" y1="12" x2="20" y2="12" /><line x1="4" y1="18" x2="20" y2="18" /></svg>', true)
            ->route('core.admin.menu.index'),
          NavigationItem::make()
            ->label('Plugins')
            ->permission('Plugins')
            ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="7" y="3" width="14" height="14" rx="2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>', true)
            ->route('core.admin.menu.index')
        ];
      }),

  ],


  /*
    |--------------------------------------------------------------------------
    | Panel Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Panel will be accessible from. Feel free
    | to change this path to anything you like. 
    |
    */

  'title' => env('CORE_TITLE', 'Panel'),

  'path' => env('CORE_PATH', 'panel'),

  'scripts' => [
    [
      'src' => 'vendor/core/libs/swal/sweetalert2.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/alpinejs/alpinejs3.min.js',
      'defer' => true
    ],
    [
      'src' => 'vendor/core/libs/datatables/datatables.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/datatables/dataTables.bootstrap5.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/select2/select2.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/datatables/responsive/js/dataTables.responsive.min.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/libs/dropzone/dropzone.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/app.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/form.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/swal.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/alpine.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/datatables.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/dropzones.js',
      'defer' => false
    ],
    [
      'src' => 'vendor/core/js/select2.js',
      'defer' => false
    ],
  ],

  'styles' => [
    [
      'href' => 'vendor/core/css/tabler.min.css',
      'async' => false,
    ],
    [
      'href' => 'vendor/core/css/tabler-flags.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/css/tabler-vendors.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/bootstrap-extension/bootstrap-extension.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/css/app.css',
      'async' => false,
    ],
    [
      'href' => 'vendor/core/libs/swal/sweetalert2.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/datatables/dataTables.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/datatables/responsive/css/responsive.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/select2/select2.min.css',
      'async' => true,
    ],
    [
      'href' => 'vendor/core/libs/select2/select2.bootstrap5.min.css',
      'async' => true,
    ],
    [
      'href' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
      'async' => true,
    ],
  ]

];
