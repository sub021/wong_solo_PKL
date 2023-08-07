<?= $this->Extend('template/template')?>
<?= $this->Section('content')?>
    <!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Barang</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?php //echo validation_errors(); ?>
            <?= form_open(route_to('eproses_barang',$barang['id']),'', $hidden=array('_method'=>'PUT'))?>
                <!-- <form action="" method="post" enctype="multipart/form-data" > -->
                    <div class="modal-body">
                    <div class="form-group has-error">
                        <label for="inputAddress">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" placeholder="kode barang" name="kode_barang" value=<?= $barang['kd_barang']?> >
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Nama Barang</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="nama" name="nama_barang" require value=<?= $barang['nm_barang']?> >
                        
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6 has-error">
                        <label for="inputEmail4">Stok</label>
                        <input type="number" class="form-control" id="inputEmail4" name="stok" require value=<?= $barang['stok']?> >
                    </div>
        </div>
    </div>
        <div class="modal-footer">
                    <a href="<?= route_to('barang') ?>">
                        <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                    </a>
                        <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
                    </div>
                <?= form_close()?>
        </div>
</div>
<?=$this->endSection();?>