<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class sandboxController extends Controller
{

public function index(Request $request){

    // try {

    //         if (empty($request->password)) {
    //                 throw new Exception("Password filled is empty");
    //             }

               
    //       return  $password_hash = password_hash($request->password, PASSWORD_DEFAULT);
    //           $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    // // $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );

    //         } catch (Exception $th) {
    //         return $th->getMessage();
    //     }

    // }
    
            return view('pages.dashboard.sandbox');

    }

    public function sandboxUploadImage(){
     session()->flash('reload-page');

        return redirect()->back();

    }

}