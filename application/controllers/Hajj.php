<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hajj extends CI_Controller {

private $success_update = "Selamat! Data anda telah terbarui";
private $success_add = "Selamat! Data anda telah ditambahkan";
private $success_delete = "Data anda telah dihapus";
private $fail_update = "Maaf! Data anda gagal diperbaharui. Silahkan ulangi proses.";
private $fail_add = "Maaf! Data anda gagal ditambahkan. Silahkan ulangi proses.";
private $fail_delete = "Maaf! Data anda gagal dihapus. Silahkan ulangi proses.";

public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
}

public function index() {
    $this->load->view('index');
}

public function info() {
    phpinfo();
}

public function general_cek($role){
    if(!in_array($this->session->userdata("role"),$role)){
        redirect("Hajj/adm");
    }
}

public function cek() {
    if ($this->session->userdata('username') == NULL || $this->session->userdata('logged_in') != TRUE)
    { redirect("Sess");}
}

public function role_super() {
    if ($this->session->userdata('role') != 1) {
        redirect("Hajj/adm");
    }
}

public function role_admin() {
    if ($this->session->userdata('role') == 3) {
        redirect("Hajj/adm");
    }
}

public function sidebar() {
    if ($this->session->userdata('role') == 1) {
        return 'sb1';
    } elseif ($this->session->userdata('role') == 2) {
        return 'sb2';
    } else {
        return 'sb3';
    }
}

public function test_curl($article){
    //$article['link'] = "http://puskeshaji.depkes.go.id";
    // /$article['title'] = 'Info haji Indonesia';
    $this->load->library('Curl');

    $this->curl->simple_post(base_url().'/assets/facebook-php-sdk/src/post_fb.php', $article);
    $this->curl->simple_post(base_url().'/assets/Twitter/post_twt.php', array("status"=>$article['title']." >> ".$article['link']));
  
}

public function logout() {
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('logged_in');
    redirect("Sess");
}

public function adm($view = "cont_adm") {
    $this->cek();
    $data['sidebar'] = $this->sidebar();
    $data['statik'] = $this->Haj->statistik();
    //print_r($data);
    $data['view'] = $view;
    $this->load->view('adm', $data);
}

public function view($view = "", $error = "") {
    $this->cek();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = $view;
    $data['error'] = $error;
    $data['detail'] = "";
    $data['kat_berita'] = $this->Haj->select_order('web_news_cat', "news_cat", array("visible" => 1));
    $this->load->view('adm', $data);
}

public function view_($datax) {
    $this->cek();
    $datax['sidebar'] = $this->sidebar();
    $this->load->view('adm', $datax);
}
public function edit_status_kategori($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_news_cat", array("news_cat_id" => $id));
    $st = ($det->selected == 0) ? 1 : 0;
    $this->Haj->update("web_news_cat", array("selected" => $st), array("news_cat_id" => $id));
    redirect("Hajj/kat_berita");
}
public function add_kat($table) {
    
    $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
//$this->form_validation->set_rules('keterangan', 'Keterangan Kategori', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $this->kat_berita();
    } else {
        if ($this->Haj->add_kat($table)) {
           redirect("Hajj/kat_berita");
        } else {
            $this->kat_berita();
        }
    }
}

public function status($table, $vis, $id) {
    
    if ($this->Haj->status($table, $vis, $id)) {
        $this->view('kat_' . $table, $this->success_update);
    } else {
        $this->view('kat_' . $view, $this->fail_update);
    }
}

public function kat_berita() {
    $data['sidebar']    = $this->sidebar();
    $data['view']       = "kat_berita";
    $data['error']      = "";
    $data['detail']     = array();
    $data['kat_berita'] = $this->Haj->select_order('web_news_cat', "news_cat", array("visible" => 1));
    $this->load->view('adm', $data);
}

