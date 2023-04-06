<!-- Modal -->
<div class="modal fade" id="modalEditSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('PPDB_Controller/proses_editProfileSiswa') ?>" method="POST">
                <input type="hidden" name="id_siswaBaru" value="<?php echo $siswa['id_siswaBaru'] ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <!-- Pembayaran -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="Pembayaran" style="margin-top: 8px;">Kode Pendaftaran</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Pembayaran" name="kode_pendaftaran" placeholder="Pembayaran" value="<?php echo $siswa['kode_pendaftaran']?>" readonly> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Nama Siswa</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Jumlah_Bayaran" name="nama" placeholder="Nama Siswa" value="<?php echo $siswa['nama']?>" required>  
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Jurnal -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Jenis Kelamin</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control" name="jk" required>
                                    <option value="1" selected="<?php if($siswa['jk'] == 1): ?> selected <?php endif;?>">Laki-laki</option>
                                    <option value="2" selected="<?php if($siswa['jk'] == 2): ?> selected <?php endif;?>">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Tanggal Lahir</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control datepicker" id="Tanggal_Lahir" name="tgl_lahir" placeholder="Besar Cicilan" value="<?php echo date('d/m/Y', strtotime($siswa['tgl_lahir']))?>" required> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Email</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Jumlah_Bayaran" name="email" placeholder="Email Siswa" value="<?php echo $siswa['email']?>" required> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">No Telp</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="Jumlah_Bayaran" name="no_telp" placeholder="No telp" value="<?php echo $siswa['no_telp']?>" required> 
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Alamat</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="Alamat" class="form-control" cols="30" rows="5" placeholder="Alamat" required><?php echo $siswa['alamat'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="" style="margin-top: 8px;">Jurusan</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control" id="jurusan" name="jurusan1">
                                    <option value="2">Otomatisasi & tata kelola perkantoran</option>
                                    <option value="3">Akuntansi & Keuangan lembaga</option>
                                    <option value="1">Bisnis Daring & Pemasaran</option>
                                    <option value="4">Teknik Komputer & Jaringan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit">SUBMIT</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><strong>TUTUP</strong></button>
                    <!-- <a href="<?php echo base_url('Siswa_Controller/detailSiswa/'.$siswa['id_siswa'].'/edit') ?>" type="btn btn-primary" class="btn btn-sm btn-success" style="color: white;"><strong>EDIT PROFILE</strong></a> -->
                </div>
            </form>
        </div>
    </div>
</div>