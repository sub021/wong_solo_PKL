<?= $this->Extend('template/template') ?>
<?= $this->Section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Setting Permission <?= $user->username?></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php //echo validation_errors(); 
                    ?>
                    <?= form_open(route_to('MyPermission_proses', $user->id), '', $hidden = array('_method' => 'PATCH')) ?>
                    <!-- <form action="" method="post" enctype="multipart/form-data" > -->
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="">
                                    <div class="form-group">
                                        <label for="">Hak Akses</label>
                                        <select class="form-select" name="group" aria-label="Default select example">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="save" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Save</label>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="update" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Update</label>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="delete" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Delete</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="<?= route_to('user') ?>">
                    <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                </a>
                <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
    <?= $this->endSection(); ?>