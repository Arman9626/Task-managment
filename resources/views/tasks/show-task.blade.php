@extends('layouts.main')
@section('title', 'Show task page')
@section('content')
    <!-- content -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Task Details</strong>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="first_name" class="col-md-3 col-form-label">Name</label>

                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{ $task->name }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="created_by" class="col-md-3 col-form-label">Created by</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{ $task->createdByUser->name }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="assigned_to" class="col-md-3 col-form-label">Developer</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{ $task->assignedToUser->name }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-3 col-form-label">Description</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{ $task->description}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-9 offset-md-3">
                                            <a href="{{ route('tasks.edit',  $task->id) }}" class="btn btn-info">Edit</a>
                                            <a href="#" class="btn btn-outline-danger">Delete</a>
                                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
