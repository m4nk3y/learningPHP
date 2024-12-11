<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMS</title>
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

    <h1>Movies Management System</h1>

    <!-- Dropdown chọn Cinema -->
    <label for="cinema">Select Cinema:</label>
    <select id="cinema">
        <option value="">-- Select Cinema --</option>
        @foreach($cinemas as $cinema)
        <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
        @endforeach
    </select>

    <button id="showMovies">Show Movies</button>

    <!-- Bảng hiển thị sách -->
    <table id="moviesTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Director</th>
                <th>Release Date</th>
                <th>Duration(mins)</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showMovies').addEventListener('click', function() {
            const cinemaId = document.getElementById('cinema').value;

            if (!cinemaId) {
                alert('Please select a Cinema.');
                return;
            }

            console.log(`Fetching movies for cinema: ${cinemaId}`);

            fetch(`/movies/${cinemaId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Movies:', data); // Debug: In ra console

                    const tbody = document.querySelector('#moviesTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((movie, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${movie.title}</td>
                    <td>${movie.director}</td>
                    <td>${movie.release_date}</td>
                    <td>${movie.duration}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('moviesTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>