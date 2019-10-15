@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Create Office</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('OfficeController@index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form action="{{ action('OfficeController@store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label">Office Name:</label>
                    <div>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Office Name..." required autofocus autocomplete="off" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="code" class="control-label">Office Code:</label>
                    <div>
                        <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" placeholder="Office Code..." required autocomplete="off" value="{{ old('code') }}">
                        @error('code')
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