<?php



namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!Auth::check()) {
            return render('core::pages.auth.login');
        }

        // add_script('https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/sortable.js');
        // // add_script('https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js');
        // add_script('https://unpkg.com/packery@2/dist/packery.pkgd.js');
        // add_script('https://unpkg.com/draggabilly@3/dist/draggabilly.pkgd.min.js');

        add_script('vendor/core/libs/sortablejs/sortablejs.bundle.js');


        return render('core::pages.dashboard.index');
    }
}
