@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>{{ $employee->fullname }}</h1></div>
                <div class="col-4 text-right">
                    <button class="btn btn-primary btn-print" type="button">Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="employee_code" class="form-label">Employee ID</label>
                            <div>
                                <input class="form-control" type="text" id="employee_code" readonly value="{{ $employee->employee_code }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="fullname" class="form-label">Name</label>
                            <div>
                                <input class="form-control" type="text" id="fullname" readonly value="{{ $employee->fullname }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="fathername" class="form-label">Father Name</label>
                            <div>
                                <input class="form-control" type="text" id="fathername" readonly value="{{ $employee->fathername }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cnic" class="form-label">CNIC</label>
                            <div>
                                <input class="form-control" type="text" id="cnic" readonly value="{{ $employee->cnic }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="mobile_number" class="form-label">Mobile No.</label>
                            <div>
                                <input class="form-control" type="text" id="mobile_number" readonly value="{{ $employee->mobile_number }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <h2>Pending Cases</h2>
                @if($enquiries->where('is_finalized',0)->count() == 0)
                    <b>No pending cases</b>
                @else
                <table class="table table-hover data-table">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Enq.#</th>
                        <th>Designation</th>
                        <th>Office</th>
                        <th>Charges</th>
                        <th>Issue Date</th>
                        <th>Competent Authority</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enquiries->where('is_finalized',0) as $pending)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pending->enquiry_no }}</td>
                        <td>{{ optional($pending->designation)->name }}</td>
                        <td>{{ optional($pending->office)->name }}</td>
                        <td>{{ optional($pending->charges)->name }}</td>
                        <td>{{ $pending->issue_date->format('Y-m-d') }}</td>
                        <td>{{ optional($pending->competent_authority)->name }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <h2>Finalized Cases</h2>
                @if($enquiries->where('is_finalized',1)->count() == 0)
                    <b>No finalized cases</b>
                @else
                <table class="table table-hover data-table">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Enquiry No.</th>
                        <th>Designation</th>
                        <th>Office</th>
                        <th>Charges</th>
                        <th>Issue Date</th>
                        <th>Competent Authority</th>
                        <th>Punishment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enquiries->where('is_finalized',1) as $finalized)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $finalized->enquiry_no }}</td>
                            <td>{{ optional($finalized->designation)->name }}</td>
                            <td>{{ optional($finalized->office)->name }}</td>
                            <td>{{ optional($finalized->charges)->name }}</td>
                            <td>{{ $finalized->issue_date->format('Y-m-d') }}</td>
                            <td>{{ optional($finalized->competent_authority)->name }}</td>
                            <td>{{ optional($finalized->punishment)->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="/vendor/printThis/printThis.js"></script>
    <script>
        $(document).ready(() => {
            $(".btn-print").click(()=>{
                $('.card-body').printThis();
            });
        });
    </script>
@endpush