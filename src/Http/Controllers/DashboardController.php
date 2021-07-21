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

        add_script('core::assets/js/jquery.min.js');

        return render('core::pages.dashboard.index');
    }
}
