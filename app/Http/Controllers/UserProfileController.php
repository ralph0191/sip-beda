<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;
// use Exception;
class UserProfileController extends Controller
{
    //
    public function updateUser(Request $request)

        $user = Auth::user();

        try {
            $this->validate($request, [
                'firstName' => 'required|string|max:255',
                'middleName' => 'required|string|max:255',
                'lastName' =>   'required|string|max:255',
                'email'    => 'required|string|max:255'
            ]);
    
            $user->first_name = $request->firstName;
        } catch (Exception $ex) {
            return  response()->json(['status' => RESPONSE::HTTP_INTERNAL_SERVER_ERROR,
            'error' => $ex]);
        } 
       

        // error_log($user->firstName);
        // error_log($user->first_name);

        

        // $user = Auth::user();
        // $user->first_name = $request->firstName;
          return response()->json(['status' => $user]);
    }
}
