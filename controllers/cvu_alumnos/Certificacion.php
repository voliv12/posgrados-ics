<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Certificacion extends CI_Controller {

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

    function registroCertificacion()
    {   $crud = new grocery_CRUD();
        $crud->where('Alumno_Matricula', $this->matricula);
        $crud->set_table('certifimedica');
        $crud->set_subject('Certificaciones Medicas');
    
        $crud->field_type('Alumno_Matricula', 'hidden',$this->matricula );
        $crud->columns( 'NumFolio','Referencia','Especialidad','TipoCert');
        $crud->display_as('NumFolio','No. de folio por certificación')->display_as('Referencia','Otra Referencia')->display_as('CamRef','')
             ->display_as('Especialidad','Especialidad')->display_as('consejo','Consejo que Otorga la Certificación')->display_as('finicio','Fecha de Inicio')
             ->display_as('ffin','Fecha de Finalización')->display_as('TipoCert','Tipo')->display_as('DocCertifiMedi','Doc. comprobatorio');

        $crud-> unset_edit_fields ( 'Alumno_Matricula');
        $crud->set_field_upload('DocCertifiMedi','assets/uploads/alumnos/'.$this->matricula);
        $output = $crud->render();

        $this->_example_output($output);
    }
    

    function _example_output($output = null)
    {
        $output->titulo_tabla = "Registro de Certificación";
        $output->barra_navegacion = " <li><a href='alumno'>Menú principal</a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_alumnos', $datos_plantilla);
    }
}
