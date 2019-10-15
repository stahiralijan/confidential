@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Employees</h1></div>
                    <div class="col-4 text-right"><a href="{{ action('EmployeeController@create') }}" class="btn btn-primary">Create Employee</a></div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sr</th>
                    <th>CNIC</th>
                    <th>Name</th>
                    <th>F/Name</th>
                    <th>Mobile #</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ ($employees->currentpage() - 1) * $employees->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $employee->cnic }}</td>
                        <td>{{ $employee->fullname }}</td>
                        <td>{{ $employee->fathername }}</td>
                        <td>{{ $employee->mobile_number }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="actions">
                                    <a href="{{ action('EmployeeController@show', $employee) }}" class="dropdown-item">View</a>
                                    <a href="{{ action('EmployeeController@edit', $employee) }}" class="dropdown-item">Edit</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $employees->links() }}</div>
        </div>
    </div>
@endsection