<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek dan Lokasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    .project-card {
        margin-bottom: 1rem;
    }

    .project-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .project-body {
        padding: 1rem;
    }

    .project-location {
        color: #6c757d;
    }

    .card-actions {
        margin-top: 1rem;
    }

    .card-actions a {
        color: #007bff;
        margin-right: 1rem;
    }

    .card-actions a:hover {
        text-decoration: none;
    }

    .card-actions .fa {
        margin-right: 0.5rem;
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
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('proyek'); ?>">Daftar Proyek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('lokasi'); ?>">Lokasi</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Proyek</h1>
        <a href="<?php echo site_url('proyek/add'); ?>" class="btn btn-primary mb-4">Tambah Data Proyek</a>
        <?php if(!empty($proyek)): ?>
        <?php foreach($proyek as $p): ?>
        <div class="card project-card">
            <div class="card-header project-header">
                <h5 class="card-title"><?php echo htmlspecialchars($p['namaProyek']); ?></h5>
            </div>
            <div class="card-body project-body">
                <p><strong>Client:</strong> <?php echo htmlspecialchars($p['client']); ?></p>
                <p><strong>Tanggal Mulai:</strong> <?php echo htmlspecialchars($p['tglMulai']); ?></p>
                <p><strong>Tanggal Selesai:</strong> <?php echo htmlspecialchars($p['tglSelesai']); ?></p>
                <p><strong>Pimpinan Proyek:</strong> <?php echo htmlspecialchars($p['pimpinanProyek']); ?></p>
                <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($p['keterangan']); ?></p>
                <p class="project-location"><strong>Lokasi:</strong>
                    <?php 
                                if(!empty($p['lokasi'])) {
                                    echo htmlspecialchars($p['lokasi']['namaLokasi']) . ', ' . htmlspecialchars($p['lokasi']['kota']) . ', ' . htmlspecialchars($p['lokasi']['provinsi']); 
                                } else {
                                    echo 'Data lokasi tidak tersedia';
                                }
                            ?>
                </p>
            </div>
            <div class="card-footer card-actions">
                <a href="<?php echo site_url('proyek/edit/' . $p['id']); ?>"><i class="fas fa-edit"></i>Edit</a>
                <a href="<?php echo site_url('proyek/delete/' . $p['id']); ?>"
                    onclick="return confirm('Are you sure you want to delete this item?');"><i
                        class="fas fa-trash"></i>Hapus</a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-info" role="alert">Data proyek tidak tersedia.</div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>