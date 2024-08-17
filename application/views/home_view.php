<!DOCTYPE html>
<html>
<head>
    <title>Projects and Locations</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Semua Proyek</h1>
        <a href="<?php echo site_url('add_project'); ?>" class="btn btn-primary mb-4">Tambah Proyek</a>

        <?php if (!empty($projects)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Klien</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Pimpinan Proyek</th>
                            <th>Keterangan</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $project->name; ?></td>
                            <td><?php echo $project->client; ?></td>
                            <td><?php echo $project->startTime; ?></td>
                            <td><?php echo $project->endTime; ?></td>
                            <td><?php echo $project->projectLead; ?></td>
                            <td><?php echo $project->note; ?></td>
                            <td>
                                <?php if (!empty($project->locations)): ?>
                                    <?php echo $project->locations[0]->city; ?>
                                <?php else: ?>
                                    Tidak ada lokasi tersedia
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('edit_project/' . $project->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?php echo base_url('api/delete_project/' . $project->id); ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada proyek tersedia</p>
        <?php endif; ?>

        <h1 class="mt-5 mb-4">Semua Lokasi</h1>
        <a href="<?php echo site_url('add_location'); ?>" class="btn btn-primary mb-4">Tambah Lokasi</a>
        <?php if (!empty($locations)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Negara</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($locations as $location): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $location->locationName; ?></td>
                            <td><?php echo $location->city; ?></td>
                            <td><?php echo $location->province; ?></td>
                            <td><?php echo $location->country; ?></td>
                            <td>
                                <a href="<?php echo base_url('edit_location/' . $location->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?php echo base_url('api/delete_location/' . $location->id); ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this location?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada lokasi tersedia</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
