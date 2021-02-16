@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Create Punishment</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('PunishmentsController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form action="{{ action('PunishmentsController@store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">Punishment in brief:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Punishment in brief..." required autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="punishment_detail" class="control-label">Punishment in detail:</label>
                    <div>
                        <textarea class="form-control @error('punishment_detail') is-invalid @enderror" name="punishment_detail" id="punishment_detail">{{ old('punishment_detail') }}</textarea>
                        @error('punishment_detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection