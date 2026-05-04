<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl p-6">

    <!-- HEADER -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">📋 To-Do List App</h1>
        <p class="text-gray-400 mt-2">Kelola tugas harianmu dengan mudah</p>
    </div>

    <!-- USER INFO -->
    <div class="mb-6 flex justify-between items-center">
        @auth
            <span class="text-sm text-gray-300">
                Login sebagai: <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-400 text-sm hover:underline">Logout</button>
            </form>
        @else
            <a href="/login" class="text-blue-400 hover:underline">Login</a>
        @endauth
    </div>

    <!-- FORM TAMBAH TASK -->
    @auth
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-6 flex gap-2">
        @csrf
        <input type="text" name="title" placeholder="Tambah tugas..."
            class="w-full px-4 py-2 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        <button class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
            Tambah
        </button>
    </form>
    @endauth

    <!-- LIST TASK -->
    <div class="bg-gray-800 rounded p-4 shadow">

        <h2 class="text-lg font-semibold mb-4">Daftar Tugas</h2>

        <ul class="space-y-3">
            @forelse($tasks as $task)
                <li class="flex justify-between items-center bg-gray-700 px-4 py-2 rounded">

                    <span>{{ $task->title }}</span>

                    <!-- DELETE BUTTON (ADMIN ONLY) -->
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 text-sm">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    @endauth

                </li>
            @empty
                <li class="text-gray-400">Belum ada tugas</li>
            @endforelse
        </ul>
    </div>

</div>

</body>
</html>