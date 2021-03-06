<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resenia extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->matricula = $this->session->userdata('matricula');
    }

    function registroResenia()
    {
        if ($this->session->userdata('logged_in'))
        {
                $crud = new grocery_CRUD();
                $crud->where('Alumno_Matricula', $this->matricula);
                $crud->set_table('resenia');
                $crud->set_subject('Reseña');

                $crud->field_type('Alumno_Matricula', 'hidden',$this->matricula );
                $crud->columns( 'TituloRese','TituloObra','TipoPublica','TituloPublica','DocRese');
                $crud->display_as('TituloRese','Titulo de la Reseña')->display_as('TituloObra','Titulo de la Obra')->display_as('TipoPublica','Tipo de Publicación')
                     ->display_as('AnioRe','Año')->display_as('pagInc',' De la Pag')->display_as('pagFin','A la Pag')->display_as('TituloPublica','Titulo de la Publicación')
                     ->display_as('Pais','País')->display_as('autorRese','Autor/es')->display_as('DocRese','Doc. comprobatorio');
                $crud->unset_print();
                $crud->unset_export();
                $crud->field_type('AnioRe','dropdown',range(2000, 2030));
                $crud-> unset_edit_fields ( 'Alumno_Matricula');
                $crud->required_fields( 'TituloRese','TipoPublica','autorRese');
                $crud->set_field_upload('DocRese','assets/uploads/alumnos/'.$this->matricula);
                $crud->unset_texteditor('autorRese','full_text');
                $crud->set_rules('DocRese','Doc. comprobatorio','max_length[26]');
                $crud->set_relation('Pais','paises','nombre');
                $output = $crud->render();
                $this->_example_output($output);
        }
        else {
                redirect('login');
                }
    }


    function _example_output($output = null)
    {
        $output->titulo_tabla = "Registro de Reseñas";
        $output->barra_navegacion = " <li><a href='principal'> Menú principal </a></li>  |  <li> <a href='alumno'> Menú CVU </a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_alumnos', $datos_plantilla);
    }
}

