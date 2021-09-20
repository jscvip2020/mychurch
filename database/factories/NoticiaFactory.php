<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoticiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Noticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titulo = $this->faker->sentence(4);
        $slug = Str::slug($titulo,'-');
        $texto = $this->faker->paragraphs(5,true);
        $resultado = explode("\n\n",$texto);
        $resumo = $resultado[0];
        return [
            'titulo' => $titulo,
            'slug' => $slug,
            'resumo' => $resumo,
            'texto' => $texto,
            'capa' => "",
            'publisher' => "Jose Sergio Cordeiro"
        ];
    }
}
