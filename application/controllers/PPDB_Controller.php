  <?php

use \Mpdf\Mpdf;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PPDB_Controller extends CI_Controller 
{
    protected $pembayaran_1 = 1600000;
    protected $pembayaran_2 = 3570000;

    public function __construct(){
        parent::__construct();

        $this->load->model('Jurusan_Model');
        $this->load->model('SiswaBaru_Model');
    
    }

    public function index(){
        $this->load->view('layouts-front/ppdb/index.php');
    }

    public function daftar($link_siswa){
        $pageData['page'] = "Form Pendaftaran PPDB";
        $sekolah = $this->PPDB_Model->get_sekolah($link_siswa);
        
        $data['provinsi'] = $this->db->get_where('provinsi')->result();
        $data['sekolah'] = $sekolah;
        $data['jurusan'] = $this->PPDB_Model->get_jurusan($sekolah[0]['id_mitra']);
        
        $this->load->view('front/layout/header2', $pageData);
        $this->load->view('admin/ppdb/daftar',$data);
    }

    public function konfirmasi(){
        $data['id'] = $this->input->post('id');
        $data['valid'] = 0;

        if ($data['id']) {
            $siswa = $this->SiswaBaru_Model->getSiswa_bykode($data['id']);            
            
            if ($siswa) {
                $data['siswa'] = $siswa;
                $data['pembayaran'] = $this->PPDB_Model->get_byIdSiswa($siswa[0]['id_siswaBaru']);
                $data['biaya'] = $this->pembayaran_2;
                $data['total_pembayaran'] = $this->PPDB_Model->get_totalPembayaran($siswa[0]['id_siswaBaru'])[0]['total'];
                $data['valid'] = 1;   
            }else{
                $data['valid'] = -1;
            }
        }
        
        $pageData['page'] = "Form Pendaftaran PPDB";
        
        $this->load->view('front/layout/header2', $pageData);
        $this->load->view('admin/ppdb/formKonfirmasi.php', $data);
    }
    
    public function pendaftaran_berhasil(){
        $this->load->view('layouts-front/ppdb/berhasilDaftar.php');
    }

    public function konfirmasi_berhasil(){
        $this->load->view('layouts-front/ppdb/berhasilBayar.php');
    }

    public function list_pendaftar($verifikasi){
        $id_mitra = $this->session->userdata('admin')['account_id'];

        if ($verifikasi == -1) {
            $siswa = $this->SiswaBaru_Model->getSiswa_byid($id_mitra, null);
        }else{
            $siswa = $this->SiswaBaru_Model->getSiswaVerifikasi($id_mitra, $verifikasi);
        }

        $data = array(
            'title' => "List pendaftaran ppdb",
            'siswa' => $siswa,
            'jumlah' => sizeof($siswa),
        );

        $data_pages['page'] = 'List Siswa Pendaftar';
        $data_pages['menu'] = 'List Siswa Pendaftar';
        $this->load->view('admin/layout/header', $data_pages);
        $this->load->view('admin/ppdb/listSiswaPPDB', $data);
    }

    public function list_butuhVerifikasi(){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $data = array(
            'title' => "Pendaftar Butuh Verifikasi Pembayaran",
            'siswa' => $this->SiswaBaru_Model->getSiswaButuhVerifikasi($id_mitra),
            'jumlah' => sizeof($this->SiswaBaru_Model->getSiswaButuhVerifikasi($id_mitra)),
        );

        $data_pages['page'] = 'List Butuh Verifikasi';
        $data_pages['menu'] = 'List Butuh Verifikasi';
        $this->load->view('admin/layout/header', $data_pages);
        $this->load->view('admin/ppdb/listSiswaPPDB', $data);
    }
    
    public function penempatan(){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $data['page'] = 'Kelola Kelas';
        $data['menu'] = 'Kelas';
        $data['siswa'] = $this->SiswaBaru_Model->getCandidate($id_mitra);        
        $data['jurusan'] = $this->PPDB_Model->get_jurusan($id_mitra);
        $data['kelas'] = $this->PPDB_Model->get_kelas($id_mitra);
        $data['angkatan'] = $this->PPDB_Model->get_angkatan($id_mitra);
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/ppdb/penempatan');
    }
    
    public function sudah_penempatan(){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $data['page'] = 'Kelola Kelas';
        $data['menu'] = 'Kelas';
        $data['siswa'] = $this->SiswaBaru_Model->getCandidate2($id_mitra);        
        $data['jurusan'] = $this->PPDB_Model->get_jurusan($id_mitra);
        $data['kelas'] = $this->PPDB_Model->get_kelas($id_mitra);
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/ppdb/penempatan');
    }
    
    public function proses_penempatan(){
        $ids = $this->input->post('check_id');
        $id_angkatan = $this->input->post('id_angkatan');
        $id_jurusan = $this->input->post('id_jurusan');
        $id_kelas = $this->input->post('id_kelas');
        
        foreach($ids as $id){
            $siswa = $this->SiswaBaru_Model->getSiswa_byid(null, $id);
            $siswa[0]['id_angkatan'] = $id_angkatan;
            $siswa[0]['id_jurusan'] = $id_jurusan;
            $siswa[0]['id_kelas'] = $id_kelas;
            
            $id_candidate = $this->SiswaBaru_Model->createCandidate($siswa[0]);
            
            $data_baru = array(
              'candidate_id' => $id_candidate,  
            );
            
            $this->SiswaBaru_Model->update($siswa[0]['id_siswaBaru'], $data_baru);
        }
        
        redirect(base_url('PPDB_Controller/penempatan'));
    }

    public function admin_dashboard()
    {
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $data = array(
            'total_uangmasuk' => $this->PPDB_Model->get_totalPembayaran(null)[0]['total'],
            'jumlah_pendaftar' => sizeof($this->SiswaBaru_Model->getSiswa_byid($id_mitra, null)),
            'laki' => sizeof($this->SiswaBaru_Model->getGender($id_mitra, 1)),
            'perempuan' => sizeof($this->SiswaBaru_Model->getGender($id_mitra, 2)),
            'jumlah_verifikasi1' => sizeof($this->SiswaBaru_Model->getSiswaVerifikasi($id_mitra,1)),
            'jumlah_verifikasi2' => sizeof($this->SiswaBaru_Model->getSiswaVerifikasi($id_mitra,2)),
            'jumlah_otkp' => sizeof($this->SiswaBaru_Model->getSiswaJurusan(2)),
            'jumlah_akl' => sizeof($this->SiswaBaru_Model->getSiswaJurusan(3)),
            'jumlah_bdp' => sizeof($this->SiswaBaru_Model->getSiswaJurusan(1)),
            'jumlah_tkj' => sizeof($this->SiswaBaru_Model->getSiswaJurusan(4)),
        );

        return $this->load->view('admin/ppdb/dashboard', $data);
    }

    public function verifikasi($id_siswaBaru){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $data = array(
            'id_siswaBaru' => $id_siswaBaru,
            'siswa' => $this->SiswaBaru_Model->getSiswa_byid($id_mitra, $id_siswaBaru)[0],
            'pembayaran' => $this->PPDB_Model->get_byIdSiswa($id_siswaBaru),
            'total_pembayaran' => $this->PPDB_Model->get_totalPembayaran($id_siswaBaru),
        );
        
        $data_pages['page'] = 'Verifikasi Pembayaran';
        $data_pages['menu'] = 'Verifikasi Pembayaran';
        $this->load->view('admin/layout/header', $data_pages);
        return $this->load->view('admin/ppdb/verifikasiSiswa', $data);
    }

    public function verifikasi_pembayaran($id_ppdb, $id_siswaBaru){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $siswa = $this->SiswaBaru_Model->getSiswa_byid($id_mitra, $id_siswaBaru);

        $data = array(
            'jumlah' => $this->input->post('jumlah'),
            'verifikasi' => 1,
        );

        $this->PPDB_Model->update($data, $id_ppdb);
        $this->update_status($id_siswaBaru);

        $message = "Terimakasih Pembayaran Anda telah diverifikasi.\n\nJumlah : ".rupiah($data['jumlah'])."\nTanggal :".date('d-m-y');

        // var_dump($siswa[0]['email']);die;
        // try {
        //     $this->kirimEmail($siswa[0]['email'], $message);                                  
        // } catch (Exception $e) {}
        // try {
        //     $this->kirimWhatsapp($siswa[0]['no_telp'], urlencode($message));
        // } catch (Exception $e) {}

        redirect(base_url('PPDB_Controller/verifikasi/'.$id_siswaBaru), 'refresh');
    }

    public function cancel_pembayaran($id_ppdb, $id_siswaBaru){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $siswa = $this->SiswaBaru_Model->getSiswa_byid($id_mitra, $id_siswaBaru);

        $data = array(
            'jumlah' => 0,
            'verifikasi' => 0,
        );

        $this->PPDB_Model->update($data, $id_ppdb);
        $this->update_status($id_siswaBaru);

        $message = "Konfirmasi Pembayaran telah dibatalkan, mohon cek kembali bukti pembayaran yang dikirimkan, hubungi panitia PPDB TALENTHUB untuk informasi lebih lanjut.";
        // try {
        //     $this->kirimEmail($siswa[0]['email'], $message);                                  
        // } catch (Exception $e) {}
        // try {
        //     $this->kirimWhatsapp($siswa[0]['no_telp'], urlencode($message));
        // } catch (Exception $e) {}

        redirect(base_url('PPDB_Controller/verifikasi/'.$id_siswaBaru), 'refresh');
    }

    public function tolak_pembayaran($id_ppdb, $id_siswaBaru){
        $id_mitra = $this->session->userdata('admin')['account_id'];
        
        $siswa = $this->SiswaBaru_Model->getSiswa_byid($id_mitra, $id_siswaBaru);

        $data = array(
            'jumlah' => 0,
            'verifikasi' => -1,
        );

        $this->PPDB_Model->update($data, $id_ppdb);
        $this->update_status($id_siswaBaru);

        $message = "Konfirmasi Pembayaran anda telah ditolak, mohon cek kembali bukti pembayaran yang dikirimkan, atau hubungi panitia PPDB TALENTHUB di nomor ini untuk informasi lebih lanjut.";
        // try {
        //     $this->kirimEmail($siswa[0]['email'], $message);                                  
        // } catch (Exception $e) {}
        // try {
        //     $this->kirimWhatsapp($siswa[0]['no_telp'], urlencode($message));
        // } catch (Exception $e) {}

        redirect(base_url('PPDB_Controller/verifikasi/'.$id_siswaBaru), 'refresh');
    }        

    // =============================================================

    public function proses_editProfileSiswa(){
        $id_siswaBaru = $this->input->post('id_siswaBaru');

        $data_baru = array(
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'tgl_lahir' => date('Y-m-d', strtotime(strtr($this->input->post('tgl_lahir'),'/','-'))),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'alamat' => $this->input->post('alamat'),
            'jurusan1' => $this->input->post('jurusan1'),
        );

        $this->SiswaBaru_Model->update($id_siswaBaru, $data_baru);

        redirect(base_url('PPDB_Controller/verifikasi/'.$id_siswaBaru), 'refresh');
    }

    public function proses_verifikasi(){
        $data = $this->PPDB_Model->get($this->input->post('id_ppdb'));
        
        $data_baru = array(
            'verifikasi' => 1,
            'jumlah' => $this->input->post('jumlah'),
        );

        $this->PPDB_Model->update($data_baru, $data[0]['id_ppdb']);

        redirect(base_url('PPDB_Controller/verifikasi_pembayaran/'.$data[0]['id_siswaBaru']), 'refresh');
    }

    public function proses_pendaftaran(){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $kode_pendaftaran = "K".$randomString;

        $data = array(
            'id_mitra' => $this->input->post('id_mitra'),
            'nama' => $this->input->post('nama'),
            'kode_pendaftaran' => $kode_pendaftaran,
            'jk' => $this->input->post('jk'),
            'tgl_lahir' => date('Y-m-d', strtotime(strtr($this->input->post('tanggal_lahir'),'/','-'))),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('hp'),
            'alamat' => $this->input->post('alamat'),
            'jurusan1' => $this->input->post('jurusan1'),
            'status' => 0,
            'provinsi' => $this->input->post('provinsi'),
            'kabupaten' => $this->input->post('city'),
            'kecamatan' => $this->input->post('state'),
        );

        $this->SiswaBaru_Model->create($data);

        $qrcode['data'] = $kode_pendaftaran;
        $qrcode['level'] = 'H';
        $qrcode['size'] = 10;
        $qrcode['savename'] = FCPATH. '/public/data/ppdb/qrcode/'.$kode_pendaftaran.'.png';
        $this->ciqrcode->generate($qrcode);

        $message = "SELAMAT ANDA TERLAH BERHASIL REGISTRASI \n\n NAMA LENGKAP : '".$data['nama']."' \nEMAIL : '".$data['email']."' \nTELEPON : '".$data['no_telp']."' \nTANGGAL LAHIR : '".$data['tgl_lahir']."' \n\nBERIKUT KODE PENDAFTARAN ANDA : '".$data['kode_pendaftaran']."' \n\n GUNAKAN KODE TERSEBUT UNTUK MELAKUKAN VERIFIKASI PEMBAYARAN \n\n Hati hati penipuan atas nama TALENTHUB.";

        // try {
        //     $this->kirimEmail($data['email'], $message);            
        // } catch (Exception $e) {}
        // try {
        //     $this->kirimWhatsapp($data['no_telp'], urlencode($message."\n\n Balas dengan kata 'konfirmasi' untuk melihat tata cara konfirmasi"));            
        // } catch (Exception $e) {}

        $pageData['page'] = "Form Pendaftaran PPDB";
        
        $this->load->view('front/layout/header2', $pageData);
        $this->load->view('admin/ppdb/berhasilDaftar.php', $data);
    }

    public function proses_uploadbuktipembayaran(){
        $id_siswaBaru = $this->input->post('id_siswaBaru');
        $siswa =  $this->SiswaBaru_Model->getSiswa_byid(null, $id_siswaBaru)[0];   
        $status = $this->SiswaBaru_Model->get_status($id_siswaBaru);

        $configUpload['upload_path'] = 'public/data/ppdb/pembayaran';

        $file_name= rand(1,9999).$_FILES["file_bukti"]['name'];
        $configUpload['file_name'] = $file_name;
        $configUpload['allowed_types']  = 'jpg|png|JPG|PNG';
        $configUpload['max_size']       = '2048000';
        $this->load->library('upload', $configUpload);
        $this->upload->initialize($configUpload);

        $allowedExts = array("jpg", "png", "JPG", "PNG");
        $extension = pathinfo($_FILES["file_bukti"]["name"], PATHINFO_EXTENSION);

        if(!in_array($extension, $allowedExts)) {
            
            redirect('PPDB_Controller/konfirmasi');
        }else{
            $upload_data = $this->upload->do_upload('file_bukti');
            
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'id_siswaBaru' => $id_siswaBaru,
                'bukti_pembayaran' => $this->upload->data()['file_name'],
                'jumlah' => 0,
                'tipe' => 0,
                'tanggal_bayar' => date('Y-m-d'),
                'verifikasi' => 0,
                'catatan' => $this->input->post('catatan'),
            );

            $this->PPDB_Model->create($data);

            $message = "Terimakasih Konfirmasi Pembayaran telah diterima. Informasi verifikasi akan di informasikan pada whatsapp dan email yang didaftarkan. Terimakasih.";
            // try {
            //     $this->kirimEmail($siswa['email'], $message);                                  
            // } catch (Exception $e) {}
            // try {
            //     $this->kirimWhatsapp($siswa['no_telp'], urlencode($message));
            // } catch (Exception $e) {}

            $pageData['page'] = "Berhasil Melakukan Pembayaran";
        
            $this->load->view('front/layout/header2', $pageData);
            $this->load->view('admin/ppdb/berhasilKonfirmasi.php', $data);
        }
    }

    public function kirimEmail($tujuan, $pesan){
        $this->load->config('email');
        $this->load->library('email', $this->config);
        
        $from = $this->config->item('smtp_user');
        $to = $tujuan;
        $subject = "PPDB TALENTHUB";
        $message = $pesan;
        
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            return 1;
        } else {
            var_dump($this->email->print_debugger());die;
            return 0;
        }
    }

    public function kirimWhatsapp($tujuan, $pesan){
        $device_id = '68d820562eabd2cc46fbe23873aa0024';

        return file_get_contents("https://app.whacenter.com/api/send?device_id=".$device_id."&number=".$tujuan."&message=".$pesan);
    }

    public function getTotalPembayaran($id_siswaBaru){
        $this->db->select('sum(jumlah) as total');
        $this->db->from('tbl_ppdb');
        $this->db->where('id_siswaBaru', $id_siswaBaru);

        return $this->db->get()->result_array();
    }

    public function update_status($id_siswaBaru){
        $total = $this->getTotalPembayaran($id_siswaBaru)[0]['total'];

        if ($total < $this->pembayaran_1) {
            $data = array('status' => 0,);
        }else if($total >= $this->pembayaran_1 && $total < $this->pembayaran_2){
            $data = array('status' => 1,);
        }else if($total >= $this->pembayaran_2){
            $data = array('status' => 2,);
        }

        return $this->SiswaBaru_Model->update($id_siswaBaru, $data);
    }

    public function download_buktipendaftaran($kode_pendaftaran){
        $mpdf = new Mpdf();
        $data = array(
            'siswa' => $this->SiswaBaru_Model->getSiswa_bykode($kode_pendaftaran),
        );
        
        $this->load->view('admin/ppdb/bukti_pendaftaran', $data);

        // $html = $this->load->view('admin/ppdb/bukti_pendaftaran', $data, TRUE);
        // $mpdf->WriteHTML($html);
        // $mpdf->debug = true;
        // $mpdf->Output('Bukti Pendaftaran.pdf', 'D');
    }
}