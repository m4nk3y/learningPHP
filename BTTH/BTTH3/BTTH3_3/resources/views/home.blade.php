<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMS</title>
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

    <h1>Computer Issues Management System</h1>

    <!-- Dropdown chọn Computer -->
    <label for="computer">Select Computer:</label>
    <select id="computer">
        <option value="">-- Select Computer --</option>
        @foreach($computers as $computer)
        <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
        @endforeach
    </select>

    <button id="showIssues">Show Issues</button>

    <!-- Bảng hiển thị sách -->
    <table id="issuesTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Reported By</th>
                <th>Reported Date</th>
                <th>Description</th>
                <th>Urgency</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showIssues').addEventListener('click', function() {
            const computerId = document.getElementById('computer').value;

            if (!computerId) {
                alert('Please select a Computer.');
                return;
            }

            console.log(`Fetching issues for computer: ${computerId}`);

            fetch(`/issues/${computerId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Issues:', data); // Debug: In ra console

                    const tbody = document.querySelector('#issuesTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((issue, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${issue.reported_by}</td>
                    <td>${issue.reported_date}</td>
                    <td>${issue.description}</td>
                    <td>${issue.urgency}</td>
                    <td>${issue.status}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('issuesTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>