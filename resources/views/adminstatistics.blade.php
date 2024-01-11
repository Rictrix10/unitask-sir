<!DOCTYPE html>
<html>
<head>
    <title>Admin Statistics</title>
</head>
<body>
    <h1>Admin Statistics</h1>

    <p>Total Users: {{ $totalUsers }}</p>

    <h2>Tasks Percentage by State</h2>
    <ul>
        @foreach($tasksPercentageByState as $state)
            <li>
                {{ $state['state_name'] }}: {{ number_format($state['percentage'], 2) }}%
            </li>
        @endforeach
    </ul>

    <p>Total Tasks: {{ $totalTasks }}</p>
    <p>Total Shared Tasks: {{ $totalSharedTasks }}</p>
</body>
</html>

