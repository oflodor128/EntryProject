<?php
//Los models son utilizados en CodeIgniter para extraer, insertar y modificar informacion de las bases de datos -->
namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{     //Nombre de la table dentro de la BD
    protected $table = 'news';

    protected $allowedFields = ['title', 'slug', 'body'];

    public function getNews($slug = false)
    {
        // findAll() y first() son metodos helper usados por el Query Builder para correr sus comandos en la tabla
        // Retornan como resultado un arreglo en el formato de tu eleccion.
        if($slug === false){
            //Retorna un arreglo de un arreglo.
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
    
}