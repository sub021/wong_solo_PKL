<?= $this->Extend('template/template') ?>
<?= $this->Section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <a href="<?= route_to('brmasuk_add') ?>" class="btn btn-sm btn-primary mb-3 "><i class="fas fa-plus fa-sm"></i> Tambah Data Barang</a>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="masuk" width=" 100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Nama suplier </th>
                            <th>Aksi</th>

                        </tr>

                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($brmasuk as $data) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $data['kd_barang'] ?></td>
                                <td><?= $data['nm_barang'] ?></td>
                                <td><?= $data['stok'] ?></td>
                                <td><?= $data['nm_supplier'] ?></td>
                                <td class="d-flex">
                                    <a href="<?= route_to('brmasuk_edit', $data['id']) ?>" class="btn btn-warning mr-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    <?= form_open(route_to('delete_brmasuk', $data['id']), '', $hidden = array('_method' => 'delete')) ?>
                                    <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg>
                                    </button>
                                    <?= form_close() ?>
                                </td>
                            </tr>
                        <?php $no++;
                        endforeach ?>
                    </tbody>


                    <tr>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
        <?= $this->endSection(); ?>

        <?= $this->Section('toasts') ?>
        <?php
        if (session()->getFlashdata('info')) {
        ?>
            <div class="toast float-none z-3 ml-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2500">
                <div class="toast-header text-bg-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                    </svg>
                    <strong class="me-auto ml-2 ">Notifikasi</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?= session()->getFlashdata('info') ?>
                </div>
            </div>
        <?php } ?>
        <?= $this->endSection() ?>


        <?= $this->Section('table') ?>
        <script>
            new DataTable('#masuk', {
                pagingType: 'full_numbers'
            });
        </script>

        <script>
            $(document).ready(function() {
                $(".toast").toast('show');
            });
        </script>
        <?= $this->endSection() ?>