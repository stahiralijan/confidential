@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Edit Designation</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('DesignationController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ action('DesignationController@update', $designation) }}" method="post" class="form-horizontal">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="designation_id" value="{{ $designation->id }}">
                <div class="form-group">
                    <label for="name" class="control-label">Designation Name:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Designation Name..." required autocomplete="off" value="{{ old('name', optional($designation)->name) }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="bps" class="control-label">Basic Pay Scale (BPS):</label>
                    <div>
                        <input class="form-control @error('bps') is-invalid @enderror" type="number" name="bps" id="bps" placeholder="Basic Pay Scale (BPS)..." maxlength="2" minlength="1" max="20" min="5" required autocomplete="off" value="{{ old('bps', $designation->bps) }}">
                        @error('bps')
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