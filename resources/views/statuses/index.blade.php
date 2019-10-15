@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Enquiry Status</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('StatusController@create') }}" class="btn btn-primary">Create Enquiry-Status</a>
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
                    <th>Status Name</th>
                    <th>Status Descriptions</th>
                    <th>Enquiries</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($statuses as $status)
                    <tr>
                        <td>{{ ($statuses->currentpage() - 1) * $statuses ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->description }}</td>
                        <td>{{ $status->enquiries_count }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a href="{{ action('StatusController@edit', $status) }}" class="dropdown-item">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $statuses->links() }}</div>
        </div>
    </div>
@endsection