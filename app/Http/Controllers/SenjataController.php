<?php
    
    namespace App\Http\Controllers;
        
    use App\Models\Senjata;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
        
    class SenjataController extends Controller
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
            $senjatas = DB::table('senjatas')
                        ->where('nama_senjata','LIKE','%'.$keyword.'%')
                        ->whereNull('deleted_at')
                        ->paginate(6);
            return view('senjatas.index',compact('senjatas'))
                    ->with('i', (request()->input('page', 1) - 1) * 6);
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('senjatas.create');
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
                'id_senjata' => 'required',
                'nama_senjata' => 'required',
                'harga' => 'required',
                'id_subjenis' => 'required',
                'id_jenis' => 'required',
            ]);
        
            DB::insert('INSERT INTO senjatas(id_senjata,nama_senjata,harga,id_subjenis, id_jenis) VALUES (:id_senjata, :nama_senjata,:harga ,:id_subjenis, :id_jenis)',
            [
                'id_senjata' => $request->id_senjata,
                'nama_senjata' => $request->nama_senjata,
                'harga' => $request->harga,
                'id_subjenis' => $request->id_subjenis,
                'id_jenis' => $request->id_jenis,
            ]
            );
        
            return redirect()->route('senjatas.index')
                            ->with('success','Senjata created successfully.');
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\senjata  $senjata
         * @return \Illuminate\Http\Response
         */
        public function show(Senjata $senjata)
        {
            return view('senjatas.show',compact('senjata'));
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Senjata  $senjata
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $senjata = DB::table('senjatas')->where('id_senjata', $id)->first();
            return view('senjatas.edit',compact('senjata'));
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Senjata  $senjata
         * @return \Illuminate\Http\Response
         */
        public function update($id, Request $request)
        {
             $request->validate([
                'id_senjata' => 'required',
                'nama_senjata' => 'required',
                'harga' => 'required',
                'id_subjenis' => 'required',
                'id_jenis' => 'required'
            ]);
           //$senjata->update($request->all());
            DB::update('UPDATE senjatas SET id_senjata = :id_senjata, nama_senjata = :nama_senjata,harga = :harga ,id_subjenis = :id_subjenis, id_jenis = :id_jenis WHERE id_senjata = :id',
            [
                'id' => $id,
                'id_senjata' => $request->id_senjata,
                'nama_senjata' => $request->nama_senjata,
                'harga' => $request->harga,
                'id_subjenis' => $request->id_subjenis,
                'id_jenis' => $request->id_jenis,
               
            ]
            );
            return redirect()->route('senjatas.index')
                            ->with('success','Senjata updated successfully');
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Senjata  $senjata
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            DB::update('UPDATE senjatas SET deleted_at = NOW() WHERE id_senjata = :id_senjata', ['id_senjata' => $id]);
        
            return redirect()->route('senjatas.index')
                            ->with('success','Senjata deleted successfully');
        }
        
        public function deletelist()
        {
            $senjatas = DB::table('senjatas')
                        ->whereNotNull('deleted_at')
                        ->paginate(6);
            return view('/senjatas/trash',compact('senjatas'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    
        }
        public function restore($id)
        {
            DB::update('UPDATE senjatas SET deleted_at = NULL WHERE id_senjata = :id_senjata', ['id_senjata' => $id]);
            return redirect()->route('senjatas.index')
                            ->with('success','Senjata Restored successfully');
        }
        public function deleteforce($id)
        {
            DB::delete('DELETE FROM senjatas WHERE id_senjata=:id_senjata', ['id_senjata' => $id]);
            return redirect()->route('senjatas.index')
                            ->with('success','Senjata Deleted Permanently');
        }
    }
