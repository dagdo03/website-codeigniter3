<!DOCTYPE html>
<html>
<head>
    <title>Add Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Proyek Baru</h1>
        <form id="addProjectForm">
            <div class="form-group">
                <label for="name">Nama Proyek:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="client">Klien:</label>
                <input type="text" class="form-control" id="client" name="client" required>
            </div>

            <div class="form-group">
                <label for="startTime">Tanggal Mulai:</label>
                <input type="date" class="form-control" id="startTime" name="startTime" required>
            </div>

            <div class="form-group">
                <label for="endTime">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="endTime" name="endTime" required>
            </div>

            <div class="form-group">
                <label for="projectLead">Pimpinan Proyek:</label>
                <input type="text" class="form-control" id="projectLead" name="projectLead" required>
            </div>

            <div class="form-group">
                <label for="note">Keterangan:</label>
                <textarea class="form-control" id="note" name="note" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="locations">Lokasi:</label>
                <select id="locations" name="locationName[]" class="form-control">
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo $location->id; ?>">
                            <?php echo $location->city; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="button" class="btn btn-primary" onclick="submitForm()">Tambah Proyek</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('home'); ?>'">Kembali</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    function submitForm() {
        const form = document.getElementById('addProjectForm');
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
        
        fetch(`${apiUrl}/addProject`, { 
            method: 'POST',
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
            alert('Proyek berhasil ditambahkan!');
            window.location.href = 'home';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menambahkan proyek baru');
        });
    }
</script>
</body>
</html>
