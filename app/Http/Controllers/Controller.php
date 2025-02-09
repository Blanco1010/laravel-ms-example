<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller {
    public function checkAdmin(Request $request) {
        if ($request->user()->type !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}
