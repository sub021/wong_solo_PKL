<?= $this->Extend('template/template') ?>
<?= $this->Section('content') ?>
<div class="container-fluid">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url() ?>img/ws1.jpg" class="d-block w-100" alt="..." style="height: 20rem; width: 100rem;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>img/cropped-logo1.jpg" class="d-block w-100" alt="..." style="height: 20rem; width: 100rem;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() ?>img/3.jpg" class="d-block w-100" alt="..." style="height: 20rem; width: 100rem;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="shadow-sm px-2 w-10 bg-dark py-1 mt-1"></div>
    <div class="d-flex">
        <p class="fs-5 px-2 py-3 justify-content-between">Wongsolo didirikan pada tahun 1992 dan bergerak di bidang usaha kuliner. Ayam Bakar wongsolo lahir di kota Medan, Sumatera Utara. Di perkenalkan pertama kali oleh Bapak Puspo Wardoyo sebagai pemilik sekaligus Owner Wongsolo Group. Dengan modal Rp 700 ribu, pengusaha yang memang asli Solo ini membuka warung ayam bakar ala kaki lima di kawasan Polonia, Medan. Berkat usaha keras dan resep bumbu ayam bakar yang lezat, pak Puspo mampu memperluas jaringan usahanya dengan membuka beberapa cabang.
            Kini, Ayam Bakar Wongsolo sudah memiliki 100 lebih outlet di seluruh Indonesia. Antara lain di Medan, Banda Aceh, Padang, Solo, Denpasar, Pekanbaru, Surabaya, Semarang, Jakarta, Malang, Yogyakarta, Sulawes dan Banjarmasin.
            Pesatnya perkembang teknologi dan lajunya arus kehidupan yang menurut masyarakat untuk melakukan segalanya serba cepat dalam waktu yang sesingkatnya, membuat sebagian orang berpikir untuk membuat peluang usaha demi mencapai kebutuhan manusia lainnya. Tidak semua orang yang tengah merintis bisnis bersikap hati-hati dengan intrik-intrik kriminal yang dapat merugikan jalannya usaha, maupun bersikap hatihati dengan lajunya usaha produksi yang berasal dari pebisnis itu sendiri. Untuk masalah bahan baku dalam manajemen rumah makan adalah beras, sayur, ikan dan danging ternak ayam atau itik , bumbu-bumbu dan yang lainnya. Usaha rumah makan bukan hanya sesuatu yang dianggap sepele tetapi sudah mempunyai fokus yang diarahkan dalam suatu kawasan. Baik itu sebagai usaha, ataupun sebagai usaha pokok karena mempunyai bisnis rumah makan cukup menguntungkan dan dapat dijadikan sebagai sumber pendapatan
            Pada Rumah Makan Wongsolo Sabilal Banjarmasin proses pencatatan masih dilakukan dengan manual.
        </p>
    </div>
</div>
<?= $this->endSection() ?>