public function edit_kat($table, $id) {
    $data['sidebar']    = $this->sidebar();
    $data['view']       = "kat_" . $table;
    $data['error']      = "";
    $data['detail']     = $this->Haj->select_row("web_news_cat", array("news_cat_id" => $id));
    $data['kat_berita'] = $this->Haj->select_order('web_news_cat', "news_cat", array("visible" => 1));
    $this->load->view('adm', $data);
}

public function upd_kat($table) {
    $id = $this->input->post("id");
    $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
// $this->form_validation->set_rules('keterangan', 'Keterangan Kategori', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $this->edit_kat($table, $id);
    } else {
        if ($this->Haj->upd_kat($table)) {
            redirect("Hajj/kat_berita");
        } else {
            $this->edit_kat($table, $id);
        }
    }
}

public function del_kat($table, $id) {
    
    if ($this->Haj->del_kat($table, $id)) {
        redirect("Hajj/kat_berita");
    } else {
        redirect("Hajj/kat_berita");
    }
}

public function add($table) {
    
    $this->form_validation->set_rules('title', 'Judul Artikel', 'trim|required');
    $this->form_validation->set_rules('content', 'Isi Berita', 'trim|required');

    $config = array(
        'upload_path' => './assets/images',
        'allowed_types' => 'gif|jpeg|jpg|png',
        'overwrite' => 'true'
    );

    if ($this->form_validation->run() == FALSE) {
        $this->view($table, validation_errors());
    } else {
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        if ($this->Haj->add($table)) {
            $this->view($table, $this->success_add);
        } else {
            $this->view($table, $this->fail_add);
        }
    }
}

public function berita() {
    $this->general_cek(array(1,2,3));
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "artikel";
    $data['berita'] = $this->Haj->select_join("web_news", "web_news_cat","news_cat_id","web_news.*,news_cat", array("web_news.visible" => 1),"updated_at DESC");
    $this->view_($data);
}

public function berita_add() {
    $this->general_cek(array(1,2,3));
    $data['view'] = "artikel_add";
    $data['detail'] = array();
    $data['kat_berita'] = $this->Haj->select_order("web_news_cat", "news_cat ASC", array("visible" => 1));
    $this->view_($data);
}

public function berita_edit($id) {
     $this->general_cek(array(1,2,3));
    $detail = $this->Haj->select_row("web_news", array("news_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/berita_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "artikel_add";
    $data['kat_berita'] = $this->Haj->select_order("web_news_cat", "news_cat ASC", array("visible" => 1));
    $this->view_($data);
}

public function berita_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Isi ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->berita_add();
    } else {
        $input['news_title']     = $this->input->post("title");
        $input['news_desc']      = $this->input->post("content");
        $input['created_at']     = date("Y-m-d H:i:s");
        $input['news_cat_id']    = $this->input->post("kategori");
        $input['news_updatedby'] = $this->session->userdata("nama");
        $input['news_createdby'] = $this->session->userdata("nama");
        $config['upload_path']   = './assets/news_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '900';
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

         $input['news_img_url']  = "";
        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['news_img_url'] = $file_array;
                
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->berita_add();
            }
        }

        if($ok == 1){
            $this->Haj->insert("web_news", $input);
            $link_title2 = $input['news_title'];
            $link_title = str_replace(" ","-", $input['news_title']);
            $link_title = str_replace("'","", $link_title);
            
            $curl['picture'] = base_url()."assets/news_img/".$input['news_img_url'];
            $curl['link'] = base_url('news/'.$this->db->insert_id()."/".$link_title);
            $curl['title']= $link_title2;

            echo $this->test_curl($curl);

            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/berita_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/berita");
        }
    }
}

public function berita_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Isi ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->berita_edit($idku);
    } else {
        $input['news_title'] = $this->input->post("title");
        $input['news_desc'] = $this->input->post("content");
        $input['updated_at'] = date("Y-m-d H:i:s");
        $input['news_cat_id'] = $this->input->post("kategori");
        $input['news_updatedby'] = $this->session->userdata("nama");
       
        $config['upload_path'] = './assets/news_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['news_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->berita_edit($idku);
            }
        }

        $this->Haj->update("web_news", $input, array("news_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/berita_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/berita");
    }
}

