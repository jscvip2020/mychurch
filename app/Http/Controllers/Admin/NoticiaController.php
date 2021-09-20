<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Image;
use File;

class NoticiaController extends Controller
{
    protected $model = Noticia::class;
    protected $folder = 'admin.noticias';
    protected $name = 'noticia';
    protected $plural = 'noticias';


    /**
     * NoticiaController constructor.
     */
    function __construct()
    {
        $this->middleware('permission:' . $this->name . '-list|' . $this->name . '-create|' . $this->name . '-edit|' . $this->name . '-delete', ['only' => ['index']]);
        $this->middleware('permission:' . $this->name . '-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:' . $this->name . '-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . $this->name . '-delete', ['only' => ['destroy']]);
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
            $rows = $this->model::where('titulo', 'LIKE', '%' . $busca . '%')
                ->orWhere('texto', 'LIKE', '%' . $busca . '%')
                ->orderBy('dest_principal', 'DESC')->orderBy('destaque', 'DESC')
                ->orderBy('id', 'DESC')->paginate(10)->appends('search', $busca);
        } else {
            $rows = $this->model::orderBy('dest_principal', 'DESC')->orderBy('destaque', 'DESC')->orderBy('id', 'DESC')->paginate(10);
        }
        return view($this->folder . '.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->folder . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|string|max:255',
            'capa' => 'required|mimes:jpg,png',
            'slug' => 'required',
            'resumo' => 'required',
            'texto' => 'required|min:50',
            'publisher' => 'required'
        ], [
            'capa.required' => 'É preciso escolher uma capa para a notícia.'
        ]);

        $action = $this->model::create([
            'titulo' => $request->titulo,
            'capa' => '',
            'slug' => $request->slug,
            'resumo' => $request->resumo,
            'texto' => $request->texto,
            'publisher' => $request->publisher
        ]);

