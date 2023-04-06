<!-- Modal -->
<div class="modal fade" id="modal<?php echo $id_ppdb ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Halaman Verifikasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('PPDB_Controller/verifikasi_pembayaran/'.$id_ppdb.'/'.$id_siswaBaru) ?>" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="hidden" name="id_ppdb" value="<?php echo $id_ppdb ?>">
                <div class="modal-body">
                    <center><h3>Bukti Pembayaran</h3>
                    <img style="width: 60%;" src="<?php echo base_url('public/data/ppdb/pembayaran/'.$bukti_pembayaran) ?>" alt="Not Found" onerror=this.src="<?php echo base_url('public/data/ppdb/default.png') ?>">
                    </center>
                    <!-- jumlah pembayaran -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="jumlah" style="margin-top: 8px;">Jumlah Pembayaran</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jumlah" placeholder="jumlah pembayaran" required> 
                            </div>
                        </div>
                    </div>
                    <!-- catatan pembayaran -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="jumlah" style="margin-top: 8px;">Catatan pembayaran</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="catatan" placeholder="catatan pembayaran" value="<?php echo $catatan ?>" required> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><strong>TUTUP</strong></button>
                    <button type="submit" class="btn btn-sm btn-primary"><strong>Verifikasi</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>