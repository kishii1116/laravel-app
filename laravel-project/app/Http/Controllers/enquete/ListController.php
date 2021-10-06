<?php

namespace App\Http\Controllers\enquete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function getList(Request $request) {
        /*
        $query = "
            SELECT
                id
                ,name
                ,sex
                ,age
                ,mail
                ,send_mail
                ,comment
                ,create_dt
            FROM
                t_enquete_management
            ORDER BY
                create_dt desc
        ";
        $enquete = \DB::select($query);
        */
        $query = DB::table('t_enquete_management')
            ->select('id','name','sex','age','mail','send_mail','comment','create_dt')
            ->orderBy('create_dt','desc');
        if(isset($request->name)) {
            $query->where('name','like', "%".$request->name."%");
        }
        if(isset($request->age)) {
            $query->where('age','=', $request->age);
        }
        if(isset($request->sex)) {
            $query->where('sex','=', $request->sex);
        }
        if(isset($request->start)) {
            $query->where('create_dt','>=', $request->start);
        }
        if(isset($request->end)) {
            $query->where('create_dt','<=', $request->end);
        }
        if(isset($request->send_mail)) {
            $query->where('send_mail','=', $request->send_mail);
        }
        if(isset($request->keyword)) {
            $query->where('comment','like', '%'.$request->keyword.'%');
        }
            //->paginate(5);
        $enquete = $query->get();
        return $enquete;
    }
}
