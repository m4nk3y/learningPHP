<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        select,
        button {
            padding: 10px;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background: #f4f4f4;
        }
    </style>
</head>

<body>

    <h1>Hardware Device Management System</h1>

    <!-- Dropdown chọn IT Center -->
    <label for="itcenter">Select IT Center:</label>
    <select id="itcenter">
        <option value="">-- Select IT Center --</option>
        @foreach($itCenters as $itCenter)
        <option value="{{ $itCenter->id }}">{{ $itCenter->name }}</option>
        @endforeach
    </select>

    <button id="showHDs">Show Hardware Devices</button>

    <!-- Bảng hiển thị sách -->
    <table id="hardwareDevicesTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Device Name</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showHDs').addEventListener('click', function() {
            const itCenterId = document.getElementById('itcenter').value;

            if (!itCenterId) {
                alert('Please select a IT Center.');
                return;
            }

            console.log(`Fetching hardware devices for IT Center ID: ${itCenterId}`);

            fetch(`/hardwareDevices/${itCenterId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Hardware Devices:', data); // Debug: In ra console

                    const tbody = document.querySelector('#hardwareDevicesTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((hd, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${hd.device_name}</td>
                    <td>${hd.type}</td>
                    <td>${hd.status ? 'Working' : 'Broken'}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('hardwareDevicesTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>