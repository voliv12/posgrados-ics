<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->matricula = $this->session->userdata('matricula');
    }

    function registroReportes()
    {
        if ($this->session->userdata('logged_in'))
        {
                $this->session->keep_flashdata('matricula');
                $this->session->keep_flashdata('nombre');
                $crud = new grocery_CRUD();
                $crud->where('Alumno_Matricula', $this->session->flashdata('matricula'));
                $crud->set_table('reportecnico');
                $crud->set_subject('Reporte');
                $crud->columns( 'TituloRepor','Instancia','Objetivoreport','DocRecTec');
                $crud->display_as('Alumno_Matricula','Nombre del alumno')->display_as('TituloRepor','Titulo del Reporte')->display_as('Instancia','Instancia a la que se presenta el Reporte')->display_as('RDescripcion','Descripción del Reporte')
                     ->display_as('NumpagRepor','No. Páginas')->display_as('fechaReport','Fecha')
                     ->display_as('Objetivoreport','Objetivo del reporte')
                     ->display_as('Autores','Autor/es')->display_as('DocRecTec','Doc. comprobatorio');
                $crud->set_relation('Alumno_Matricula','alumno','{NombreA}  -  {ApellidoPA}  -  {ApellidoMA}');
                $crud->unset_print();
                $crud->unset_export();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud-> unset_edit_fields ( 'Alumno_Matricula');
                $crud->required_fields('TituloRepor','Instancia','Objetivoreport','fechaReport');
                $crud->set_field_upload('DocRecTec','assets/uploads/alumnos/'.$this->session->flashdata('matricula'));
                $crud->unset_texteditor('RDescripcion','full_text');
                $crud->unset_texteditor('Objetivoreport','full_text');
                $crud->unset_texteditor('Autores','full_text');
                $crud->set_rules('DocRecTec','Doc. comprobatorio','max_length[26]');
                $output = $crud->render();
                $this->_example_output($output);
        }
        else {
                redirect('login');
                }
    }


    function _example_output($output = null)
    {
        $output->titulo_tabla = "Reportes Técnicos";
        $output->barra_navegacion = " <li><a href='directivo'> Menú principal </a></li>  |  <li> <a href='cvu_alumnosDirectivos/datos_personales/registroAlumno'> Listado de alumnos </a></li>  |  <li> <a href='alumnoscvu/menu/".$this->session->flashdata('matricula')."/".$this->session->flashdata('nombre')."'> Menú CVU alumno </a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view_cvu', $output, TRUE);
        $this->load->view('plantilla_directivo', $datos_plantilla);
    }
}

