<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    .table-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem;
    }

    .table-container h1 {
        margin-bottom: 1.5rem;
    }

    .btn-action {
        margin: 0 5px;
    }

    .btn-action i {
        font-size: 1.2rem;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MyProject</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('proyek'); ?>">Daftar Proyek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('lokasi'); ?>">Daftar Lokasi</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4 table-container">
        <h1>Daftar Lokasi</h1>
        <a href="<?php echo site_url('lokasi/add'); ?>" class="btn btn-primary mb-4">Tambah Data Lokasi</a>
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lokasi</th>
                    <th>Negara</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lokasi)): ?>
                <?php $no = 1; ?>
                <?php foreach ($lokasi as $lokasi_item): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $lokasi_item['namaLokasi']; ?></td>
                    <td><?php echo $lokasi_item['negara']; ?></td>
                    <td><?php echo $lokasi_item['provinsi']; ?></td>
                    <td><?php echo $lokasi_item['kota']; ?></td>
                    <td>
                        <a href="<?php echo site_url('lokasi/edit/' . $lokasi_item['id']); ?>">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <a href="<?php echo site_url('lokasi/delete/' . $lokasi_item['id']); ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?');">
                            <i class="fas fa-trash fa-lg"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Data lokasi tidak tersedia.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>