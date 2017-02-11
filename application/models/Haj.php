<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Haj extends CI_Model {

    public function add_kat($table) {
        $dt_kategori = array(
            'news_cat' => $this->input->post('kategori')
        );
        if ($this->db->insert('web_news_cat', $dt_kategori)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_kat($table, $id = "") {
        if ($id == "") {
            $this->db->where('visible', '1');
            return $this->db->get('web_news_cat' . $table)->result();
        } else {
            $this->db->where('news_cat_id' . $table, $id);
            $this->db->where('visible', '1');
            return $this->db->get('web_news_cat')->row();
        }
    }

    public function status($table, $stat, $id) {
        if ($stat == 1) {
            $dt_stat = array(
                'STATUS' => "0"
            );
        } else {
            $dt_stat = array(
                'STATUS' => "1"
            );
        }
        $this->db->where('news_cat_id' . $table, $id);
        if ($this->db->update('web_news_cat', $dt_stat)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function upd_kat($table) {
        $dt_kategori = array(
            'news_cat' => $this->input->post('kategori')
        );
        $this->db->where('news_cat_id', $this->input->post('id'));
        if ($this->db->update('web_news_cat', $dt_kategori)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function statistik(){
        $query = "SELECT 
            (SELECT COUNT(*) FROM web_news WHERE visible =1) AS BERITA, 
            (SELECT COUNT(*) FROM web_activity WHERE visible =1) AS KEGIATAN, 
            (SELECT COUNT(*) FROM web_user) AS USER ";
        return $this->db->query($query)->row();
    }

    public function del_kat($table, $id) {
        $dt_kategori = array(
            'visible' => 0
        );
        $this->db->where('news_cat_id', $id);
        if ($this->db->update('web_news_cat', $dt_kategori)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add($table) {
        $dt_artikel = array(
            'news_cat_id' => $this->input->post('kategori'),
            'TITLE' => $this->input->post('title'),
            'CONTENT' => $this->input->post('content'),
            'CREATED_AT' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s'),
            'visible' => "1",
            'STATUS' => "1",
            'ID_LOGIN' => "1",
            'PICTURE' => $_FILES['gambar']['name']
        );
        if ($this->db->insert('artikel_' . $table, $dt_artikel)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get($table, $id = "") {
        if ($id == "") {
            $this->db->select('*');
            $this->db->from('web_news_cat' . $table . ' a');
            $this->db->join('artikel_' . $table . ' b', 'b.news_cat_id' . $table . '= a.news_cat_id' . $table);
            $this->db->join('artikel_login c', 'c.ID_LOGIN = b.ID_LOGIN');
            $this->db->where('b.STATUS', '1');
            return $this->db->get('artikel_' . $table)->result();
        } else {
            $this->db->where('ID_' . $table, $id);
            $this->db->where('visible', '1');
            return $this->db->get('artikel_' . $table)->row();
        }
    }

    function select_order($tb, $order, $where) {
        $res = $this->db->select("*")
                ->from($tb)
                ->order_by($order)
                ->where($where)
                ->get();

        if (count($res) > 0) {
            return $res->result();
        } else {
            return array();
        }
    }

	
    function select_row($tb, $where) {
        $res = $this->db
                ->get_where($tb, $where)
                ->row();
        return $res;
        //$this->db->last_query();
    }

    function insert($tb, $field) {
        $this->db->insert($tb, $field);
        return TRUE;
    }

    function update($tb, $field, $where) {
        $this->db->where($where)->update($tb, $field);
        return TRUE;
    }

     function select_with_limit($tb, $order, $where,$limit){
        $res = $this->db->select("*")
            ->from($tb)
            ->order_by($order)
            ->where($where)
            ->limit($limit,0)
            ->get();
        
        if( count($res) > 0 ){
            return $res->result();
        }else{
            return array();
        }

    }

    function selectnewsbyselectedkat($limit){
        $res = $this->db->select("web_news.*")
            ->from("web_news")
            ->join("web_news_cat","web_news_cat.news_cat_id = web_news.news_cat_id","INNER")
            ->where(array("web_news.visible" => 1,"web_news_cat.selected" => 1,"web_news_cat.visible" => 1))
            ->limit($limit,0)
            ->order_by("web_news.news_cat_id DESC")
            ->get();
        if( count($res) > 0 ){
            return $res->result();
        }else{
            return array();
        }
    }

    function select_join($tb1,$tb2,$id,$select,$where,$order){
        $res = $this->db->select($select)
            ->from("$tb1")
            ->join("$tb2","$tb1.$id = $tb2.$id","INNER")
            ->where($where)
            //->limit($limit,0)
            ->order_by($order)
            ->get();
        if( count($res) > 0 ){
            return $res->result();
        }else{
            return array();
        }
    }
    function select_berita_page($keyword,$page, $id_cat){
        $filter = array("web_news.visible" => 1, "web_news_cat.visible" => 1,"web_news.news_status"=>1 );
        if ($id_cat > 0){
            $filter["web_news.news_cat_id"] = $id_cat;
        }
        $res = $this->db->select()
            ->from("web_news")
            ->join("web_news_cat","web_news.news_cat_id = web_news_cat.news_cat_id","INNER")
            ->where($filter)
            ->like("news_title",$keyword)
            ->limit($page['limit'],$page['start'])
            ->get();

            if( count($res) > 0 ){
                return $res->result();
             }else{
                return array();
            }

    }

    function select_document_page($keyword,$page,$filter){
        $res = $this->db->select()
            ->from("web_document")
			->order_by("doc_id desc")
			->where($filter)
            ->limit($page['limit'],$page['start'])
            ->get();

            if( count($res) > 0 ){
                return $res->result();
             }else{
                return array();
            }

    }

    function select_activity_page($keyword,$page){
        $res = $this->db->select()
            ->from("web_activity")
            ->limit($page['limit'],$page['start'])
            ->get();

            if( count($res) > 0 ){
                return $res->result();
             }else{
                return array();
            }

    }

    function select_pendaftaran($where){
        $query = "Select web_activity.activity_title, web_activity_member.* 
                From
                web_activity, web_activity_member
                where web_activity.activity_id = web_activity_member.activity_id
                AND web_activity.visible = 1
                AND web_activity_member.visible = 1
                Order by web_activity_member.updated_at desc";
         $res = $this->db->query($query);
         if( count($res) > 0 ){
                return $res->result();
             }else{
                return array();
            }

    }

}
