<?= $this->Extend('template/template')?>
<?= $this->Section('content')?>
    <!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Suplier</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?php //echo validation_errors(); ?>
        
                <?=form_open(route_to('edit_suplier',$suplier['id']),'',$hidden=array('_method'=>'PUT'))?>
                    <div class="modal-body"></div>
                    <div class="form-group">
                        <label for="inputAddress">Nama Suplier</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="nama suplier" name="nm_suplier" require value="<?=$suplier['nm_supplier']?>">
                        <input type="hidden" name="id" value="<?= $suplier['id']?>">
                    </div>
                    <div class="form-group has-error">
                        <label for="inputAddress">Kode suplier </label>
                        <input type="text" class="form-control" id="kode_barang" placeholder="kode suplier" name="kd_suplier" require value="<?=$suplier['kd_supplier']?>" >
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Alamat</label>
                        <!-- <input type="text" class="form-control" id="inputAddress" placeholder="Alamat" name="nama" require value="<?=set_value('nama')?>"> -->
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10"><?= $suplier['alamat']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">No HP</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="Masukkan No HP" name="no_hp" require value="<?=$suplier['no_hp']?>">
                        
                    </div>
                    <!-- <div class="form-group">
                        <label for="inputAddress">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="nama" name="nama" require value="<?=set_value('nama')?>">
                            <div class="form-check">
                                <input class="form-check-input" value="Laki-laki" type="radio" name="jenis_kelamin" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="Perempuan" type="radio" name="jenis_kelamin" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                    </div> -->
                    <div class="form-row">
                    </div>
        </div>
        </div>
                <div class="modal-footer">
                    <a href="<?= route_to('suplier') ?>">
                        <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                    </a>
                        <button type="submit" class="btn btn-success btn-flat" id="simpan">Ubah</button>
                    </div>
                    </form>
        </div>
</div>
<?=$this->endSection();?>