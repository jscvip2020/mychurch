<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $model = User::class;
    protected $folder = 'admin.usuarios';
    protected $name = 'user';
    protected $plural = 'usuarios';

    function __construct()
    {
        $this->middleware('permission:'.$this->name.'-list|'.$this->name.'-create|'.$this->name.'-edit|'.$this->name.'-delete', ['only' => ['index']]);
        $this->middleware('permission:'.$this->name.'-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:'.$this->name.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'.$this->name.'-delete', ['only' => ['destroy']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $busca = $request->search;
            $rows = User::where('name', 'LIKE', '%' . $busca . '%')
                ->orWhere('email', 'LIKE', '%' . $busca . '%')
                ->orderBy('name', 'ASC')->paginate(10)->appends('search', $busca);
        }else {
            $rows = $this->model::orderBy('name','ASC')->paginate(10);
        }
        return view($this->folder.'.index', compact('rows'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $row = $this->model::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $row->roles->pluck('name','name')->all();

        return view($this->folder.'.edit', compact('row','roles','userRole'));

    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'usuario' => 'required|string|max:50|unique:users,usuario,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'roles' => 'required',
        ], [
            'roles.required' => 'O campo Regras é obrigatório.',
         ]);
        $data = $this->model::findOrFail($id);
        $action = $data->update($request->all());

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $data->assignRole($request->input('roles'));

        if($action){
            return redirect()->route($this->plural . '.index')->with('success','Atualizado com sucesso!!!');
        }else{
            return redirect()->route($this->plural . '.index')->with('error','Não foi possível atualizar!!!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);
        $action = $data->delete();
        if($action){
            return redirect()->route($this->plural . '.index')->with('success','Deletado com sucesso!!!');
        }else{
            return redirect()->route($this->plural . '.index')->with('error','Não foi possível deletar!!!');
        }
    }
}
