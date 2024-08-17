<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek</title>
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
                    <a class="nav-link" href="#">Edit Proyek <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('lokasi'); ?>">Lokasi</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="form-container">
            <h1>Edit Proyek</h1>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?php echo site_url('proyek/update'); ?>">
                <input type="hidden" name="id" value="<?php echo $proyek['id']; ?>">

                <div class="form-group">
                    <label for="namaProyek">Nama Proyek:</label>
                    <input type="text" class="form-control" id="namaProyek" name="namaProyek"
                        value="<?php echo $proyek['namaProyek']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="client">Client:</label>
                    <input type="text" class="form-control" id="client" name="client"
                        value="<?php echo $proyek['client']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="tglMulai">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="tglMulai" name="tglMulai"
                        value="<?php echo $proyek['tglMulai']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="tglSelesai">Tanggal Selesai:</label>
                    <input type="date" class="form-control" id="tglSelesai" name="tglSelesai"
                        value="<?php echo $proyek['tglSelesai']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="pimpinanProyek">Pimpinan Proyek:</label>
                    <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek"
                        value="<?php echo $proyek['pimpinanProyek']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control" id="keterangan"
                        name="keterangan"><?php echo $proyek['keterangan']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="idLokasi">Lokasi:</label>
                    <select class="form-control" id="idLokasi" name="idLokasi" required>
                        <?php if (!empty($lokasi_list)): ?>
                        <?php foreach ($lokasi_list as $lokasi): ?>
                        <option value="<?php echo $lokasi['id']; ?>"
                            <?php echo ($lokasi['id'] == $proyek['idLokasi']) ? 'selected' : ''; ?>>
                            <?php echo $lokasi['namaLokasi'] . ' - ' . $lokasi['kota'] . ', ' . $lokasi['provinsi']; ?>
                        </option>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <option value="">Tidak ada data lokasi</option>
                        <?php endif; ?>
                    </select>
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