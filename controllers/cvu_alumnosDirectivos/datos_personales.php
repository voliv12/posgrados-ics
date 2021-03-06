<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datos_personales extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
    }

    function registroAlumno()
    {
        if ($this->session->userdata('logged_in'))
        {
                $crud = new grocery_CRUD();
                $crud->where('nivel',$this->session->userdata('abrev_posgrado'));
                $crud->set_table('alumnoscvu');
                $crud->set_primary_key('matricula');
                $crud->set_subject('cat_posgrados_alumno')
                     ->display_as('nivel','Posgrado')
                     ->display_as('idalumno','Alumno')
                     ->display_as('inicio','Año de inicio')
                     ->display_as('NombreA','Nombre')
                     ->display_as('ApellidoPA','Apellido Paterno')
                     ->display_as('ApellidoMA','Apellido Materno');
                $crud->columns('matricula','nivel','NombreA','ApellidoPA','ApellidoMA','estatus','inicio','termino');
                $crud->add_action('CVU de alumno', '../assets/imagenes/folderr.png','', '',array($this,'just_a_test'));
                $crud->unset_add ( ) ;
                $crud->unset_delete();
                $crud->unset_print();
                $crud->unset_export();
                $crud->unset_edit();
                $output = $crud->render();

                $this->_example_output($output);
         }
        else {
                redirect('login');
                }
    }



    function just_a_test($primary_key , $row)
    {
        $nombre = $row->NombreA." ".$row->ApellidoPA." ".$row->ApellidoMA;
        return site_url('alumnoscvu/menu/'.$row->matricula.'/'.$nombre);
    }


    function _example_output($output = null)

    {   $output->titulo_tabla = "Consulta de CVU de Alumnos";

        if($this->session->userdata('perfil') == 'Director Instituto')
            {

            $output->barra_navegacion = " <li><a href='director'>Menú principal</a></li>";
            $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
            $this->load->view('plantilla_director', $datos_plantilla);
            } 
                else {
                        $output->barra_navegacion = " <li><a href='directivo'>Menú principal</a></li>";
                        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
                        $this->load->view('plantilla_directivo', $datos_plantilla);
                       }

    }
}
