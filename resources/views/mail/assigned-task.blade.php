<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment Notification</title>
</head>
<body>
    <h1>Task Notification</h1>

    <p>Dear {{ $assignedEmployee->name }},</p>

    <p>You have been assigned a new task:</p>

    <ul>
        <li><strong>Task Title:</strong> {{ $task->title }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
        <li><strong>Status:</strong> {{ $task->status }}</li>
        <li><strong>Assigned on:</strong> {{ $date }}</li>
    </ul>
</body>
</html>
