<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * PermissionController constructor.
     */
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $busca = $request->search;
            $permissions = Permission::where('name', 'LIKE', '%' . $busca . '%')
                ->orderBy('id', 'ASC')->paginate(8)->appends('search', $busca);
        }else {
            $permissions = Permission::orderBy('id', 'ASC')->paginate(8);
        }
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permissions = [
            strtolower($request->input('name')).'-list',
            strtolower($request->input('name')).'-create',
            strtolower($request->input('name')).'-edit',
            strtolower($request->input('name')).'-delete',
        ];

        $role = Role::where('name','SuperAdmin')->first();
        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        return redirect()->route('permissions.index')->with('success', 'Permissões criadas com sucesso!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);


        return view('admin.permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $list = Permission::where('name',$request->oldname.'-list')->first();
        $create = Permission::where('name',$request->oldname.'-create')->first();
        $edit = Permission::where('name',$request->oldname.'-edit')->first();
        $delete = Permission::where('name',$request->oldname.'-delete')->first();

        $list->name = $request->name.'-list';$list->save();
        $create->name = $request->name.'-create';$create->save();
        $edit->name = $request->name.'-edit';$edit->save();
        $delete->name = $request->name.'-delete';$delete->save();

        return redirect()->route('permissions.index')->with('success', 'Permissões alteradas com sucesso!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $model =explode("-",$permission->name)[0];

        $list = Permission::where('name',$model.'-list')->first();
        $create = Permission::where('name',$model.'-create')->first();
        $edit = Permission::where('name',$model.'-edit')->first();
        $delete = Permission::where('name',$model.'-delete')->first();

        $list->delete(); $create->delete(); $edit->delete(); $delete->delete();

        return redirect()->route('permissions.index')->with('success', 'Permissões deletadas com successo!!!');
    }
}
