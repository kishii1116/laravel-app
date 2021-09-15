<?php

namespace App\Http\Controllers\enquete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnqueteRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\EnqueteManagement;

class EnqueteController extends Controller
{
    public function phpinfo() {
        phpinfo();
    }

    public function save(EnqueteRequest $request) {
        $enquete_management = new EnqueteManagement;
        $enquete_management->name = $request->name;
        $enquete_management->sex = $request->sex;
        $enquete_management->age = $request->age;
        $enquete_management->mail = $request->mail;
        $enquete_management->send_mail = $request->send_mail;
        $enquete_management->comment = $request->comment;
        $enquete_management->save();
        //$array = array();
        //return $array;
        return response()->json('saved', Response::HTTP_OK);
    }
}
