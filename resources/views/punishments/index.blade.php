@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Punishments</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('PunishmentsController@create') }}" class="btn btn-primary">Create Punishment</a>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sr</th>
                    <th>Punishment in Brief</th>
                    <th>Punishment in detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($punishments as $punishment)
                    <tr>
                        <td>{{ ($punishments->currentpage() - 1) * $punishments ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $punishment->name }}</td>
                        <td>{{ $punishment->punishment_detail }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $punishments->links() }}</div>
        </div>
    </div>
@endsection
