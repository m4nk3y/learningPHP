<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
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

    <h1>Library System</h1>

    <!-- Dropdown chọn thư viện -->
    <label for="library">Select Library:</label>
    <select id="library">
        <option value="">-- Select Library --</option>
        @foreach($libraries as $library)
        <option value="{{ $library->id }}">{{ $library->name }}</option>
        @endforeach
    </select>

    <button id="showBooks">Show Books</button>

    <!-- Bảng hiển thị sách -->
    <table id="booksTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showBooks').addEventListener('click', function() {
            const libraryId = document.getElementById('library').value;

            if (!libraryId) {
                alert('Please select a library.');
                return;
            }

            console.log(`Fetching books for library ID: ${libraryId}`);

            fetch(`/books/${libraryId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Books:', data); // Debug: In ra console

                    const tbody = document.querySelector('#booksTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((book, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${book.title}</td>
                    <td>${book.author}</td>
                    <td>${book.publication_year}</td>
                    <td>${book.genre}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('booksTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>