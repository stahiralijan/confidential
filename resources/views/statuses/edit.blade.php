@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h1>Edit Enquiry-status</h1>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form action="{{ action('StatusController@update', $status) }}" method="post" class="form-horizontal">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="status_id" value="{{ $status->id }}">
                <div class="form-group">
                    <label for="name" class="control-label">Status Name:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Status Name..." required autofocus autocomplete="off" value="{{ old('name', optional($status)->name) }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">Description:</label>
                    <div>
                        <textarea placeholder="Status Description..." class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description', optional($status)->description) }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection