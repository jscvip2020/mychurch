<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function status($status,$id)
    {
        $data = $this->model::findOrFail($id);

        $action = $data->update(['status' => !$status]);

        if($action){
            return redirect()->route($this->plural . '.index')->with('success','STATUS Atualizado com sucesso!!!');
        }else{
            return redirect()->route($this->plural . '.index')->with('error','Não foi possível atualizar STATUS!!!');
        }
    }
}
