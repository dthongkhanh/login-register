@extends('layouts.app')
@section('title', 'Update')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <a href="/task/list">Back Todo List</a>
    </div>
    <div class="card-body">
        <h4 class="mb-4 font-weight-bold text-primary">Update</h4>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $task->name }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Time due<span class="text-danger">*</span></label>
                <input type="datetime-local" name="time_due" class="form-control" value="{{ $task->time_due }}" min="{{ now()->format('Y-m-d\H:i') }}">
                @error('time_due')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Note</label>
                <input type="text" name="note" class="form-control" placeholder="Enter note" value="{{ $task->note }}">
                @error('note')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{ $task->description }}">
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Status<span class="text-danger">*</span></label>
                <select class="form-control" name="status">
                    @foreach(App\Enums\Status::map() as $key => $value)
                    @if($key !== App\Enums\Status::PAST_DUE)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div style="border-top: 1px solid rgba(0, 0, 0);">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
            @csrf
        </form>
    </div>
</div>
@endsection