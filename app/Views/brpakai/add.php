<?= $this->Extend('template/template') ?>
<?= $this->Section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pemakaian</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php //echo validation_errors(); 
                    ?>
                    <?= form_open(route_to('brpakai_add')) ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                        <div class="form-group">
                                    <label for="inputAddress">Nama Barang</label>
                                    <select class="form-select form-control" aria-label="Default select example" name="barang_Id">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($barangs as $data) : ?>
                                            <option value=<?= $data['id']; ?>><?= $data['nm_barang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>


                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 has-error">
                                    <label for="inputEmail4">Stok</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="stok" require value="<?= set_value('stok') ?>">
                                </div>
                               

                            </div>


                        </div>
            </div>
            <div class="modal-footer">
                <a href="<?= route_to('brpakai') ?>">
                    <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                </a>
                <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
            </div>
            <?= form_close() ?>

        </div>
    </div>
    <?= $this->endSection(); ?>