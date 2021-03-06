<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divulgacion extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->matricula = $this->session->userdata('matricula');
    }

    function registroDivulgacion()
    {
        if ($this->session->userdata('logged_in'))
        {
                $crud = new grocery_CRUD();
                $crud->where('Alumno_Matricula', $this->matricula);
                $crud->set_table('divulgacion');
                $crud->set_subject('Divulgacion y Difusión de Ciencia y Tecnologia');
                $crud->set_relation('idCatalogoDivulgacion','catalogodivulgacion','TipoParticipacion');
                $crud->columns( 'idCatalogoDivulgacion','Dirigido','Titulo','Dependencia','DocDivulga');
                $crud->field_type('Alumno_Matricula', 'hidden',$this->matricula );
                $crud->display_as('idCatalogoDivulgacion','Tipo de Participación')->display_as('Dirigido','Dirigido a')->display_as('Titulo','Titulo')
                     ->display_as('Dependencia','Dependencia responasable')->display_as('Notas','Notas Periodisticas')->display_as('TipoD','Tipo')->display_as('DocDivulga','Doc. comprobatorio');

                $crud->unset_print();
                $crud->unset_export();
                $crud-> unset_edit_fields ( 'Alumno_Matricula');
                $crud->required_fields('idCatalogoDivulgacion','Dirigido','Titulo','Dependencia');
                $crud->set_field_upload('DocDivulga','assets/uploads/alumnos/'.$this->matricula);

                $crud->unset_texteditor('Notas','full_text');

                $crud->set_rules('DocDivulga','Doc. comprobatorio','max_length[26]');

                $output = $crud->render();

                $this->_example_output($output);

        }
        else {
                redirect('login');
                }
    }


    function _example_output($output = null)
    {
        $output->titulo_tabla = "Registro de Divulgación y Difusión de Ciencia y Tecnologia ";
        $output->barra_navegacion = " <li><a href='principal'> Menú principal </a></li>  |  <li> <a href='alumno'> Menú CVU </a></li>";
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_alumnos', $datos_plantilla);
    }
}

