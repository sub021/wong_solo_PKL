<?= $this->Extend('template/template')?>
<?= $this->Section('content')?>
    <!-- Begin Page Content -->
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data User</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?= form_open(route_to('user_res'))?>
  
                    <div class="modal-body">

                    <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="Email Address" value="" required />
                        
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Username</label>
                        <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username" placeholder="Username" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">password</label>
                        <input type="password" class="form-control" name="password" inputmode="text" autocomplete="new-password" placeholder="Password" required />
                        
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">password Confirm</label>
                        <input type="password" class="form-control" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="Password (again)" required />
                        
                    </div>


        </div>
       
                    
      </div>
                <div class="modal-footer">
                    <a href="<?= route_to('user') ?>">
                        <div class="btn btn-warning"><i class="fas fa-undo">Kembali</i></div>
                    </a>
                        <button type="submit" class="btn btn-success btn-flat" id="simpan">Simpan</button>
                    </div>
                <?= form_close()?>

        </div>
</div>
<?=$this->endSection();?>