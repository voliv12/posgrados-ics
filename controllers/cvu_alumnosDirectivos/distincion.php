<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distincion extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->matricula = $this->session->userdata('matricula');
    }

    function registroDistincion()
    {
        if ($this->session->userdata('logged_in'))
        {
                $this->session->keep_flashdata('matricula');
                $this->session->keep_flashdata('nombre');
                $crud = new grocery_CRUD();
                $crud->where('Alumno_Matricula', $this->session->flashdata('matricula'));
                $crud->set_table('premiodistincion');
                $crud->set_subject('Distinciones y Premios');
                $crud->columns(  'Titulos','Otorgante','Institucion-otorgante','AnioP','DocPremio');
                $crud->display_as('Alumno_Matricula','Nombre del alumno')->display_as('Titulos','Titulo de la Distinción')->display_as('AnioP','Año')->display_as('Pais','País')->display_as('Otorgante','Otorgante')
                     ->display_as('Institucion-otorgante','Institución Otorgante')->display_as('PDescripcion','Descripción de la Distinción')->display_as('DocPremio','Doc. comprobatorio');
                $crud->set_relation('Alumno_Matricula','alumno','{NombreA}  -  {ApellidoPA}  -  {ApellidoMA}');
                $crud->unset_print();
                $crud->unset_export();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->field_type('AnioP','dropdown',range(2000, 2030));
                $crud-> unset_edit_fields ( 'Alumno_Matricula');
                $crud->required_fields('Titulos','PDescripcion','AnioP');
                $crud->set_field_upload('DocPremio','assets/uploads/alumnos/'.$this->session->flashdata('matricula'));
                $crud->set_relation('Pais','paises','nombre');
                $crud->unset_texteditor('PDescripcion','full_text');
                $crud->unset_texteditor('Descripcion','full_text');
                $crud->set_rules('DocPremio','Doc. comprobatorio','max_length[26]');

                $output = $crud->render();
                $this->_example_output($output);
        }
        else {
                redirect('login');
                }
    }


    function _example_output($output = null)
    {
        $output->titulo_tabla = "Distinciones y Premios";
        $output->barra_navegacion = " <li><a href='directivo'> Menú principal </a></li>  |  <li> <a href='cvu_alumnosDirectivos/datos_personales/registroAlumno'> Listado de alumnos </a></li>  |  <li> <a href='alumnoscvu/menu/".$this->session->flashdata('matricula')."/".$this->session->flashdata('nombre')."'> Menú CVU alumno </a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view_cvu', $output, TRUE);
        $this->load->view('plantilla_directivo', $datos_plantilla);
    }
}

