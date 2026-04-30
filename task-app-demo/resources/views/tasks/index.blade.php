<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task App</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        
        <!-- Header with Logout -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Task Manager</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500">Logout</button>
            </form>
        </div>

        <!-- Add Task Form -->
        <form method="POST" action="/tasks" class="flex gap-2 mb-6">
            @csrf
            <input type="text" name="title"
                   class="border border-gray-300 p-2 flex-1 rounded focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="New Task" required>
            
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold transition">
                Add
            </button>
        </form>

        <!-- Task List -->
        @foreach($tasks as $task)
            <div class="flex items-center justify-between mb-2 p-2 border rounded">
                <div class="flex items-center">
                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('PATCH')
                        <button class="mr-2">
                            {{ $task->is_done ? '✔' : '❌' }}
                        </button>
                    </form>
                    
                    <span class="{{ $task->is_done ? 'line-through text-gray-400' : '' }}">
                        {{ $task->title }}
                    </span>
                </div>

                <form method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 ml-4">
                        Delete
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>