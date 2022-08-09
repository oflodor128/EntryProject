<?php
namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {    //Muestra el contenido del archivo welcome_message.php, solicitando en el url localhost:8080
        return view('welcome_message');
    }
    // Metodo para verificar que que la pagina solicitada existe
    //Carga mediante el metodo view(), las vistas en el orden que deben ser desplegadas
    //El segundo parametro view() usado para pasar valores a las vistas('home').
    public function view($page = 'home')
    {           //Valida si el archivo esta donde debe estar
                //Se solicita el archivo mediante la url: localhost:8080/NombreArchivo.php
        if(! is_file(APPPATH . 'Views/pages/' .$page . '.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        //Asigna el valor de la variable a data para pasarlo al titulo del templete en title
        $data['title'] = ucfirst($page); //Primera letra en mayuscula
        //Cada valor en el arreglo $data es asignado  a una variable con el nombre de su llave.
       
       //Despliega el valor indicado en las distintas ubicaciones a traves del metodo view().
        return view('templates/header', $data)
        . view('pages/' . $page)
        . view('templates/footer');
    }
}