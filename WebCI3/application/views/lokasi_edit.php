<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 1.5rem;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        background-color: #fff;
    }

    .form-container h1 {
        margin-bottom: 1.5rem;
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Edit Lokasi<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('lokasi'); ?>">Lokasi</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="form-container">
            <h1>Edit Lokasi Baru</h1>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?php echo site_url('lokasi/update'); ?>">
                <input type="hidden" name="id" value="<?php echo $lokasi['id']; ?>">
                <div class="form-group">
                    <label for="namaLokasi">Nama Lokasi:</label>
                    <input type="text" class="form-control" id="namaLokasi" name="namaLokasi"
                        value="<?php echo $lokasi['namaLokasi']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="negara">Negara:</label>
                    <input type="text" class="form-control" id="negara" name="negara"
                        value="<?php echo $lokasi['negara']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi:</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi"
                        value="<?php echo $lokasi['provinsi']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $lokasi['kota']; ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>