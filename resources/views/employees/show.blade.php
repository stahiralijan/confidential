@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>{{ $employee->fullname }}</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('EmployeeController@index') }}" class="btn btn-primary">Back</a>
                    <a href="{{ action('EmployeeController@edit', $employee) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <table class="table table-hover">
                <tr>
                    <th class="text-right">Employee Name:</th>
                    <td>{{ $employee->fullname }}</td>
                </tr>
                <tr>
                    <th class="text-right">Designation:</th>
                    <td>{{ optional($employee->designation)->name }}</td>
                </tr>
                <tr>
                    <th class="text-right">Basic Pay Scale:</th>
                    <td>{{ optional($employee->designation)->bps }}</td>
                </tr>
                <tr>
                    <th class="text-right">CNIC:</th>
                    <td>{{ $employee->cnic }}</td>
                </tr>
                <tr>
                    <th class="text-right">Mobile Number:</th>
                    <td>{{ $employee->mobile_number }}</td>
                </tr>
                <tr>
                    <th class="text-right">Employee Code:</th>
                    <td>{{ $employee->code }}</td>
                </tr>
                <tr>
                    <th class="text-right">Current Office:</th>
                    <td>{{ optional($employee->office)->name }}</td>
                </tr>
            </table>

        </div>
    </div>
</div>
@endsection