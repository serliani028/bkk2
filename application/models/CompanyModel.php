<?php

class CompanyModel extends CI_Model
{
    protected $table = 'companies';
    protected $table2 = 'kategori_pekerjaan';
    protected $table3 = 'kabupaten';
    protected $key = 'company_id';

    public function getCompany($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('companies');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('companies');
    }

    public function getAll($active = true)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }
    public function getKategori()
    {
        $this->db->where('status', 1);
        $this->db->from($this->table2);
        $query = $this->db->get();
        return objToArr($query->result());
    }
    
     public function getLokasi()
    {
        // $this->db->where('status', 1);
        $this->db->from($this->table3);
        $query = $this->db->get();
        return objToArr($query->result());
    }
}
