<?php

use OpenJournalTeam\Core\Models\Role;

return [


  'enabled' => env('CORE_ENABLED', true),

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

  /*
    |--------------------------------------------------------------------------
    | Panel Backend Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Panel Backend will be accessible from. Feel free
    | to change this path to anything you like. 
    |
    */

  'path' => env('CORE_PATH', 'backend'),

  /**
   * 
   */

  'menus' => [
    [
      'title' => 'Dashboard',
      'icon'  => '<svg
                      xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                      stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <polyline points="5 12 3 12 12 3 21 12 19 12" />
                      <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                      <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                  </svg>',
      'route' => 'core.home',
      'role'  => false,
    ],
    [
      'title' => 'Settings',
      'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>',
      'role'  => false,
      'submenus' => [
        [
          'title' => 'User & Role',
          'route' => 'core.admin.access.index',
          'role'  => false,
        ],
        [
          'title' => 'Plugins',
          'route' => 'core.admin.plugins.index',
          'role'  => Role::ADMIN,
        ]
      ]
    ],
  ],

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
      'src' => 'vendor/core/js/select2.init.js',
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
      'src' => 'vendor/core/libs/datatables/responsive/js/dataTables.responsive.min.js',
      'defer' => false
    ],
  ],

  'styles' => [
    [
      'href' => 'vendor/core/css/tabler.min.css',
      'async' => true,
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
