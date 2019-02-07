<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Configuracion_model");
	}
	public function index(){
		$data  = array(
		'edades' => $this->Configuracion_model->getEdades(),
		'tipocasa' => $this->Configuracion_model->getTipodecasa(),
		'estadocivil' => $this->Configuracion_model->getEstadocivil(),
		'tipodemedio' => $this->Configuracion_model->	getTipodemedio(),

		'cargoenelmedio' => $this->Configuracion_model->getCargo(),

			//'permisos' => $this->permisos,
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/configuracion/list",$data);
		$this->load->view("layouts/footer");
	}
	public function editEdades($id){
		$data  = array(
			'nombres' => $this->Configuracion_model->getEdad($id),
			'base' => "edades_update"
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/configuracion/edit",$data);
		$this->load->view("layouts/footer");
	}
	public function edades_update(){
		$idmenu = $this->input->post("idmenu");
		$nombres = $this->input->post("nombres");
		$descripcion = $this->input->post("descripcion");
		$menu = 'edades';
		$this->form_validation->set_rules("nombres","Nombres","required");
		if ($this->form_validation->run()) {
			$data  = array(
				'parametro' => $nombres,
				'descripcion' => $descripcion,
			);

			if ($this->Configuracion_model->update($menu,$data,$idmenu)) {
				redirect(base_url()."administrador/configuracion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/edit".$idusuario);
			}
		}else {
			$this->edit($idusuario);
		}
	}
	public function editCasa($id){
		$data  = array(
			'nombres' => $this->Configuracion_model->getCasa($id),
			'base' => "casa_update"
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/configuracion/edit",$data);
		$this->load->view("layouts/footer");
	}
	public function casa_update(){
		$idmenu = $this->input->post("idmenu");
		$nombres = $this->input->post("nombres");
		$descripcion = $this->input->post("descripcion");
		$menu = 'tipodecasa';
		$this->form_validation->set_rules("nombres","Nombres","required");
		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombres,
				'descripcion' => $descripcion,
			);

			if ($this->Configuracion_model->update($menu,$data,$idmenu)) {
				redirect(base_url()."administrador/configuracion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/edit".$idusuario);
			}
		}else {
			$this->edit($idusuario);
		}
	}
	public function editaEstadoCivil($id){
		$data  = array(
			'nombres' => $this->Configuracion_model->getCivil($id),
			'base' => "estadoCivil_update"
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/configuracion/edit",$data);
		$this->load->view("layouts/footer");
	}
	public function estadoCivil_update(){
		$idmenu = $this->input->post("idmenu");
		$nombres = $this->input->post("nombres");
		$descripcion = $this->input->post("descripcion");
		$menu = 'estadocivil';
		$this->form_validation->set_rules("nombres","Nombres","required");
		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombres,
				'descripcion' => $descripcion,
			);

			if ($this->Configuracion_model->update($menu,$data,$idmenu)) {
				redirect(base_url()."administrador/configuracion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/edit".$idusuario);
			}
		}else {
			$this->edit($idusuario);
		}
	}
	public function editaTipodemedio($id){
		$data  = array(
			'nombres' => $this->Configuracion_model->getTipomedio($id),
			'base' => "tipodemedio_update"
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/configuracion/edit",$data);
		$this->load->view("layouts/footer");
	}
	public function tipodemedio_update(){
		$idmenu = $this->input->post("idmenu");
		$nombres = $this->input->post("nombres");
		$descripcion = $this->input->post("descripcion");
		$menu = 'tipodemedio';
		$this->form_validation->set_rules("nombres","Nombres","required");
		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombres,
				'descripcion' => $descripcion,
			);

			if ($this->Configuracion_model->update($menu,$data,$idmenu)) {
				redirect(base_url()."administrador/configuracion");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/edit".$idusuario);
			}
		}else {
			$this->edit($idusuario);
		}
	}





	public function add(){
		$data  = array(
			'roles' => $this->Usuarios_model->getRoles(),

		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){
		$nombres = $this->input->post("nombres");
		$username = $this->input->post("nick");
		$password = sha1($this->input->post("password"));
		$rol = $this->input->post("rol");
		$this->form_validation->set_rules("nombres","Nombres","required");
		$this->form_validation->set_rules("nick","Usuario","required");
		$this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("rol","rol","required");


		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombres,
				'username' => $username,
				'password' => $password,
				'id_rol' => $rol,
				'id_estado' => "1"
			);

			if ($this->Usuarios_model->save($data)) {
				redirect(base_url()."administrador/usuarios");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/add");
			}
		}else {
			$this->add();
		}


	}
	public function update(){
		$idusuario = $this->input->post("idusuario");
		$nombres = $this->input->post("nombres");
		$username = $this->input->post("nick");
		$rol = $this->input->post("rol");
		$this->form_validation->set_rules("nombres","Nombres","required");
		$this->form_validation->set_rules("nick","Usuario","required");
		$this->form_validation->set_rules("rol","rol","required");
		if ($this->form_validation->run()) {
			$data  = array(
				'nombre' => $nombres,
				'username' => $username,
				'id_rol' => $rol
			);

			if ($this->Usuarios_model->update($idusuario,$data)) {
				redirect(base_url()."administrador/usuarios");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/usuarios/edit".$idusuario);
			}
		}else {
			$this->edit($idusuario);
		}


	}
	public function view(){
		$idusuario = $this ->input ->post("idusuario");
		$data = array(
			"usuario" => $this->Usuarios_model->getUsuario($idusuario),
		);
		$this->load->view("admin/usuarios/view",$data);
	}

	public function edit($id){
		$data  = array(
			'roles' => $this->Usuarios_model->getRoles(),
			'usuario' => $this->Usuarios_model->getUsuario($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function delete($id){
		$data  = array(
			'id_estado' => "0",
		);
		$this->Usuarios_model->update($id,$data);
		redirect(base_url()."administrador/usuarios");
	}

}
