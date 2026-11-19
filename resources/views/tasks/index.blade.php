<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Taskly - My To-Do List</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1e293b;
            padding: 40px 20px;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        /* HEADER */

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
        }

        /* DASHBOARD */

        .dashboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e9edf5;
        }

        .card p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .card h2 {
            font-size: 27px;
        }

        .blue {
            color: #2563eb;
        }

        .green {
            color: #16a34a;
        }

        .orange {
            color: #ea580c;
        }

        /* PROGRESS */

        .progress-box {
            background: white;
            padding: 22px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #e9edf5;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .progress-bar {
            width: 100%;
            height: 9px;
            background: #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #2563eb;
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        /* MAIN CONTENT */

        .task-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e9edf5;
        }

        .task-header {
            margin-bottom: 20px;
        }

        .task-header h2 {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .task-header p {
            color: #64748b;
            font-size: 14px;
        }

        /* FORM */

        .form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input {
            flex: 1;
            min-width: 0;
            padding: 13px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        button {
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.2s;
            font-size: 13px;
        }

        button:hover {
            opacity: 0.85;
            transform: translateY(-1px);
        }

        .add {
            background: #2563eb;
            color: white;
            padding: 0 20px;
            font-weight: bold;
        }

        /* SEARCH */

        .search {
            width: 100%;
            margin-bottom: 15px;
        }

        /* FILTER */

        .filters {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .filter-btn {
            padding: 9px 15px;
            background: #f1f5f9;
            color: #64748b;
        }

        .filter-btn.active {
            background: #2563eb;
            color: white;
        }

        /* TASK ITEM */

        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #edf0f5;
            transition: 0.2s;
        }

        .task:last-child {
            border-bottom: none;
        }

        .task-title {
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .completed {
            text-decoration: line-through;
            color: #94a3b8;
        }

        .actions {
            display: flex;
            gap: 7px;
            flex-shrink: 0;
        }

        .complete {
            background: #dcfce7;
            color: #15803d;
            padding: 9px 12px;
        }

        .delete {
            background: #fee2e2;
            color: #dc2626;
            padding: 9px 12px;
        }

        /* EMPTY STATE */

        .empty {
            text-align: center;
            padding: 35px 10px;
            color: #94a3b8;
            font-size: 14px;
        }

        .alert {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin: -10px 0 15px;
        }

        /* RESPONSIVE */

        @media (max-width: 600px) {

            body {
                padding: 25px 15px;
            }

            .dashboard {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 25px;
            }

            .task-container {
                padding: 18px;
            }

            .task {
                align-items: flex-start;
            }

            .actions {
                flex-direction: column;
            }

            .filters {
                overflow-x: auto;
            }

        }

    </style>
</head>

<body>

    @php
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('is_completed', true)->count();
        $activeTasks = $totalTasks - $completedTasks;

        $progress = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;
    @endphp

    <div class="container">

        <!-- HEADER -->

        <div class="header">

            <h1>My Tasks.</h1>

            <p>Organize your day, one task at a time.</p>

        </div>


        <!-- DASHBOARD -->

        <div class="dashboard">

            <div class="card">

                <p>Total Tasks</p>

                <h2 class="blue">{{ $totalTasks }}</h2>

            </div>

            <div class="card">

                <p>Completed</p>

                <h2 class="green">{{ $completedTasks }}</h2>

            </div>

            <div class="card">

                <p>Remaining</p>

                <h2 class="orange">{{ $activeTasks }}</h2>

            </div>

        </div>


        <!-- PROGRESS -->

        <div class="progress-box">

            <div class="progress-info">

                <span>Overall Progress</span>

                <strong>{{ $progress }}%</strong>

            </div>

            <div class="progress-bar">

                <div
                    class="progress-fill"
                    style="width: {{ $progress }}%">
                </div>

            </div>

        </div>


        <!-- TASK CONTAINER -->

        <div class="task-container">

            <div class="task-header">

                <h2>My To-Do List</h2>

                <p>Manage your daily activities here.</p>

            </div>


            <!-- FLASH MESSAGE -->

            @if (session('success'))

                <div class="alert">
                    {{ session('success') }}
                </div>

            @endif


            <!-- VALIDATION ERROR -->

            @error('title')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror


            <!-- ADD TASK -->

            <form action="{{ route('tasks.store') }}"
                  method="POST"
                  class="form">

                @csrf

                <input
                    type="text"
                    name="title"
                    placeholder="What needs to be done?"
                    value="{{ old('title') }}"
                    required
                >

                <button type="submit" class="add">
                    + Add Task
                </button>

            </form>


            <!-- SEARCH -->

            <input
                type="text"
                id="searchInput"
                class="search"
                placeholder="Search your tasks..."
            >


            <!-- FILTER -->

            <div class="filters">

                <button class="filter-btn active"
                        data-filter="all">
                    All
                </button>

                <button class="filter-btn"
                        data-filter="active">
                    Active
                </button>

                <button class="filter-btn"
                        data-filter="completed">
                    Completed
                </button>

            </div>


            <!-- TASK LIST -->

            <div id="taskList">

                @forelse ($tasks as $task)

                    <div class="task"
                         data-status="{{ $task->is_completed ? 'completed' : 'active' }}">

                        <span class="task-title {{ $task->is_completed ? 'completed' : '' }}">

                            {{ $task->title }}

                        </span>


                        <div class="actions">

                            <!-- COMPLETE -->

                            <form action="{{ route('tasks.update', $task->id) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="complete">

                                    {{ $task->is_completed ? 'Undo' : 'Done' }}

                                </button>

                            </form>


                            <!-- DELETE -->

                            <form action="{{ route('tasks.destroy', $task->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @empty

                    <div class="empty">
                        Belum ada tugas. Yuk, tambahkan tugas pertamamu!
                    </div>

                @endforelse

            </div>

            <p id="noResults" class="empty" hidden>
                Tugas tidak ditemukan.
            </p>

        </div>

    </div>


    <!-- JAVASCRIPT -->

    <script>

        const searchInput = document.getElementById('searchInput');

        const taskItems = document.querySelectorAll('.task');

        const filterButtons = document.querySelectorAll('.filter-btn');

        const noResults = document.getElementById('noResults');

        let currentFilter = 'all';


        function filterTasks() {

            const keyword = searchInput.value.toLowerCase();

            let visibleTasks = 0;

            taskItems.forEach(task => {

                const title = task.querySelector('.task-title')
                    .textContent.toLowerCase();

                const status = task.dataset.status;

                const matchesSearch = title.includes(keyword);

                const matchesFilter =
                    currentFilter === 'all' ||
                    currentFilter === status;

                if (matchesSearch && matchesFilter) {

                    task.style.display = 'flex';

                    visibleTasks++;

                } else {

                    task.style.display = 'none';

                }

            });

            noResults.hidden = visibleTasks > 0;

        }


        searchInput.addEventListener('input', filterTasks);


        filterButtons.forEach(button => {

            button.addEventListener('click', function() {

                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                });

                this.classList.add('active');

                currentFilter = this.dataset.filter;

                filterTasks();

            });

        });

    </script>

</body>

</html>