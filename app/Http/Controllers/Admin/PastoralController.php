<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pastoral;
use Illuminate\Http\Request;
use Image;
use File;

class PastoralController extends Controller
{

    protected $model = Pastoral::class;
    protected $folder = 'admin.pastorais';
    protected $name = 'pastoral';
    protected $plural = 'pastorais';

    /**
     * PastoralController constructor.
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
            $rows = Pastoral::where('nome', 'LIKE', '%' . $busca . '%')
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
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|mimes:jpg,png',
        ]);

        $action = $this->model::create([
            'nome' => $request->nome,
        ]);
        if($action){
            $image = $request->file('imagem');
            $data = $this->model::findOrFail($action->id);
            if($image) {
                $imagenome = 'imagem_' . $data->id . '.' . $image->extension();
                $success = $data->update(['imagem' => $imagenome]);

                if ($success) {
                    $img = Image::make($image->path())->resize(170, 170)->save('images/pastoral/' . $imagenome);

                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível adicionar o IMAGEM!!!');
                }
                if ($img) {
                    return redirect()->route($this->plural . '.index')->with('success', 'IMAGEM adicionada com sucesso!!!');
                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível adicionar o IMAGEM!!!');
                }
            }

            return redirect()->route($this->plural.'.index')->with('success', 'CRIADO com sucesso!!');
        }else {
            return redirect()->route($this->plural . '.index')->with('success', 'CRIADO com sucesso!!');
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
        $row = Pastoral::findOrFail($id);

        return view($this->folder.'.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *p
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|mimes:jpg,png',
        ]);
        $data = $this->model::findOrFail($id);
        $action = $data->update($request->all());

        if($action){
            $image = $request->file('imagem');
            if($image) {
                $imagenome = 'imagem_' . $id . '.' . $image->extension();
                $success = $data->update(['imagem' => $imagenome]);

                if ($success) {
                    $img = Image::make($image->path())->resize(170, 170)->save('images/pastoral/' . $imagenome);

                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível trocar o IMAGEM!!!');
                }
                if ($img) {
                    return redirect()->route($this->plural . '.index')->with('success', 'IMAGEM trocado com sucesso!!!');
                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível trocar o IMAGEM!!!');
                }
            }
            return redirect()->route($this->plural . '.index')->with('success','Atualizado com sucesso!!!');
        }else{
            return redirect()->route($this->plural . '.index')->with('error','Não foi possível atualizar!!!');
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
        $action = '';

        $data = $this->model::findOrFail($id);
        $file_path = "images/pastoral/" . $data->imagem;
        if(!$data->imagem){
            $action = $data->delete();
        }else {
            if (file_exists($file_path)) {
                if (File::delete($file_path)) {
                    $action = $data->delete();
                }
            }
        }
        if ($action) {
            return redirect()->route($this->plural.'.index')->with('success', "DELETADO com sucesso!");
        } else {
            return redirect()->route($this->plural.'.index')->with('error', "Não foi possível DELETAR!");
        }
    }
}
