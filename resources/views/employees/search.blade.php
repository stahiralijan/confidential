@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Search</h1></div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
                <form action="{{ action('EmployeeController@search') }}" method="get" class="form-horizontal">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="employee_id" class="form-label">Employee</label>
                                <select name="employee_id" id="employee_id" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <br>
                                <button class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('#employee_id').select2({
                placeholder:'Select Employee',
                ajax: {
                    url: "{{ action('EmployeeController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {

                                let name = item.fullname || '';
                                let fathername = item.fathername || '';
                                let cnic = item.cnic || "";

                                return {id: item.id, text: "Name: " + name + ", Father Name: " + fathername + ", CNIC: " + cnic}
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush