<?php

namespace App\Http\Controllers\enquete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function getList() {
        $enquete = DB::table('t_enquete_management')
            ->select('id','name','sex','age','mail','send_mail','comment','create_dt')
            ->orderBy('create_dt','desc')
            ->get();
            //->paginate(5);
        return $enquete;
    }
}
