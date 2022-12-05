<?php
    
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function index()
    {
        $joins = DB::table('senjatas')
            ->join('subtypes', 'senjatas.id_subjenis', '=', 'subtypes.id_subjenis')
            ->join('types', 'senjatas.id_jenis', '=', 'types.id_type')
            ->select('senjatas.nama_senjata as nama_senjata', 'subtypes.subjenis as subjenis', 'types.type as type')
            ->paginate(6);
            return view('totals.index',compact('joins'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}