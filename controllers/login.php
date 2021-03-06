<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
        $this->load->model('usuarios_model');
    }

    function index()
    {
        $datos_plantilla['contenido'] = " ";
        $this->load->view('login_view', $datos_plantilla);
    }

    function validar_usuario()
    {
        $this->form_validation->set_rules('password','password','trim|required|min_length[5]|sha1');
        if ($this->form_validation->run() == FALSE)
        {
            $datos['mensaje'] = "La contraseña debe contener como mínimo 5 carácteres";
            $datos_plantilla['contenido'] = $this->load->view('success_login', $datos, true);
            $this->load->view('login_view', $datos_plantilla);
        }
        else
        {
            extract($_POST);
            $tipo_usuario = $this->input->post('tipo_usuario');
            $usuario      = $this->input->post('usuario');

            if($tipo_usuario == "alumno")
            {
                $row = $this->usuarios_model->buscar_tabla_alumno($usuario, $password);
                if(!$row)
                {
                    $datos['mensaje'] = "El usuario ".$datos['usuario'] = $usuario." no está registrado o la contraseña es incorrecta. Intentelo de nuevo!";
                    //$datos['link'] = "<input type='button' value='Intentar de nuevo' name='regresar' class='input_button' onclick='history.back()' />";
                    $datos_plantilla['contenido'] = $this->load->view('success_login', $datos, true);
                    $this->load->view('login_view', $datos_plantilla);
                }else
                {
                    $nombre = $row->NombreA." ".$row->ApellidoPA;
                    $newdata = array(

                                     'matricula'    => $row->matricula,
                                     'nombre'       => $nombre,
                                     'tipo_usuario' => $tipo_usuario,
                                     'idalumno'     => $row->idalumno,
                                     'logged_in'    => TRUE
                                    );
                    $this->session->set_userdata($newdata);

                    redirect('principal');
                }
            }elseif($tipo_usuario == "personal")
                {
                    $row = $this->usuarios_model->buscar_tabla_personal($usuario, $password);
                    if(!$row)
                    {
                        $datos['mensaje'] = "El usuario ".$datos['usuario'] = $usuario." no está registrado o la contraseña es incorrecta. Intentelo de nuevo!";
                        $datos_plantilla['contenido'] = $this->load->view('success_login', $datos, true);
                        $this->load->view('login_view', $datos_plantilla);
                    }else{
                            //Pregunto si el personal que se logea es Coordinador de Posgrado
                            if ($row->nomperfil == "Coordinador de Posgrado") 
                            {
                                $row_c = $this->usuarios_model->buscar_coordinador($row->NumPersonal);
                                $newdata = array(
                                             'numPersonal'  => $row_c->NumPersonal,
                                             'nombre'       => $row_c->Nombre." ".$row_c->apellidos,
                                             'tipo_usuario' => $tipo_usuario,
                                             'perfil'       => $row_c->nomperfil,
                                             'tipo_personal'=> $row_c->tipo_personal,
                                             'posgrado'     => $row_c->nombre_posgrado,
                                             'abrev_posgrado'=> $row_c->abrev_posgrado,
                                             'logged_in'    => TRUE
                                            );
                            }else{  $newdata = array('numPersonal'  => $row->NumPersonal,
                                                     'nombre'       => $row->Nombre." ".$row->apellidos,
                                                     'tipo_usuario' => $tipo_usuario,
                                                     'perfil'       => $row->nomperfil,
                                                     'tipo_personal'=> $row->tipo_personal,
                                                     'logged_in'    => TRUE
                                                    );
                                 }


                            $this->session->set_userdata($newdata);

                            if($row->nomperfil == "Administrador del Sistema")
                            {  redirect('administrador'); }
                                elseif($row->nomperfil == "Apoyo Administrativo")
                                { redirect('administrativo');}
                                    elseif ($row->nomperfil == "Académico de Posgrado")
                                    { redirect('academico'); }
                                        elseif ($row->nomperfil == "Director Instituto")
                                        { redirect('director'); }
                                            else
                                            { redirect('directivo');}
                        }
            }
        }
    }
}
