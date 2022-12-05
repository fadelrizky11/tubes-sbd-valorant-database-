<?php
    
namespace App\Http\Controllers;
    
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class SubjenisController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:senjata-list|senjata-create|senjata-edit|senjata-delete', ['only' => ['index','show']]);
         $this->middleware('permission:senjata-create', ['only' => ['create','store']]);
         $this->middleware('permission:senjata-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:senjata-delete', ['only' => ['destroy','deletelist']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $subjenis = DB::table('subtypes')
                    ->where('subjenis','LIKE','%'.$keyword.'%')
                    ->whereNull('deleted_at')
                    ->paginate(6);
        return view('subtypes.index',compact('subjenis'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subtypes.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_subjenis' => 'required',
            'subjenis' => 'required',
            'skin_subjenis' => 'required',
            'warna_subjenis' => 'required',
        ]);
    
        DB::insert('INSERT INTO subtypes(id_subjenis,subjenis,skin_subjenis,warna_subjenis) VALUES (:id_subjenis, :subjenis,:skin_subjenis,:warna_subjenis)',
        [
            'id_subjenis' =>$request->id_subjenis,
            'subjenis' => $request->subjenis,
            'skin_subjenis' => $request->skin_subjenis,
            'warna_subjenis' => $request->warna_subjenis
        ]
        );
    
        return redirect()->route('subtypes.index')
                        ->with('success','Subjenis created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\subjenis  $subjenis
     * @return \Illuminate\Http\Response
     */
    public function show(Subtype $subtype)
    {
        return view('subtypes.show',compact('subtype'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $subjenis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subtype = DB::table('subtypes')->where('id_subjenis', $id)->first();
        return view('subtypes.edit',compact('subtype'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subjenis  $subjenis
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
         $request->validate([
            'id_subjenis' => 'required',
            'subjenis' => 'required',
            'skin_subjenis' => 'required',
            'warna_subjenis' => 'required',
        ]);
       //$game->update($request->all());
       DB::update('UPDATE subtypes SET id_subjenis = :id_subjenis, subjenis = :subjenis,skin_subjenis = :skin_subjenis ,warna_subjenis = :warna_subjenis WHERE id_subjenis = :id',
        [
            'id' => $id,
            'id_subjenis' => $request->id_subjenis,
            'subjenis' => $request->subjenis,
            'skin_subjenis' => $request->skin_subjenis,
            'warna_subjenis' => $request->warna_subjenis,
           
        ]
        );
        return redirect()->route('subtypes.index')
                        ->with('success','Subjenis updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subjenis  $subjenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('UPDATE subtypes SET deleted_at = NOW() WHERE id_subjenis = :id_subjenis', ['id_subjenis' => $id]);
    
        return redirect()->route('subtypes.index')
                        ->with('success','Subjenis deleted successfully');
    }
    
    public function deletelist()
    {
        $subjeniss = DB::table('subtypes')
                    ->whereNotNull('deleted_at')
                    ->paginate(6);
        return view('/subtypes/trash',compact('subjeniss'))
            ->with('i', (request()->input('page', 1) - 1) * 6);

    }
    public function restore($id)
    {
        DB::update('UPDATE subtypes SET deleted_at = NULL WHERE id_subjenis = :id_subjenis', ['id_subjenis' => $id]);
        return redirect()->route('subtypes.index')
                        ->with('success',' Subjenis Restored successfully');
    }
    public function deleteforce($id)
    {
        DB::delete('DELETE FROM subtypes WHERE id_subjenis=:id_subjenis', ['id_subjenis' => $id]);
        return redirect()->route('subtypes.index')
                        ->with('success','Subjenis Deleted Permanently');
    }
}