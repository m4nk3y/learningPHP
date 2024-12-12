<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSMS</title>
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

    <h1>Medicine Selling Management System</h1>

    <!-- Dropdown chọn Medicine -->
    <label for="medicine">Select Medicine:</label>
    <select id="medicine">
        <option value="">-- Select Medicine --</option>
        @foreach($medicines as $medicine)
        <option value="{{ $medicine->medicine_id }}">{{ $medicine->name }}</option>
        @endforeach
    </select>

    <button id="showSales">Show Sales</button>

    <!-- Bảng hiển thị sách -->
    <table id="salesTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Quantity</th>
                <th>Sale Date</th>
                <th>Customer Phone</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showSales').addEventListener('click', function() {
            const medicineId = document.getElementById('medicine').value;

            if (!medicineId) {
                alert('Please select a Medicine.');
                return;
            }

            console.log(`Fetching sales for medicine: ${medicineId}`);

            fetch(`/sales/${medicineId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Sales:', data); // Debug: In ra console

                    const tbody = document.querySelector('#salesTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((sale, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${sale.quantity}</td>
                    <td>${sale.sale_date}</td>
                    <td>${sale.customer_phone}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('salesTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>