<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Proyek</h1>
        <form id="editProjectForm">
            <div class="form-group">
                <label for="name">Nama Proyek:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $project->name; ?>" required>
            </div>

            <div class="form-group">
                <label for="client">Klien:</label>
                <input type="text" class="form-control" id="client" name="client" value="<?php echo $project->client; ?>" required>
            </div>

            <div class="form-group">
                <label for="startTime">Tanggal Mulai:</label>
                <input type="date" class="form-control" id="startTime" name="startTime" value="<?php echo $project->startTime; ?>" required>
            </div>

            <div class="form-group">
                <label for="endTime">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="endTime" name="endTime" value="<?php echo $project->endTime; ?>" required>
            </div>

            <div class="form-group">
                <label for="projectLead">Pimpinan Proyek:</label>
                <input type="text" class="form-control" id="projectLead" name="projectLead" value="<?php echo $project->projectLead; ?>" required>
            </div>

            <div class="form-group">
                <label for="note">Keterangan:</label>
                <textarea class="form-control" id="note" name="note" rows="4"><?php echo $project->note; ?></textarea>
            </div>

            <div class="form-group">
                <label for="locations">Lokasi:</label>
                <select id="locations" name="locationName[]" class="form-control">
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->id; ?>"
                            <?php echo $location->id == $project->locations[0]->id ? 'selected' : ''; ?>>
                            <?php echo $location->city; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="button" class="btn btn-primary" onclick="submitForm()">Update Proyek</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('home'); ?>'">Kembali</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function submitForm() {
        const form = document.getElementById('editProjectForm');
        const formData = new FormData(form);
        
        const project = {
            name: formData.get('name'),
            client: formData.get('client'),
            startTime: formData.get('startTime'),
            endTime: formData.get('endTime'),
            projectLead: formData.get('projectLead'),
            note: formData.get('note'),
            locations: formData.getAll('locationName[]').map(id => ({ id }))
        };
        
        const apiUrl = '<?php echo config_item('api_url'); ?>';
        const projectId = '<?php echo $project->id; ?>';
        fetch(`${apiUrl}/updateProject/${projectId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(project)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            alert('Proyek berhasil diperbarui!');
            window.location.href = '<?php echo site_url('home'); ?>';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui proyek');
        });
    }
    </script>
</body>
</html>
