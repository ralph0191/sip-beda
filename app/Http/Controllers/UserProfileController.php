<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //
    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' =>   'required|string|max:255'
        ])
    }
}
