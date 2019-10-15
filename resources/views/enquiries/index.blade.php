@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Enquiries</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryController@create') }}" class="btn btn-primary">Initiate Enquiry</a>
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
                    <th>Enquiry No</th>
                    <th>Opening Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($enquiries as $enquiry)
                    <tr>
                        <td>{{ ($enquiries->currentpage() - 1) * $enquiries ->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $enquiry->enq_number }}</td>
                        <td>{{ $enquiry->opening_date->format('d/m/Y') }}</td>
                        <td>{{ optional($enquiry->status)->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a href="{{ action('EnquiryController@show', $enquiry) }}" class="dropdown-item">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Committee</a>
                                    <a href="#" class="dropdown-item">Accused</a>
                                    <a href="{{ action('ActionTakenController@edit', $enquiry) }}" class="dropdown-item">Action Taken</a>
                                    <a href="#" class="dropdown-item">Completed</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $enquiries->links() }}
            </div>
        </div>
    </div>
@endsection