public function berita_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_news", array("news_id" => $id));
    $st = ($det->news_status == 0) ? 1 : 0;
    $this->Haj->update("web_news", array("news_status" => $st), array("news_id" => $id));
    redirect("Hajj/berita");
}

public function berita_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_news", array("visible" => 0), array("news_id" => $id));
    redirect("Hajj/berita");
}

public function status_set_of_me($tb, $where) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row($tb, $where);
    $st = ($det->STATUS == 0) ? 1 : 0;
    $this->Haj->update($tb, array("STATUS" => $st), $where);
}

public function delete_set_of_me($tb, $where) {
    $this->general_cek(array(1,2));
    $this->Haj->update($tb, array("visible" => 0), $where);
}

public function gambar() {
    $this->general_cek(array(1,2));
    $data['view'] = "gambar";
    $data['gambar'] = $this->Haj->select_order("artikel_gambar", "ID_GAMBAR", array("visible" => 1));
    $this->view_($data);
}

public function gambar_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "gambar_add";
    $data['detail'] = array();
    $data['kat_gambar'] = $this->Haj->select_order("artikel_kategori_gambar", "NAMA ASC", array("visible" => 1));
    $this->view_($data);
}

public function gambar_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Isi ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->berita_add();
    } else {
        $input['TITLE'] = $this->input->post("title");
        $input['CONTENT'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['news_cat_id'] = $this->input->post("kategori");

        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/berita_edit/' . $this->db->insert_id()) . "'> EDIT </a>");

        $this->Haj->update("web_news", $input, array('news_id' => $idku));
        redirect("Hajj/artikel");
    }
}

/* ======================================== */

public function blog() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "blog";
    $data['blog'] = $this->Haj->select_order("web_blog", "updated_at DESC", array("visible" => 1));
    $this->view_($data);
}

public function blog_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "blog_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function blog_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_blog", array("blog_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/blog_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "blog_add";
    $this->view_($data);
}

public function blog_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Isi ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->blog_add();
    } else {
        $input['blog_title'] = $this->input->post("title");
        $input['blog_desc'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['blog_updatedby'] = $this->session->userdata("username");
        $input['blog_createdby'] = $this->session->userdata("username");
       
        $config['upload_path'] = './assets/blog_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['blog_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->blog_add();
            }
        }

        if ($ok = 1) {
            $this->Haj->insert("web_blog", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/blog_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/blog");
        }
    }
}

public function blog_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Isi ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->blog_edit($idku);
    } else {
        $input['blog_title'] = $this->input->post("title");
        $input['blog_desc'] = $this->input->post("content");
        $input['updated_at'] = date("Y-m-d H:i:s");
        $input['blog_updatedby'] = $this->session->userdata("nama");
       
        $config['upload_path'] = './assets/blog_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['blog_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->blog_edit($idku);
            }
        }

        $this->Haj->update("web_blog", $input, array("blog_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/blog_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/blog");
    }
}

public function blog_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_blog", array("blog_id" => $id));
    $st = ($det->blog_status == 0) ? 1 : 0;
    $this->Haj->update("web_blog", array("blog_status" => $st), array("blog_id" => $id));
    redirect("Hajj/blog");
}

public function blog_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_blog", array("visible" => 0), array("blog_id" => $id));
    redirect("Hajj/blog");
}

/* ======================================== */

public function banner() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "banner";
    $data['banner'] = $this->Haj->select_order("web_banner", "updated_at DESC", array("visible" => 1,"news_pic_id <>" => 3));
    $this->view_($data);
}

public function banner_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "banner_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function banner_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_banner", array("banner_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/banner_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "banner_add";
    $this->view_($data);
}

