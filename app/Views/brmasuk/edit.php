<?= $this->Extend('template/template') ?>
<?= $this->Section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php //echo validation_errors(); 
                    ?>
                    <?= form_open(route_to('brmasuk_proses', $brmasuk['id']), '', $hidden = array('_method' => 'PUT')) ?>
                    <!-- <form action="" method="post" enctype="multipart/form-data" > -->
                    <div class="modal-body">
                        <div class="form-group has-error">
                            <input type="hidden" name="id" value=<?= $brmasuk['id'] ?>>
                            <label for="inputAddress">Kode Barang: <span class="badge text-bg-warning"><?= $brmasuk['kd_barang'] ?> || <?= $brmasuk['nm_barang'] ?></span></label>

                            <input type="hidden" name="barang_Id" value="<?= $barangs[0]['id'] ?>">
                            <input type="text" class="form-control" disabled value="<?= $barangs[0]['kd_barang'] ?> || <?= $barangs[0]['nm_barang'] ?>">


                            <div class="form-row">
                                <div class="form-group col-md-6 has-error">
                                    <label for="inputEmail4">Stok</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="stok" require value=<?= $brmasuk['stok'] ?>>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Nama suplier : <span class="badge text-bg-warning"> <?= $brmasuk['nm_supplier'] ?></span></label>

                                    <select class="form-select form-control" aria-label="Default select example" name="suplier_id">
                                        <option value="<?= $brmasuk['nm_supplier'] ?> " selected>Pilih Nama Suplier</option>
                                        <?php foreach ($supliers as $data) : ?>
                                            <option value=<?= $data['id']; ?>><?= $data['nm_supplier'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="<?= route_to('brmasuk') ?>">
                                <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                            </a>
                            <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
                        </div>
                        <?= form_close() ?>
                    </div>
            </div>
            <?= $this->endSection(); ?>