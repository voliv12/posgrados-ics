<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degresadopifi extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        
    }


    function registroegresado()
    {
        if ($this->session->userdata('logged_in'))
        {
            $crud = new grocery_CRUD();
            $crud->set_table('pifialumno');
            $crud->set_subject('Datos');
            $crud->columns( 'AnioPifi','mesP','NSatisfaEgresado','NSatisfaEmpleador');
            $crud->display_as('AnioPifi','Año')->display_as('mesP','Mes')->display_as('NEgresado','Número de egresados que consiguieron empleo en menos de seis meses después de egresar')
                 ->display_as('PEgresado','Porcentaje de egresados que consiguieron empleo en menos de seis meses después de egresar')->display_as('NTitulado','Número de titulados que realizó alguna actividad laboral después de egresar y que coincidió o tuvo relación con sus estudios')
                 ->display_as('PTitulado','Porcentaje de titulados que realizó alguna actividad laboral después de egresar y que coincidió o tuvo relación con sus estudios')
                 ->display_as('NSatisfaEgresado','Número de satisfacción de los egresados')->display_as('PorceSatisfaEgresado','Porcentaje de satisfacción de los egresados')
                 ->display_as('NOpinion','Número de opiniones favorables sobre los resultados de los PE de la institución de una muestra representativa de la sociedad')->display_as('POpinion','Porcentaje de opiniones favorables sobre los resultados de los PE de la institución de una muestra representativa de la sociedad')
                 ->display_as('NSatisfaEmpleador','Número de satisfacción de los empleadores sobre el desempeño de los egresados de PE')->display_as('PSatisfaEmpleador','Porcentaje de satisfacción de los empleadores sobre el desempeño de los egresados de PE');
            $crud->unset_print();
            $crud->unset_export();

            $crud->callback_field('PEgresado',array($this,'field_callback_1'));
            $crud->callback_field('PTitulado',array($this,'field_callback_2'));
            $crud->callback_field('PorceSatisfaEgresado',array($this,'field_callback_3'));
            $crud->callback_field('POpinion',array($this,'field_callback_4'));
            $crud->callback_field('PSatisfaEmpleador',array($this,'field_callback_5'));
            $crud->field_type('AnioPifi','dropdown',range(2000, 2030));
            if ($this->session->userdata('perfil') != "Director Instituto"){
            $barra = " <li><a href='directivo'> Menú principal </a></li>  "; 
            }else {
                  $barra = " <li><a href='director'> Menú principal </a></li>  "; 
                  }
            $output = $crud->render();
            $this->_example_output($output, $barra );
        }
             else { redirect('login');
             }
    }

    function field_callback_1($value = '', $primary_key = null)
    {
        return '<input type="text" maxlength="50" value="'.$value.'" name="PEgresado" >%';
    }

    function field_callback_2($value = '', $primary_key = null)
    {
        return '<input type="text" maxlength="50" value="'.$value.'" name="PTitulado" >%';
    }

    function field_callback_3($value = '', $primary_key = null)
    {
        return '<input type="text" maxlength="50" value="'.$value.'" name="PorceSatisfaEgresado" >%';
    }

    function field_callback_4($value = '', $primary_key = null)
    {
        return '<input type="text" maxlength="50" value="'.$value.'" name="POpinion" >%';
    }

    function field_callback_5($value = '', $primary_key = null)
    {
        return '<input type="text" maxlength="50" value="'.$value.'" name="PSatisfaEmpleador" >%';
    }



    function _example_output($output = null, $barra = null)
    {
        $output->titulo_tabla = "Datos de Egresados";
        $output->barra_navegacion = $barra;
        $datos_plantilla['contenido'] =  $this->load->view('output_view', $output, TRUE);
        $this->load->view('plantilla_directivo', $datos_plantilla);

    }

}

