<?php

class SiswaBaru_Model extends CI_Model 
{

	protected $primaryKey = 'id_siswabaru';
	protected $table = 'tbl_siswabaru';
	protected $pembayaran_1 = 1600000;
    protected $pembayaran_2 = 3570000;
    
    public function createCandidate($siswa){
        $data['account_id'] = $siswa['id_mitra'];    
        $data['id_tahun_angkatan'] = $siswa['id_angkatan'];    
        $data['id_jurusan'] = $siswa['id_jurusan'];    
        $data['id_kelas'] = $siswa['id_kelas'];
        $data['first_name'] = $siswa['nama'];
        // $data['last_name'] = substr($data_user->nama, -1) ;
        $data['email'] = $siswa['email'];
        $data['phone1'] = $siswa['no_telp'];
        $data['address'] = $siswa['alamat'];
        $token = token();
        $data['token'] = $token;
        $data['status'] = 0;
        $data['image'] = '';
        $data['password'] = makePassword(12312312);
        $data['account_type'] = 'site';
        $data['external_id'] = '';
        $data['created_at'] = date('Y-m-d G:i:s');
        
        $this->db->insert('candidates', $data);
        $id = $this->db->insert_id();
        
        return $id;
    }

	public function getSiswa_bykode($kode_pendaftaran){
		if ($kode_pendaftaran) {
			$this->db->where('kode_pendaftaran', $kode_pendaftaran);
		}else{
			redirect(base_url('PPDB_Controller/konfirmasi'));
		}

		return $this->db->get($this->table)->result_array();
	}

	public function getSiswa_byid($id_mitra, $id_siswaBaru){
		if ($id_siswaBaru) {
			$this->db->where('id_siswaBaru', $id_siswaBaru);
		}
		
		if ($id_mitra) {
		$this->db->where('id_mitra', $id_mitra);
		}
		
		return $this->db->get($this->table)->result_array();

	}

	public function getSiswaJurusan($id_jurusan){
		if ($id_jurusan) {
			$this->db->where('jurusan1', $id_jurusan);
		}

		return $this->db->get($this->table)->result_array();

	}

	public function getGender($id_gender){
		$this->db->where('jk', $id_gender);

		return $this->db->get($this->table)->result_array();
	}

	public function getSiswaButuhVerifikasi($id_mitra){
		$this->db->select('*');
		$this->db->from('tbl_siswabaru');
		$this->db->join('tbl_ppdb', 'tbl_ppdb.id_siswaBaru = tbl_siswabaru.id_siswabaru', 'left');
		$this->db->join('jurusan', 'tbl_siswabaru.jurusan1 = jurusan.id', 'left');
		$this->db->where('tbl_ppdb.verifikasi', 0);
		$this->db->where('tbl_siswabaru.id_mitra', $id_mitra);
		$this->db->group_by('tbl_ppdb.id_siswaBaru');

		return $this->db->get()->result_array();
	}

	public function getSiswaVerifikasi($id_mitra, $verifikasi){
		$this->db->select('*, sum(jumlah) as total');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_ppdb.id_siswaBaru = tbl_siswabaru.id_siswaBaru', 'left');
		$this->db->join('jurusan', 'tbl_siswabaru.jurusan1 = jurusan.id', 'left');		
		$this->db->group_by('tbl_siswabaru.id_siswaBaru');		
		if ($verifikasi == 0) {
			$this->db->having('total <', $this->pembayaran_1);
		}else if($verifikasi == 1){
			$this->db->having('total >=', $this->pembayaran_1);
			$this->db->having('total <', $this->pembayaran_2);
		}else if($verifikasi == 2){
			$this->db->having('total >=', $this->pembayaran_2);
		}
		$this->db->where('tbl_siswabaru.id_mitra', $id_mitra);		

		return $this->db->get()->result_array();
	}
	
    public function getCandidate($id_mitra){
        $this->db->select('*, sum(jumlah) as total');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_ppdb.id_siswaBaru = tbl_siswabaru.id_siswaBaru', 'left');
		$this->db->group_by('tbl_siswabaru.id_siswaBaru');		
		$this->db->having('total >=', $this->pembayaran_2);
		$this->db->where('id_mitra', $id_mitra);
		$this->db->where('candidate_id', NULL, TRUE);

		return $this->db->get()->result_array();
    }
    
    public function getCandidate2($id_mitra){
        $this->db->select('*, sum(jumlah) as total');
		$this->db->from('tbl_ppdb');
		$this->db->join('tbl_siswabaru', 'tbl_ppdb.id_siswaBaru = tbl_siswabaru.id_siswaBaru', 'left');
		$this->db->group_by('tbl_siswabaru.id_siswaBaru');		
		$this->db->having('total >=', $this->pembayaran_2);
		$this->db->where('id_mitra', $id_mitra);
		$this->db->where('tbl_siswabaru.candidate_id is NOT NULL');

		return $this->db->get()->result_array();
    }

	public function get_status($id_siswaBaru){
		$this->db->where('id_siswaBaru', $id_siswaBaru);

		return $this->db->get($this->table)->result_array()[0]['status'];

	}

	public function getSiswaTerdaftar(){
		$this->db->where('bukti_pembayaran2', NULL, FALSE);
		$this->db->where('status', 2);

		return $this->db->get($this->table)->result_array();

	}

	public function create($data)
	{
		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function update($id_siswaBaru,$data)
	{
		$this->db->where('id_siswaBaru', $id_siswaBaru);

		return $this->db->update($this->table, $data);
	}
}