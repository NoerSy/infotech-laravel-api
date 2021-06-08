@extends('layouts.master')
@section('title', 'Create console')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">console</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('console.index') }}">console</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Data</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('console.store') }}" method="POST">
                    @CSRF
                    <div class="card-body">
                        <div class="column">
                            <div class="form-group">
                                <label for="type">Seri</label>
                                <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" placeholder="Supplier type">
                                <small class="text-danger">@error('type') {{$message}} @enderror</small>
                            </div>
                            <div class="form-group">
                                <label for="merek">Merek</label>
                                <input type="text" name="merek" class="form-control @error('merek') is-invalid @enderror" placeholder="Supplier merek">
                                <small class="text-danger">@error('merek') {{$message}} @enderror</small>
                            </div>
                            <div class="form-group">
                                <label for="isSewa">Status</label>
                                <input type="text" name="isSewa" class="form-control @error('isSewa') is-invalid @enderror" placeholder="Supplier isSewa" value='1'>
                                <small class="text-danger">@error('isSewa') {{$message}} @enderror</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Supplier description">
                                <small class="text-danger">@error('description') {{$message}} @enderror</small>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Supplier image">
                                <small class="text-danger">@error('image') {{$message}} @enderror</small>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('console.index') }}" class="m-1 btn btn-outline-danger">Back</a>
                            <button type="submit" class="m-1 btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection