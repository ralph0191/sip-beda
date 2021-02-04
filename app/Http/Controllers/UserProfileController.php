<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
// use Exception;
class UserProfileController extends Controller
{
    //
    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {

            return  response()->json(['status' => RESPONSE::HTTP_UNPROCESSABLE_ENTITY,
            'errors' => $validator->errors()
            ]);
        }

        $user->first_name = $request->firstName;
        $user->middle_name = $request->middleName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->mobile_number = $request->mobileNumber;
        $user->address = $request->address;

        $user->update();
       
        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        
        if (Hash::check($request->get('oldPassword'), $user->password) === FALSE) {
            return  response()->json([
                'status' => RESPONSE::HTTP_UNPROCESSABLE_ENTITY,
                'error' => 'Current Password is incorrect'
            ]);
        }

        $user->update([
            'password'  => hash::make($request->get('newPassword')),
        ]);

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function changeProfilePic(Request $request)
    {
        $photo = $request->file('file');
        $extension       = $photo->getClientOriginalExtension();
        $allowed         = ['jpeg','jpg','png'];

        $user = Auth::user();
        
        
        if (in_array($extension, $allowed) === FALSE) {
            return response()->json(['status'=> Response::HTTP_UNPROCESSABLE_ENTITY,
                'msg' => 'File is not in ' . implode(',', $allowed) . ' format']);
        }

        if ($user->path != null) {
            Storage::delete($user->picture);
        }

        $fileName = time() . '_' . $photo->getClientOriginalName();
        $path = $photo->storeAs('public/photo', $fileName);

        $user->picture = $fileName;
        
        $user->update();
        // $visibility = Storage::getVisibility($path);

        // Storage::setVisibility($path, 'public');
        // $user->update([
        //     'password'  => hash::make($request->get('newPassword')),
        // ]);

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function rules()
    {
        $regex = '/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/';
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'middleName' => 'required|string|max:255',
            'lastName' =>   'required|string|max:255',
            'mobileNumber' => ['required', 'string', 'regex:'.$regex],
            'address'    => 'required|string',
            'email'      => ['required', 'string','email','max:255', Rule::unique('users')->ignore(Auth::user()->id),],
        ];
    }
}
