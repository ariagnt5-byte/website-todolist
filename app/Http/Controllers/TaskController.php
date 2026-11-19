<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Menampilkan semua tugas
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    // Menambahkan tugas
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255'
    ]);

    Task::create([
        'title' => $request->title
    ]);

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Yeay, Tugas Berhasil Ditambahkan!');
}

    // Mengubah status tugas
    public function update(Task $task)
{
    $task->update([
        'is_completed' => !$task->is_completed
    ]);

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Status tugas berhasil diperbarui!');
}

    // Menghapus tugas
    public function destroy(Task $task){
    $task->delete();

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Tugas berhasil dihapus!');}
}