public function banner_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Link ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->banner_add();
    } else {
        $input['banner_title'] = $this->input->post("title");
        $input['news_pic_id'] = $this->input->post("cat_pic");
        $input['externallink'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['position'] = $this->input->post("position");

        $config['upload_path'] = './assets/banner_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($this->upload->do_upload()) {
            $file_array = $this->upload->data('file_name');
            $input['banner_img_url'] = $file_array;
            $this->Haj->insert("web_banner", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/banner_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/banner");
        } else {
            $ok = 0;
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            $this->banner_add();
        }
    }
}

public function banner_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Link ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->banner_edit($idku);
    } else {
        $input['banner_title'] = $this->input->post("title");
        $input['externallink'] = $this->input->post("content");
        $input['created_at']   = date("Y-m-d H:i:s");
        $input['position']     = $this->input->post("position");
        $input['news_pic_id']      = $this->input->post("cat_pic");
        $config['upload_path'] = './assets/banner_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['banner_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->banner_edit($idku);
            }
        }

        $this->Haj->update("web_banner", $input, array("banner_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/banner_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/banner");
    }
}

public function banner_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_banner", array("banner_id" => $id));
    $st = ($det->banner_selected == 0) ? 1 : 0;
    $this->Haj->update("web_banner", array("banner_selected" => $st), array("banner_id" => $id));
    redirect("Hajj/banner");
}

public function banner_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_banner", array("visible" => 0), array("banner_id" => $id));
    redirect("Hajj/banner");
}

/* ======================================== */

public function document() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "document";
    $data['doc'] = $this->Haj->select_order("web_document", "doc_id DESC", array("visible" => "1"));
    $this->view_($data);
}

public function document_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "document_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function document_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_document", array("doc_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/document_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "document_add";
    $this->view_($data);
}

public function document_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    //$this->form_validation->set_rules('content', 'Link ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->document_add();
    } else {
        $input['doc_title'] = $this->input->post("title");
        $input['externallink'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['position'] = $this->input->post("position");
		
		//upload doc
		$config2['upload_path'] = './assets/doc_img/';
        $config2['allowed_types'] = 'pdf|xls|xlsx|jpg|png|zip|rar';
        $config2['max_size'] = '10000';
        $config2['encrypt_name'] = true;

        $this->load->library('upload', $config2);
        $nmfile2 = $_FILES['userdoc']['name'];
        $ok = 1;
	
        if ($nmfile2) {
            if ($this->upload->do_upload('userdoc')) {
                $file_array2 = $this->upload->data('file_name');
                $input['file_img_url'] = $file_array2;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				$this->document_edit($idku);
            }
        }
		
        $config['upload_path'] = './assets/doc_img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($this->upload->do_upload('userfile')) {
            $file_array = $this->upload->data('file_name');
            $input['doc_img_url'] = $file_array;
            $this->Haj->insert("web_document", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/document_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/document");
        } else {
            $ok = 0;
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            $this->document_add();
        }
    }
}

public function document_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Link ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->document_edit($idku);
    } else {
        $input['doc_title'] = $this->input->post("title");
        $input['externallink'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['position'] = $this->input->post("position");

        $config['upload_path'] = './assets/doc_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload('userfile')) {
                $file_array = $this->upload->data('file_name');
                $input['doc_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->document_edit($idku);
            }
        }

		//upload doc
		$config2['upload_path'] = './assets/doc_img/';
        $config2['allowed_types'] = 'pdf|xls|xlsx|jpg|png';
        $config2['max_size'] = '10000';
        $config2['encrypt_name'] = true;

        $this->load->library('upload', $config2);
        $nmfile2 = $_FILES['userdoc']['name'];
        $ok = 1;
	
        if ($nmfile2) {
            if ($this->upload->do_upload('userdoc')) {
                $file_array2 = $this->upload->data('file_name');
                $input['file_img_url'] = $file_array2;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
				print_r($this->upload->display_errors());
				die();
                $this->document_edit($idku);
            }
        }
		
        $this->Haj->update("web_document", $input, array("doc_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/document_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/document");
    }
}

