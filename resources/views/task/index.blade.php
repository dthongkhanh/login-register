@extends('layouts.app')
@section('title', 'Todo List')
@section('content')
<a href="/task/create" class="btn btn-success mb-3">Add task</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Todo List</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <form action="{{ route('tasks.sort_by_time_due') }}" method="GET" class="d-flex">
                    <select class="form-control mr-2" name="direction">
                        <option value="asc">Time due increase</option>
                        <option value="desc">Time due decrease</option>
                    </select>
                    <button type="submit" class="btn btn-primary mb-3">Sort</button>
                </form>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('tasks.search') }}" method="GET" class="d-flex">
                    <input type="text" class="form-control mr-2" placeholder="Enter keywords" name="text_search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('tasks.filter_by_status') }}" method="GET" class="d-flex">
                    @csrf
                    <select class="form-control mr-2" name="status">
                        @foreach(App\Enums\Status::map() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="taskTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Time due</th>
                        <th>Note</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->time_due }}</td>
                        <td>{{ $task->note }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ \App\Enums\Status::map()[$task->status] }}</td>
                        <td>
                            <a href="/task/update/{{ $task->id }}" class="btn btn-warning">Edit</a>
                            <form id="delete-form" action="/task/delete/{{ $task->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-delete btn-danger" onclick="confirmDelete()">Delete</button>
                            </form>
                            <script>
                                function confirmDelete() {
                                    if (confirm('Are you sure delete this task??')) {
                                        document.getElementById('delete-form').submit();
                                    }
                                }
                            </script>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection