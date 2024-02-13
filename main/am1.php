<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Attendance Management</h1>

    <table>
        <tr>
            <th>Attendance ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <!-- Table data will be populated dynamically -->
        <tr>
            <td>Attendance 1</td>
            <td>2024-01-31</td>
            <td>08:00 AM</td>
            <td>
                <button onclick="deleteAttendance('Attendance 1')">Delete</button>
                <button onclick="editAttendance('Attendance 1')">Edit</button>
            </td>
        </tr>
        <tr>
            <td>Attendance 2</td>
            <td>2024-01-30</td>
            <td>09:15 AM</td>
            <td>
                <button onclick="deleteAttendance('Attendance 2')">Delete</button>
                <button onclick="editAttendance('Attendance 2')">Edit</button>
            </td>
        </tr>
        <!-- Add more rows for new attendances -->
    </table>

    <button onclick="window.location.href='mark_attendance.php'">Add New Attendance</button>
</div>

<script>
    function deleteAttendance(attendanceID) {
        // Logic for deleting attendance records
        console.log('Deleting attendance:', attendanceID);
    }

    function editAttendance(attendanceID) {
        // Logic for editing attendance records
        console.log('Editing attendance:', attendanceID);
    }
</script>

</body>
</html>