public function document_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_document", array("doc_id" => $id));
    $st = ($det->doc_selected == 0) ? 1 : 0;
    $this->Haj->update("web_document", array("doc_selected" => $st), array("doc_id" => $id));
    redirect("Hajj/document");
}

public function document_delete($id) {
    
    $this->Haj->update("web_document", array("visible" => 0), array("doc_id" => $id));
    redirect("Hajj/document");
}



/* ======================================== */

public function file_update() {
    
    $this->form_validation->set_rules('idku', 'ID ', 'required');
	
    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->file_edit($idku);
    } else {
		
        $config['upload_path']   = './assets/doc_img/';
        $config['allowed_types'] = 'gif|jpg|png|xls|doc|docx|xlsx|ppt|pdf|PDF';
        $config['max_size']      = '20000';
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;
		$input = array();
        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['file_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->file_edit($idku);
            }
        }
		$this->Haj->update("web_document", $input, array("doc_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/document_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/document");
    }
}

public function file_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_document", array("doc_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/document_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "document_file_add";
    $this->view_($data);
}

/* ======================================== */

 public function tautan() {
        $this->cek();
        $data['sidebar'] = $this->sidebar();
        $data['view'] = "tautan";
        $data['tautan'] = $this->Haj->select_order("web_tautan", "updated_at DESC", array("visible" => 1));
        $this->view_($data);
    }

    public function tautan_add() {
        $this->cek();
        $data['sidebar'] = $this->sidebar();
        $data['view'] = "tautan_add";
        $data['detail'] = array();
        $this->view_($data);
    }

    public function tautan_edit($id) {
        $this->cek();
        $detail = $this->Haj->select_row("web_tautan", array("tautan_id" => $id));

        if (count($detail) <= 0) {
            redirect("Hajj/tautan_add");
        }
        $data['detail'] = $detail;
        $data['sidebar'] = $this->sidebar();
        $data['view'] = "tautan_add";
        $this->view_($data);
    }

    public function tautan_save() {
        $this->cek();
        $this->form_validation->set_rules('title', 'Judul ', 'required');
        $this->form_validation->set_rules('content', 'Link ', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "Gagal simpan");
            $this->tautan_add();
        } else {
            $input['tautan_title'] = $this->input->post("title");
            $input['externallink'] = $this->input->post("content");
            $input['created_at'] = date("Y-m-d H:i:s");
            $input['position'] = $this->input->post("position");
            $input['tautan_createdby'] = $this->session->userdata('nama');

            $this->Haj->insert("web_tautan", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/tautan_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/tautan");
        }
    }

    public function tautan_update() {
        $this->cek();
        $this->form_validation->set_rules('title', 'Judul ', 'required');
        $this->form_validation->set_rules('content', 'Link ', 'required');

        $idku = $this->input->post('idku');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "Gagal simpan");

            $this->document_edit($idku);
        } else {
            $input['tautan_title'] = $this->input->post("title");
            $input['tautan_updatedby'] = $this->session->userdata("nama");
            $input['externallink'] = $this->input->post("content");
            $input['position'] = $this->input->post("position");

            $this->Haj->update("web_tautan", $input, array("tautan_id" => $idku));
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/tautan_edit/' . $idku) . "'> EDIT </a>");
            redirect("Hajj/tautan");
        }
    }

    public function tautan_status($id) {
        $this->cek();
        $det = $this->Haj->select_row("web_tautan", array("tautan_id" => $id));
        $st = ($det->tautan_selected == 0) ? 1 : 0;
        $this->Haj->update("web_tautan", array("tautan_selected" => $st), array("tautan_id" => $id));
        redirect("Hajj/tautan");
    }

    public function tautan_delete($id) {
        $this->cek();
        $this->Haj->update("web_tautan", array("visible" => 0), array("tautan_id" => $id));
        redirect("Hajj/tautan");
    }


    /* ======================================== */

    public function user() {
        $this->cek();

        $data['sidebar'] = $this->sidebar();
        $data['view'] = "user";
        $data['user'] = $this->Haj->select_order("web_user", "user_id DESC", array());
        $this->view_($data);
    }

    public function user_add() {
         $this->general_cek(array(1,2));

        $data['sidebar'] = $this->sidebar();
        $data['view'] = "user_add";
        $data['detail'] = array();
        $this->view_($data);
    }

    public function user_edit($id) {
         $this->general_cek(array(1,2));
        $detail = $this->Haj->select_row("web_user", array("user_id" => $id));

        if (count($detail) <= 0) {
            redirect("Hajj/user_add");
        }
        $data['detail'] = $detail;
        $data['sidebar'] = $this->sidebar();
        $data['view'] = "user_add";
        $this->view_($data);
    }

    public function user_save() {
        $this->cek();
        $this->form_validation->set_rules('nama', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('nohp', 'No. HP', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "Gagal simpan");
            $this->user_add();
        } else {
            $input['nama'] = $this->input->post("nama");
            $input['username'] = $this->input->post("username");
            $input['role'] = $this->input->post("role");
            $input['nohp'] = $this->input->post("nohp");
            $input['password'] = md5($this->input->post("password"));

            $this->Haj->insert("web_user", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/user_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/user");
        }
    }

    public function user_update() {
        $this->general_cek(array(1,2));
        $this->form_validation->set_rules('nama', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('nohp', 'No. HP', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'matches[password]');

        $idku = $this->input->post('idku');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "Gagal simpan");

            $this->user_edit($idku);
        } else {
            $pass = $this->input->post("password");
            if ($pass == "") {
                $input['nama'] = $this->input->post("nama");
                $input['username'] = $this->input->post("username");
                $input['role'] = $this->input->post("role");
                $input['nohp'] = $this->input->post("nohp");
            } else {
                $input['nama'] = $this->input->post("nama");
                $input['username'] = $this->input->post("username");
                $input['role'] = $this->input->post("role");
                $input['nohp'] = $this->input->post("nohp");
                $input['password'] = md5($this->input->post("password"));
            }

            $this->Haj->update("web_user", $input, array("user_id" => $idku));
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/user_edit/' . $idku) . "'> EDIT </a>");
            redirect("Hajj/user");
        }
    }

    public function user_delete($id) {
        $this->cek();
        $this->Haj->update("web_document", array("visible" => 0), array("doc_id" => $id));
        redirect("Hajj/document");
    }

    /*== INFO ===*/
