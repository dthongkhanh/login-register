<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Past Due Notification</title>
</head>

<body>
    <p>This is to notify you that the task with the following details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $task->name }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
        <li><strong>Due Date:</strong> {{ $task->time_due }}</li>
    </ul>
    <p>is past due. Please resolve it.</p>
</body>

</html>