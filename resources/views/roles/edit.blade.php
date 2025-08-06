@extends('admin.app')

@section('content')

<h1>Edit Role</h1>

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                New Question
            </h3>
        </div>

    </div>
    <div class="kt-portlet__body">

        <form action="{{ route('admin.roles.update',$role->id ) }}" method="POST">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $role->name }}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label>Permissions</label> <br>
                <label><input type="checkbox" id="check_all"> All Permissions</label>
                <ul style="column-count: 2" class="list-unstyled">
                    @foreach ($permissions as $item)
                    <li>
                        <label>
                            <input type="checkbox" name="abilities[]" value="{{ $item->id }}"
                                {{ $role->permissions->contains('id', $item->id) ? 'checked' : '' }}>
                            {{ $item->name }}
                        </label>
                    </li>
                    @endforeach
                </ul>

            </div>




            <button class="btn btn-success px-5"><i class="fas fa-save"></i> Update</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#check_all').change(function() {

        $('ul input[type=checkbox]').prop('checked', this.checked)

    })
</script>
@endsection