<?php
namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    //Funcion para mostrar las noticias
    public function index()
    {                   
        $model = model(NewsModel::class);//Instancia del helper
        //Tambien se puede usar $model = new NewsModel();

        //Toma todos los registros del model y los asigna a una variable
        $data = [
            'news' => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/overview')
            . view('templates/footer');
    }
    //Funcion para especificar los nuevos objetos
    //$slug es utilizada para identificar las noticas a mostrar
    public function view($slug = null)
    {
        $model = model(NewsModel::class);
        //Se obtiene la noticia a traves de $slug
        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            //En vez de utilizar el metodo getNews() sin un parametro, la variable $slug pasa para retornar el objeto de news especifico.
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item; ' . $slug);
        }
        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

    public function create()
    {
        $model = model(NewsModel::class);
        if($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
        ])) {
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('title'), '-', true),
                'body' => $this->request->getPost('body'),
            ]);

            return view('news/success');
        }

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    }
}