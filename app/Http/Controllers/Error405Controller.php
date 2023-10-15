<?php

namespace App\Http\Controllers;


class Error405Controller extends Controller
{
    public function returnNotFoundPage(): \Illuminate\Http\Response
    {
        return response()->view('site.user.pages.not_found');
    }

    public function returnNotFoundAdminPage(): \Illuminate\Http\Response
    {
        return response()->view('site.admin.pages.not_found_admin');
    }

}