public function infographic() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "infographic";
     $data['infographic'] = $this->Haj->select_join("web_infographic", "web_news","news_id","web_infographic.*,news_title", array("web_infographic.visible" => 1),"updated_at DESC");
   $this->view_($data);
}

public function infographic_add() {
    $this->general_cek(array(1,2));
    $kat  = $this->Haj->select_order("web_news_cat","news_cat",array("visible" => 1));
    $kate = array();
    foreach($kat as $k){
      $kate[$k->news_cat_id] = $k->news_cat;
    }
    $data['kategori'] = $kate;
    $data['view'] = "infographic_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function infographic_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_infographic", array("infographic_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/infographic_add");
    }
    $kat  = $this->Haj->select_order("web_news_cat","news_cat",array("visible" => 1));
    $kate = array();
    foreach($kat as $k){
      $kate[$k->news_cat_id] = $k->news_cat;
    }
    $data['kategori'] = $kate;
   
    $data['detail'] = $detail;
    $data['view'] = "infographic_add";
    $this->view_($data);
}

public function infographic_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('news', 'Berita ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->infographic_add();
    } else {
        $input['infographic_title'] = $this->input->post("title");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['infographic_createdby'] = $this->session->userdata('nama');
        $input['infographic_updatedby'] = $this->session->userdata('nama');
        $input['news_id']               = $this->input->post("news");

        $config['upload_path'] = './assets/infographic_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($this->upload->do_upload()) {
            $file_array = $this->upload->data('file_name');
            $input['infographic_img_url'] = $file_array;
            $this->Haj->insert("web_infographic", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/infographic_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/infographic");
        } else {
            $ok = 0;
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            $this->infographic_add();
        }
    }
}

