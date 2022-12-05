<?php
    
    namespace App\Http\Controllers;
        
    use App\Models\Type;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
        
    class TypeController extends Controller
    { 
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        function __construct()
        {
             $this->middleware('permission:type-list|type-create|type-edit|type-delete', ['only' => ['index','show']]);
             $this->middleware('permission:type-create', ['only' => ['create','store']]);
             $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:type-delete', ['only' => ['destroy','deletelist']]);
        }
        
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $keyword = $request->keyword;
            $types = DB::table('types')
                        ->where('type','LIKE','%'.$keyword.'%')
                        ->whereNull('deleted_at')
                        ->paginate(6);
            return view('types.index',compact('types'))
                    ->with('i', (request()->input('page', 1) - 1) * 6);
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('types.create');
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
                'id_type' => 'required',
                'type' => 'required',
                'Abilities' => 'required',
                'Armor' => 'required',
            ]);
        
            DB::insert('INSERT INTO types(id_type,type,Abilities,Armor) VALUES (:id_type,:type,:Abilities,:Armor)',
            [
                'id_type' => $request->id_type,
                'type' => $request->type,
                'Abilities' => $request->Abilities,
                'Armor' => $request->Armor,
            ]
            );
        
            return redirect()->route('types.index')
                            ->with('success','Type created successfully.');
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\type  $type
         * @return \Illuminate\Http\Response
         */
        public function show(Type $type)
        {
            return view('types.show',compact('type'));
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Type  $type
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $type = DB::table('types')->where('id_type', $id)->first();
            return view('types.edit',compact('type'));
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Type  $type
         * @return \Illuminate\Http\Response
         */
        public function update($id, Request $request)
        {
             $request->validate([
                'id_type' => 'required',
                'type' => 'required',
                'Abilities' => 'required',
                'Armor' => 'required',
            ]);
           //$type->update($request->all());
            DB::update('UPDATE types SET id_type = :id_type, type = :type,Abilities = :Abilities ,Armor = :Armor WHERE id_type = :id',
            [
                'id' => $id,
                'id_type' => $request->id_type,
                'type' => $request->type,
                'Abilities' => $request->Abilities,
                'Armor' => $request->Armor,
               
            ]
            );
            return redirect()->route('types.index')
                            ->with('success','Type updated successfully');
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Type  $type
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            DB::update('UPDATE types SET deleted_at = NOW() WHERE id_type = :id_type', ['id_type' => $id]);
        
            return redirect()->route('types.index')
                            ->with('success','Type deleted successfully');
        }
        
        public function deletelist()
        {
            $types = DB::table('types')
                        ->whereNotNull('deleted_at')
                        ->paginate(6);
            return view('/types/trash',compact('types'))
                ->with('i', (request()->input('page', 1) - 1) * 6);
    
        }
        public function restore($id)
        {
            DB::update('UPDATE types SET deleted_at = NULL WHERE id_type = :id_type', ['id_type' => $id]);
            return redirect()->route('types.index')
                            ->with('success','Type Restored successfully');
        }
        public function deleteforce($id)
        {
            DB::delete('DELETE FROM types WHERE id_type=:id_type', ['id_type' => $id]);
            return redirect()->route('types.index')
                            ->with('success','Type Deleted Permanently');
        
        }
    }