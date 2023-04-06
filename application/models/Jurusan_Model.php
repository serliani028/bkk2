<?php

class Jurusan_Model extends CI_Model 
{
    public function getNamaJurusan($id_jurusan){
        $this->db->where('id_jurusan', $id_jurusan);

        return $this->db->get('tbl_jurusan')->result_array()[0]['nama_jurusan'];
    }

    public function getJurusan()
    {
        $this->db->select('*');
		$this->db->from('tbl_jurusan');

		return $this->db->get()->result_array();
    }
}