public function infographic_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('news', 'Berita ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->infographic_edit($idku);
    } else {
        $input['infographic_title'] = $this->input->post("title");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['infographic_updatedby'] = $this->session->userdata('nama');
        $input['news_id']               = $this->input->post("news");
       
        $config['upload_path'] = './assets/infographic_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['infographic_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->infographic_edit($idku);
            }
        }

        $this->Haj->update("web_infographic", $input, array("infographic_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/infographic_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/infographic");
    }
}

public function infographic_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_infographic", array("infographic_id" => $id));
    $st = ($det->infographic_selected == 0) ? 1 : 0;
    $this->Haj->update("web_infographic", array("infographic_selected" => $st), array("infographic_id" => $id));
    redirect("Hajj/infographic");
}

public function infographic_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_infographic", array("visible" => 0), array("infographic_id" => $id));
    redirect("Hajj/infographic");
}

#REGISTER
public function pendaftaran() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "pendaftaran";
    $data['daftar'] = $this->Haj->select_pendaftaran("");
    $this->view_($data);
}

#AKTIVITY
public function kegiatan() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "activity";
    $data['kegiatan'] = $this->Haj->select_order("web_activity", "updated_at DESC", array("visible" => 1));
    $this->view_($data);
}

public function kegiatan_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "activity_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function kegiatan_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_activity", array("activity_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/kegiatan_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "activity_add";
    $this->view_($data);
}

public function kegiatan_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
   
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->activity_add();
    } else {
        $input['activity_title'] = $this->input->post("title");
        $input['activity_selected'] = 1;
        $input['activity_descr'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['updated_at'] = date("Y-m-d H:i:s");
       
        $config['upload_path'] = './assets/activity_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($this->upload->do_upload()) {
            $file_array = $this->upload->data('file_name');
            $input['activity_img_url'] = $file_array;
            $this->Haj->insert("web_activity", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/activity_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/kegiatan");
        } else {
            $ok = 0;
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            $this->kegiatan_add();
        }
    }
}

public function kegiatan_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    
    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->activity_edit($idku);
    } else {
        $input['activity_title'] = $this->input->post("title");
        $input['activity_selected'] = 1;
        $input['activity_descr'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['updated_at'] = date("Y-m-d H:i:s");
       
        $config['upload_path'] = './assets/activity_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['activity_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->kegiatan_edit($idku);
            }
        }

        $this->Haj->update("web_activity", $input, array("activity_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/activity_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/kegiatan");
    }
}

public function kegiatan_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_activity", array("activity_id" => $id));
    $st = ($det->activity_selected == 0) ? 1 : 0;
    $this->Haj->update("web_activity", array("activity_selected" => $st), array("activity_id" => $id));
    redirect("Hajj/kegiatan");
}

public function kegiatan_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_activity", array("visible" => 0), array("activity_id" => $id));
    redirect("Hajj/kegiatan");
}

/*--------------------------*/
public function gallery() {
    $this->general_cek(array(1,2));
    $this->role_admin();
    $data['sidebar'] = $this->sidebar();
    $data['view'] = "gallery";
    $data['banner'] = $this->Haj->select_order("web_banner", "updated_at DESC", array("visible" => 1,"news_pic_id" => 3));
    $this->view_($data);
}

public function gallery_add() {
    $this->general_cek(array(1,2));
    $data['view'] = "gallery_add";
    $data['detail'] = array();
    $this->view_($data);
}

public function gallery_edit($id) {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_banner", array("banner_id" => $id));

    if (count($detail) <= 0) {
        redirect("Hajj/gallery_add");
    }
    $data['detail'] = $detail;
    $data['view'] = "gallery_add";
    $this->view_($data);
}

