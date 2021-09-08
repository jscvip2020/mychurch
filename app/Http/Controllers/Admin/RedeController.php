<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rede;
use Illuminate\Http\Request;

class RedeController extends Controller
{
    protected $model = Rede::class;
    protected $folder = 'admin.redes';
    protected $name = 'rede';
    protected $plural = 'redes';

    /**
     * RedeController constructor.
     */
    function __construct()
    {
        $this->middleware('permission:'.$this->name.'-list|'.$this->name.'-create|'.$this->name.'-edit|'.$this->name.'-delete', ['only' => ['index']]);
        $this->middleware('permission:'.$this->name.'-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:'.$this->name.'-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:'.$this->name.'-delete', ['only' => ['destroy']]);
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
                    $rows = $this->model::where('nome', 'LIKE', '%' . $busca . '%')
                        ->orderBy('nome', 'ASC')->paginate(10)->appends('search', $busca);
                }else {
                    $rows = $this->model::orderBy('nome','ASC')->paginate(10);
                }
                return view($this->folder.'.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->folder.'.create');
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
        $this->validate($request,[
           'nome' => 'required',
           'icone' => 'required',
        ],
            [
                'icone.required' => 'O campo Rede Social é Obrigatório.',
            ]);
        if($request->url==null) {
            $request["url"] = '#';
        }

        $action = $this->model::create($request->all());

        if($action) {
            return redirect()->route($this->plural . '.index')->with('success', 'CRIADO com sucesso!!!');
        }else{
            return redirect()->route($this->plural.'.index')->with('error','Não foi possível CRIAR!!!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->model::findOrFail($id);

        return view($this->folder.'.edit',['row'=>$row]);
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
        $this->validate($request,[
            'nome' => 'required',
            'icone' => 'required',
        ],
            [
                'icone.required' => 'O campo Rede Social é Obrigatório.',
            ]);
        if($request->url==null) {
            $request["url"] = '#';
        }

        $data = $this->model::findOrFail($id);

        $action = $data->update($request->all());

        if($action) {
            return redirect()->route($this->plural . '.index')->with('success', 'ATUALIZADO com sucesso!!!');
        }else{
            return redirect()->route($this->plural.'.index')->with('error','Não foi possível ATUALIZAR!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model::findOrFail($id);

        $action = $data->delete();

        if ($action) {
            return redirect()->route($this->plural . '.index')->with('success', 'DELETADO com sucesso!!!');
        } else {
            return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível DELETAR!!!');
        }
    }
}
