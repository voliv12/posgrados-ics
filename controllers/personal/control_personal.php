<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_personal extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */
        $this->load->library('grocery_CRUD');
        //$this->matricula = $this->session->userdata('matricula');
    }

    function registrar_personal()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('personal');
        $crud->set_subject('Personal');
        $output = $crud->render();

        $this->_example_output($output);
    }

    function _example_output($output = null)

    {
        $output->titulo_tabla = "Control de Personal";
        $output->barra_navegacion = " <li><a href='administrador'>Menú principal</a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_personal', $datos_plantilla);
    }
}