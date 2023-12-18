@extends('layouts.main')
@section('title', 'Create task page')
@section('content')
    <!-- content -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Add New Task</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-3 col-form-label">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                                       value="{{ old('name') }}">
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="developer" class="col-md-3 col-form-label">Developer</label>
                                            <div class="col-md-9">

                                                <select  class="custom-select"  name="assigned_to" id="assigned_to">
                                                    <option value="" selected>All Developers</option>
                                                @foreach($developers as $key => $developer)
                                                        <option value="{{$developer->id}}" >{{$developer->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-md-3 col-form-label">Description</label>
                                            <div class="col-md-9">
                                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                       value="{{ old('description') }}">
                                                @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-9 offset-md-3">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
