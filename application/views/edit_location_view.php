<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Lokasi</h1>
        <form id="editLocationForm">
            <div class="form-group">
                <label for="locationName">Nama Lokasi:</label>
                <input type="text" class="form-control" id="locationName" name="locationName" value="<?php echo $location->locationName; ?>" required>
            </div>

            <div class="form-group">
                <label for="country">Negara:</label>
                <input type="text" class="form-control" id="country" name="country" value="<?php echo $location->country; ?>" required>
            </div>

            <div class="form-group">
                <label for="province">Provinsi:</label>
                <input type="text" class="form-control" id="province" name="province" value="<?php echo $location->province; ?>" required>
            </div>

            <div class="form-group">
                <label for="city">Kota:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $location->city; ?>" required>
            </div>

            <button type="button" class="btn btn-primary" onclick="submitForm()">Update Lokasi</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('home'); ?>'">Kembali</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function submitForm() {
        const form = document.getElementById('editLocationForm');
        const formData = new FormData(form);
        
        const project = {
            locationName: formData.get('locationName'),
            country: formData.get('country'),
            province: formData.get('province'),
            city: formData.get('city')
        };
        
        const apiUrl = '<?php echo config_item('api_url'); ?>';
        const locationId = '<?php echo $location->id; ?>';
        fetch(`${apiUrl}/editLocation/${locationId}`, {
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
            alert('Lokasi berhasil diperbarui!');
            window.location.href = '<?php echo site_url('home'); ?>';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui lokasi');
        });
    }
    </script>
</body>
</html>
