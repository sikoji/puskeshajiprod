<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class  Pusat extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("Haj","haj",TRUE);
		 $this->load->library('form_validation');
	}
	
	function view($data){
		$this->load->view("index",$data);
	}

	function somedata(){
		$data['konf']               = $this->haj->select_row("web_conf",array("ID_CONF"=>1));
		$data['berita_baru']        = $this->haj->select_with_limit("web_news","updated_at DESC",array("visible" => 1,"news_status" => 1),2);
		$data['link']               = $this->haj->select_order("web_tautan","position ASC, tautan_title ASC",array("visible" => 1,"tautan_selected" => 1));
		return $data;
	}

	function info($judul){
		$filter = array("visimisi"=>1,"struktur"=>2,"tupoksi"=>6,"unitkerja"=>4,"kontak"=>5);
		if( !in_array($judul, array_keys($filter)) ){
			redirect("/");exit;
			
		}
		$detail = $this->haj->select_row("web_blog",array("blog_id" => strtolower($filter[$judul])));
		if( count($detail) == 0 ){
			redirect("/");exit;
		}
		$data = $this->somedata();
		$data['detail'] = $detail;
		$data['title']  = $detail->blog_title;
		$data['view']   = 'blog';
		$this->view($data);
	}

	function index(){

		$data = $this->somedata();
		$kategori_berita 			= $this->haj->select_order("web_news_cat","updated_at DESC",array("visible" =>1,"selected" => 1));
		$data['kategori_berita']    = $kategori_berita;
		$idkb                       = array();
		
		foreach($kategori_berita as $kb){
			$idkb[] = $kb->news_cat_id;
		}

		$idimp = implode(",", $idkb);

		$data['kategori_gambar']    = $this->haj->select_order("web_banner","updated_at DESC",array("visible" => 1));
		$data['banner']             = $this->haj->select_order("web_banner","position ASC",array("visible" => 1,"banner_selected" => 1,"news_pic_id" => 2));
		$data['fitur']              = $this->haj->select_order("web_banner","position DESC",array("visible" => 1,"banner_selected" => 1,"news_pic_id" => 1));
		$data['infog']              = $this->haj->select_order("web_infographic","infographic_id DESC",array("visible" => 1,"infographic_selected" => 1));
		$data['document']              = $this->haj->select_order("web_document","position DESC",array("visible" => 1));
		$cek = 0;
		foreach($kategori_berita as $kat){
			$data['berita_kategori'][$cek]    = $this->haj->select_with_limit("web_news","news_id DESC",array("news_cat_id" => $kat->news_cat_id,"visible" => 1),3);
			$cek++;
		}
		
		$data['title'] = 'Home::Pusat Kesehatan Haji';
		$data['view']  = 'home';
		$this->view($data);
	}

	function detail($id){
		$detail = $this->haj->select_row("web_news",array("news_id" => $id));
		if( count($detail) == 0 ){
			redirect("/");exit;
		}
		$this->haj->update("web_news",array("news_count" => ($detail->news_count + 1)),array("news_id" => $id));
		$detail = $this->haj->select_row("web_news",array("news_id" => $id));
		
		$data = $this->somedata();
		$data['detail'] = $detail;
		$data['title']  = $detail->news_title;
		$data['view']   = 'detail';
		$this->view($data);	
	}

	function gallery(){
		$kat = ($this->uri->segment(3))?$this->uri->segment(3):'all';
		$page = ($this->uri->segment(4))?$this->uri->segment(4):'0';
		$array_kat = array("berbagi" => 1, "ragam" => 3, "utama" => 5);
		$filter = array("visible" => 1);
		$id_kat = null;
		if (in_array($kat, array_keys($array_kat))){
			$filter['news_cat_id'] = $array_kat[$kat];
			$id_kat = $array_kat[$kat];
		}

		$perpage = 21;
		$keyword = "";
		$this->load->library('pagination');
		$config               = $this->pagination();
		$config['base_url']   = base_url("pusat/gallery/".$kat);
		$config['total_rows'] = count( $this->haj->select_order("web_news","news_title",array("visible" => 1,"news_status"=>1)) );
		$config['per_page']   = $perpage;
		$this->pagination->initialize($config);

		$data = $this->somedata();
		$data['list']   = $this->haj->select_berita_page($keyword,array("limit"=>$perpage,"start" => $page), $id_kat);
		//echo $this->db->last_query();
		$data['title']  = "DAFTAR DOKUMEN";
		$data['view']   = 'gallery';
		$this->view($data);
	}

	function pagination(){
		 $config['full_tag_open'] = '<ul class="pagination pagination-sm custom-pagination">';
		 $config['full_tag_close'] = '</ul>';
		 $config['prev_link'] = '&laquo;';
		 $config['next_link'] = '&raquo;';
		 $config['prev_tag_open'] = '<li>';
		 $config['prev_tag_close'] = '</li>';
		 $config['next_tag_open'] = '<li>';
		 $config['next_tag_close'] = '</li>';
		 $config['cur_tag_open'] = '<li class="active"><a href="#">';
		 $config['cur_tag_close'] = '</a></li>';
		 $config['num_tag_open'] = '<li>';
		 $config['num_tag_close'] = '</li>';
		 $config['first_tag_open'] = '<li>';
		 $config['first_tag_close'] = '</li>';
		 $config['last_tag_open'] = '<li>';
		 $config['last_tag_close'] = '</li>';

		 return $config;
	}

	function berita(){
		$kat = ($this->uri->segment(3))?$this->uri->segment(3):'all';
		$page = ($this->uri->segment(4))?$this->uri->segment(4):'0';
		$array_kat = array("berbagi" => 1, "ragam" => 3, "utama" => 5);
		$filter = array("visible" => 1);
		$id_kat = null;
		if (in_array($kat, array_keys($array_kat))){
			$filter['news_cat_id'] = $array_kat[$kat];
			$id_kat = $array_kat[$kat];
		}

		$perpage = 15;
		$keyword = "";
		if($this->input->post("keyword")){
			$keyword = addslashes($this->input->post("keyword"));
		}

		$this->load->library('pagination');
		$config               = $this->pagination();
		$config['base_url']   = base_url("pusat/berita/".$kat."/");
		$config['total_rows'] = count( $this->haj->select_order("web_news","news_title", $filter) );
		//echo $this->db->last_query();echo "<br>";
		$config['per_page']   = $perpage;
		$config['uri_segment']   = 4;
		$this->pagination->initialize($config);

		$data = $this->somedata();
		$data['list']   = $this->haj->select_berita_page($keyword,array("limit"=>$perpage,"start" => $page), $id_kat);
		//echo $this->db->last_query();
		$data['title']  = "DAFTAR BERITA";
		$data['view']   = 'berita';
		$this->view($data);	
	}
	
	function document(){
		$page    = ($this->uri->segment(3))?$this->uri->segment(3):"0";
		$perpage = 25;
		$keyword = "";
		if($this->input->post("keyword")){
			$keyword = addslashes($this->input->post("keyword"));
		}

		$this->load->library('pagination');
		$config['base_url']   = base_url("pusat/document/");
		$config['first_tag_open'] = '<div class="pagination">';
		$config['first_tag_close'] = '</div>';
		$config['total_rows'] = count( $this->haj->select_order("web_document","doc_title",array("visible" => 1)) );
		$config['per_page']   = $perpage;
		$this->pagination->initialize($config);

		$data = $this->somedata();
		$data['list']   = $this->haj->select_document_page($keyword,array("limit"=>$perpage,"start" => $page),array("visible" => 1));
		//echo $this->db->last_query();
		$data['title']  = "DAFTAR DOCUMENT";
		$data['view']   = 'document';
		$this->view($data);	
	}

	function document_view($id){
		$detail = $this->haj->select_row("web_document",array("doc_id" => $id));
		if( count($detail) == 0 ){
			redirect("/");exit;
		}
		//$this->haj->update("web_news",array("news_count" => ($detail->news_count + 1)),array("news_id" => $id));

		$data = $this->somedata();
		$data['detail'] = $detail;
		$data['title']  = $detail->doc_title;
		$data['view']   = 'document_detail';
		$this->view($data);	
	}

	function not_found(){
		$data = $this->somedata();
		$data['title']  = "404 - Puskeshaji";
		$data['view']   = 'not_found';
		$this->view($data);	
	}

	function seminar(){
		$page    = ($this->uri->segment(3))?$this->uri->segment(3):"0";
		$perpage = 25;
		$keyword = "";
		
		$this->load->library('pagination');
		$config['base_url']   = base_url("pusat/seminar/");
		$config['first_tag_open'] = '<div class="pagination">';
		$config['first_tag_close'] = '</div>';
		$config['total_rows'] = count( $this->haj->select_order("web_activity","activity_title",array("visible" => 1)) );
		$config['per_page']   = $perpage;
		$this->pagination->initialize($config);

		$data = $this->somedata();
		$data['newest'] = $this->haj->select_with_limit("web_activity","created_at DESC",array("visible"=>1,"activity_selected"=>1),3);
		$data['list']   = $this->haj->select_activity_page($keyword,array("limit"=>$perpage,"start" => $page));
		$data['title']  = "DAFTAR SEMINAR";
		$data['view']   = 'seminar';
		$this->view($data);	
	}

	function register($id){
		$detail = $this->haj->select_row("web_activity",array("activity_id" => $id));
		if( count($detail) == 0 ){
			redirect("/");exit;
		}
		
		$data = $this->somedata();
		$data['detail'] = $detail;
		$data['newest'] = $this->haj->select_with_limit("web_activity","created_at DESC",array("visible"=>1,"activity_selected"=>1),3);
		
		$data['title']  = $detail->activity_title;
		$data['view']   = 'register_2';
		$this->view($data);	
	}

	function register_save(){
		$this->form_validation->set_rules("idku","ID ","required");
        $this->form_validation->set_rules("name","NAMA ","required");
        $this->form_validation->set_rules("instansi","INSTNASI ","required");
		$this->form_validation->set_rules("email","EMAIL ","required|valid_email");
		$this->form_validation->set_rules("nohp","NOHP ","required");
		$this->form_validation->set_rules("jenkel","JENIS KELAMIN","required");
		
		$idku = $this->input->post("idku");
		$detail = $this->haj->select_row("web_activity",array("activity_id" => $idku));
		
		if($this->form_validation->run()){
			$input['member_name']   = $this->input->post('name');
			$input['member_email']  = $this->input->post('email');
			$input['member_jenkel'] = $this->input->post('jenkel');
            $input['member_nohp']   = $this->input->post('nohp');
            $input['instansi']   = $this->input->post('instansi');
            $input['activity_id']   = $this->input->post('idku');
            $input['updated_at']   = date("Y-m-d");
			
			$this->db->insert("web_activity_member",$input);
			
			$this->session->set_flashdata("pesan","Anda sudah terdaftar dalam seminar : ".$detail->activity_title.":: Email : ".$input['member_email'].", No.Hp : ".$input['member_nohp']);
			redirect("seminar");
			
		}else{
			$this->register($idku);
		}
	}



}

