@extends('admin.app')

@section('content')

<h1>Add New Project</h1>

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                New Project
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">

        <form action="{{ route('admin.projects.store' ) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 dropzone" id="dropimage">
                <label>Image</label>
                
                <input type="file" name="image" class="form-control" />
            </div>

            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror">
                @error('description')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label>Price</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror">
                @error('duration')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>


            <button class="btn btn-success px-5"><i class="fas fa-save"></i> Store</button>
        </form>
    </div>
</div>
@endsection

@section('js')

@endsection