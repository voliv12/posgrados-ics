<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conacyt extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */
        $this->load->library('grocery_CRUD');
        $this->matricula = $this->session->userdata('matricula');
    }

    function registroConacyt()
    {   $crud = new grocery_CRUD();
        $crud->where('Alumno_Matricula', $this->matricula);
        $crud->set_table('apoyoconacyt');
        $crud->set_subject('Apoyo CONACYT');
    
        $crud->field_type('Alumno_Matricula', 'hidden',$this->matricula );
        $crud->columns( 'idSubProgCONACYT','TipoApoyo','NumApoyo','CFechaFin');
        $crud->set_relation('idSubProgCONACYT','subprogconacyt','Nombre');
        $crud->display_as('idSubProgCONACYT','Subprograma CONACYT')->display_as('NumApoyo','No. de Apoyo')->display_as('TipoApoyo','Tipo de Apoyo')
             ->display_as('CFechaIni','Fecha de Inicio')->display_as('CFechaFin','Fecha de Finalización');
        
        $crud-> unset_edit_fields ( 'Alumno_Matricula');
        $output = $crud->render();

        $this->_example_output($output);
    }
    

    function _example_output($output = null)
    {
        $output->titulo_tabla = "Registro de Apoyos CONACYT";
        $output->barra_navegacion = " <li><a href='alumno'>Menú principal</a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_alumnos', $datos_plantilla);
    }
}
