<?php

namespace App\Http\Controllers\enquete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnqueteRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\EnqueteManagement;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Auth;

class EnqueteController extends Controller
{
    public function phpinfo() {
        phpinfo();
    }

    public function validationCheck(EnqueteRequest $request) {
        return response()->json('ok', Response::HTTP_OK);
    }

    public function getDetail($id) {
        $enquete = DB::table('t_enquete_management')
            ->select('id','name','sex','age','mail','send_mail','comment')
            ->where('id','=',$id)
            ->get();
        return $enquete;
        //return json_decode(json_encode($enquete), true);
        //return json_encode($enquete);
    }

    public function save(EnqueteRequest $request) {
        $enquete_management = new EnqueteManagement;
        $enquete_management->name = $request->name;
        $enquete_management->sex = $request->sex;
        $enquete_management->age = $request->age;
        $enquete_management->mail = $request->mail;
        $enquete_management->send_mail = $request->send_mail;
        $enquete_management->comment = $request->comment;
        $enquete_management->last_updated = __METHOD__;
        //$enquete_management->last_updated_user = auth()->user();
        $enquete_management->save();
        return response()->json('saved', Response::HTTP_OK);
    }
}
