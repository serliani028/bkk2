<?php

class PPDB_Model extends CI_Model
{
	protected $table = 'tbl_ppdb';
    protected $primaryKey = 'id_ppdb';
    
    public function get($id_ppdb){
		$this->db->select('*');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_siswabaru.id_siswaBaru = tbl_ppdb.id_siswaBaru', 'left');
		$this->db->where('id_ppdb', $id_ppdb);

		return $this->db->get()->result_array();
	}

	public function get_byIdSiswa($id_siswaBaru){
		$this->db->select('*');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_siswabaru.id_siswaBaru = tbl_ppdb.id_siswaBaru', 'left');
		$this->db->where('tbl_siswabaru.id_siswaBaru', $id_siswaBaru);

		return $this->db->get()->result_array();
	}	

	public function get_pembayaran(){
		$this->db->select('*');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_siswabaru.id_siswaBaru = tbl_ppdb.id_siswaBaru', 'left');

		return $this->db->get()->result_array();
	}

	public function get_totalPembayaran($id_siswaBaru){
		$this->db->select('sum(jumlah) as total');
		$this->db->from('tbl_ppdb');
		if ($id_siswaBaru) {
			$this->db->where('id_siswaBaru', $id_siswaBaru);
		}
		$this->db->where('verifikasi', 1);

		return $this->db->get()->result_array();
	}	

	public function create($data)
	{
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
	}

	public function delete($id_ppdb){
		$this->db->where('id_ppdb', $id_ppdb);

		return $this->db->delete('tbl_ppdb');
	}

    public function update($data, $id){
        $this->db->where('id_ppdb', $id);
        $update = $this->db->update($this->table, $data);

        return $update;
    }
    
    public function get_sekolah($link_siswa){
        $this->db->where('link_siswa', $link_siswa);
        
        return $this->db->get('user_mitra')->result_array();
    }
    
    public function get_kelas($id_mitra){
        $this->db->where('id_mitra', $id_mitra);
        
        return $this->db->get('kelas')->result_array();
    }    
    
    public function get_jurusan($id_mitra){
        $this->db->where('id_mitra', $id_mitra);
        
        return $this->db->get('jurusan')->result_array();
    }
    
    public function get_angkatan($id_mitra){
        $this->db->where('id_mitra', $id_mitra);
        
        return $this->db->get('tahun_angkatan')->result_array();
    }
}