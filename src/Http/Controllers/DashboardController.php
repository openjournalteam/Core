<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

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
