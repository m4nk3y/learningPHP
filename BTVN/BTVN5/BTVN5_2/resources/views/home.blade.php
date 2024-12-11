<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LRMS</title>
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

    <h1>Laptop Renting Management System</h1>

    <!-- Dropdown chọn người thuê -->
    <label for="renter">Select Renter:</label>
    <select id="renter">
        <option value="">-- Select Renter --</option>
        @foreach($renters as $renter)
        <option value="{{ $renter->id }}">{{ $renter->name }}, {{ $renter->phone_number }}</option>
        @endforeach
    </select>

    <button id="showLaptops">Show renting laptop</button>

    <!-- Bảng hiển thị laptop -->
    <table id="laptopsTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Specifications</th>
                <th>Rental Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showLaptops').addEventListener('click', function() {
            const renterId = document.getElementById('renter').value;

            if (!renterId) {
                alert('Please select a renter.');
                return;
            }

            console.log(`Fetching laptops for renter ID: ${renterId}`);

            fetch(`/laptops/${renterId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Laptops:', data);

                    const tbody = document.querySelector('#laptopsTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((laptop, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${laptop.brand}</td>
                    <td>${laptop.model}</td>
                    <td>${laptop.specifications}</td>
                    <td>${laptop.rental_status ? 'Đang cho thuê' : 'Chưa cho thuê' }</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('laptopsTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>