        if ($action) {
            $image = $request->file('capa');
            $data = $this->model::findOrFail($action->id);
            if ($image) {
                $imagenome = 'capa_' . $data->id . '.' . $image->extension();
                $success = $data->update(['capa' => $imagenome]);

                if ($success) {
                    $img = Image::make($image->path())->resize(800, 600)->save('images/noticias/' . $imagenome);
                } else {
                    $img = false;
                }
                if ($img) {
                    return redirect()->route($this->plural . '.index')->with('success', 'CAPA e noticia ADICIONADO com sucesso!!!');
                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Noticia Adiconada. Mas não foi possível adicionar a CAPA!!!');
                }
            }
            return redirect()->route($this->plural . '.index')->with('success', 'Notícia adicionada sem capa!!!');
        } else {
            return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível adicionar!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Noticia::findOrFail($id);

        return view($this->folder . '.edit', compact('row'));
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
            'titulo' => 'required|string|max:255',
            'capa' => 'required|mimes:jpg,png',
            'slug' => 'required',
            'resumo' => 'required',
            'texto' => 'required|min:50',
            'publisher' => 'required'
        ], [
            'capa.required' => 'É preciso escolher uma capa para a notícia.'
        ]);

        $data = $this->model::findOrFail($id);
        $action = $data->update($request->all());

        if ($action) {
            $image = $request->file('capa');
            $old_capa = $request->old_capa;
            if ($image) {
                $imagenome = 'capa_' . $id . '.' . $image->extension();
                $success = $data->update(['capa' => $imagenome]);

                if ($success) {
                    if ($old_capa && $old_capa != '') {
                        $file_path = "images/noticias/" . $old_capa;
                        if (file_exists($file_path)) {
                            if (File::delete($file_path)) {
                                $img = Image::make($image->path())->resize(800, 600)->save('images/noticias/' . $imagenome);
                            } else {
                                $data->update(['capa' => $data->capa]);
                            }
                        }else{
                            $img = Image::make($image->path())->resize(800, 600)->save('images/noticias/' . $imagenome);
                        }
                    } else {
                        $img = Image::make($image->path())->resize(800, 600)->save('images/noticias/' . $imagenome);
                    }

                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível trocar o CAPA!!!');
                }
                if ($img) {
                    return redirect()->route($this->plural . '.index')->with('success', 'CAPA trocada e noticia atualizada com sucesso!!!');
                } else {
                    return redirect()->route($this->plural . '.index')->with('error', 'Noticia atualizada. Não foi possível trocar o CAPA!!!');
                }
            }
            return redirect()->route($this->plural . '.index')->with('success', 'Atualizado com sucesso!!!');
        } else {
            return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível atualizar!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = '';

        $data = $this->model::findOrFail($id);
        $file_path = "images/noticias/" . $data->capa;
        if(!$data->capa){
            $action = $data->delete();
        }else {
            if (file_exists($file_path)) {
                if (File::delete($file_path)) {
                    $action = $data->delete();
                }
            }else {
                $action = $data->delete();
            }
        }
        if ($action) {
            return redirect()->route($this->plural.'.index')->with('success', "DELETADO com sucesso!");
        } else {
            return redirect()->route($this->plural.'.index')->with('error', "Não foi possível DELETAR!");
        }
    }


    /**
     * @param $small
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pequena($small, $id)
    {


        $data = $this->model::findOrFail($id);
        $total_desc = $this->model::where('status', 1)->where('destaque', 1)->get();

        if ($small) {
            if ($data->dest_principal) {
                return redirect()->route($this->plural . '.index')->with('error', "Não é possível modificar esse DESTAQUE. Porque ele é DESTAQUE PRINCIPAL. Escolha outro DESTAQUE PRINCIPAL. Ou desmarque esse DESTAQUE PRINCIPAL!!!");
            } else {
                $action = $data->update(['destaque' => !$small]);
            }
        } else {
            if (count($total_desc) > 2) {
                return redirect()->route($this->plural . '.index')->with('error', "Não é possível modificar esse DESTAQUE. Já existem três DESTAQUES selecionados. Desmarque um DESTAQUE!!!");
            } else {
                $action = $data->update(['destaque' => !$small]);
            }
        }


        if ($action) {
            return redirect()->route($this->plural . '.index')->with('success', 'DESTAQUE Atualizado com sucesso!!!');
        } else {
            return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível atualizar DESTAQUE!!!');
        }
    }

    /**
     * @param $big
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function grande($big, $id)
    {
        $items = $this->model::all();
        $data = $this->model::findOrFail($id);

        $total_desc = $this->model::where('status', 1)->where('destaque', 1)->get();


        if ($big) {
            foreach ($items as $item) {
                $item->update(['dest_principal' => 0]);
            }
            $action = $data->update(['dest_principal' => !$big]);
        } else {
            if ($data->destaque) {
                $data->update(['destaque' => 1]);
                foreach ($items as $item) {
                    $item->update(['dest_principal' => 0]);
                }
                $action = $data->update(['dest_principal' => !$big]);
            } else {
                if (count($total_desc) > 2) {
                    return redirect()->route($this->plural . '.index')->with('error', "Não é possível modificar esse DESTAQUE PRINCIPAL. Já existem três DESTAQUES selecionados. Desmarque um DESTAQUE ou selecione um DESTAQUE PRINCIPAL entre os DESTAQUES selecionados!!!");
                } else {
                    $data->update(['destaque' => 1]);
                    foreach ($items as $item) {
                        $item->update(['dest_principal' => 0]);
                    }
                    $action = $data->update(['dest_principal' => !$big]);
                }
            }
        }
        if ($action) {
            return redirect()->route($this->plural . '.index')->with('success', 'PRINCIPAL Atualizado com sucesso!!!');
        } else {
            return redirect()->route($this->plural . '.index')->with('error', 'Não foi possível atualizar PRINCIPAL!!!');
        }
    }
}