public function gallery_save() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Link ', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");
        $this->gallery_add();
    } else {
        $input['banner_title'] = $this->input->post("title");
        $input['news_pic_id'] = 3;
        $input['externallink'] = $this->input->post("content");
        $input['created_at'] = date("Y-m-d H:i:s");
       
        $config['upload_path'] = './assets/banner_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($this->upload->do_upload()) {
            $file_array = $this->upload->data('file_name');
            $input['banner_img_url'] = $file_array;
            $this->Haj->insert("web_banner", $input);
            $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/gallery_edit/' . $this->db->insert_id()) . "'> EDIT </a>");
            redirect("Hajj/gallery");
        } else {
            $ok = 0;
            $this->session->set_flashdata('pesan', $this->upload->display_errors());
            $this->gallery_add();
        }
    }
}

public function gallery_update() {
    
    $this->form_validation->set_rules('title', 'Judul ', 'required');
    $this->form_validation->set_rules('content', 'Link ', 'required');

    $idku = $this->input->post('idku');
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("pesan", "Gagal simpan");

        $this->gallery_edit($idku);
    } else {
        $input['banner_title'] = $this->input->post("title");
        $input['externallink'] = $this->input->post("content");
        $input['created_at']   = date("Y-m-d H:i:s");
        $input['news_pic_id']      = 3;
        $config['upload_path'] = './assets/banner_img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '900';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $nmfile = $_FILES['userfile']['name'];
        $ok = 1;

        if ($nmfile) {
            if ($this->upload->do_upload()) {
                $file_array = $this->upload->data('file_name');
                $input['banner_img_url'] = $file_array;
            } else {
                $ok = 0;
                $this->session->set_flashdata('pesan', $this->upload->display_errors());
                $this->gallery_edit($idku);
            }
        }

        $this->Haj->update("web_banner", $input, array("banner_id" => $idku));
        $this->session->set_flashdata("pesan", "Berhasil simpan ! <a href='" . base_url('Hajj/gallery_edit/' . $idku) . "'> EDIT </a>");
        redirect("Hajj/gallery");
    }
}

public function gallery_status($id) {
    $this->general_cek(array(1,2));
    $det = $this->Haj->select_row("web_banner", array("banner_id" => $id));
    $st = ($det->banner_selected == 0) ? 1 : 0;
    $this->Haj->update("web_banner", array("banner_selected" => $st), array("banner_id" => $id));
    redirect("Hajj/gallery");
}

public function gallery_delete($id) {
    $this->general_cek(array(1,2));
    $this->Haj->update("web_banner", array("visible" => 0), array("banner_id" => $id));
    redirect("Hajj/gallery");
}

/* ======================================== */

public function conf() {
    $this->general_cek(array(1,2));
    $detail = $this->Haj->select_row("web_conf", array("ID_CONF" => 1));
    $data['detail'] = $detail;
    $data['view'] = "conf_add";
    $this->view_($data);
}

public function conf_update() {
        $this->cek();
        $this->form_validation->set_rules('video', 'Url Video ', 'required');
        $this->form_validation->set_rules('info', 'Info ', 'required');

        $idku = 1;
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "Gagal simpan");

            $this->document_edit($idku);
        } else {
            $input['VIDEO'] = $this->input->post("video");
            $input['TEXT_INFO'] = $this->input->post("info");
            
            $this->Haj->update("web_conf", $input, array("ID_CONF" => $idku));
            $this->session->set_flashdata("pesan", "Berhasil simpan !");
            redirect("Hajj/conf");
        }
    }

function api_news_bycat($id){
  $get = $this->Haj->select_order("web_news","news_title ASC",array("news_cat_id" => $id,"visible" => 1));
  $res = "<option> No data </option>";
  if( count($get) > 0){
    $res = "";
    foreach($get as $g){
      $res .= "<option value='".$g->news_id."'>".$g->news_title."</option>";
    }
  }

  echo $res;
}

}
