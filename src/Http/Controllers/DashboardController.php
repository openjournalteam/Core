<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!Auth::check()) {
            return render('core::pages.auth.login');
        }

        return render('core::pages.dashboard.index');
    }
}
