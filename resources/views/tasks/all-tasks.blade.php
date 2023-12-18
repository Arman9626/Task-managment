@extends('layouts.main')
@section('title', 'Task Page')
@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title">
                            <div class="d-flex align-items-center">
                                <h2 class="mb-0">All Companies</h2>
                                @if(auth()->user()->role == "manager")
                                <div class="ml-auto">
                                    <a href="{{ route('tasks.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New Task</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2"
                                                           value="{{ request()->query('search') }}"
                                                           id="search-input"
                                                    >
                                                    <div class="input-group-append">
                                                        @if(request()->filled('search') || request()->filled('id'))
                                                            <button class="btn btn-outline-secondary" type="submit" onclick="document.getElementById('search-input').value='',
                                                document.getElementById('search-select').selectedIndex = 0, this.form.submit()
                                                ">
                                                                <i class="fa fa-refresh"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if($message = session('message'))
                                <div class="alert alert-success">{{ $message }}</div>
                            @endif
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created by</th>
                                    <th scope="col">Developer</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $key => $task)
                                    <tr>
                                        <th scope="row">{{$tasks->firstItem() + $key}}</th>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->createdByUser->name}}</td>
                                        <td>{{$task->assignedToUser->name}}</td>
                                        <td>{{ $task->description }}</td>
                                        @if(auth()->user()->role === "manager")
                                            <td>{{ $task->status }}</td>
                                        @else
                                            <td>
                                                @if(auth()->id() == $task->assignedToUser->id)
                                            <select  class="custom-select"  name="status" id="status">
                                                <option value="" selected>Status</option>
                                                <option value="assigned" >assigned</option>
                                                <option value="in-progress" >in-progress</option>
                                                <option value="done" >done</option>
                                            </select>
                                                    @endif
                                            </td>
                                        @endif
                                        <td width="150">
                                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
                                            @if(auth()->id() == $task->createdByUser->id)
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit=" return confirm('Are you sure?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-circle btn-outline-danger" title="Delete" ><i class="fa fa-times"></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{$tasks->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
