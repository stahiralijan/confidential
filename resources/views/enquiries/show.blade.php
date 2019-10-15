@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8"><h1>Enquiry Details</h1></div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryController@index') }}" class="btn btn-primary">Back</a>
                        <a href="{{ action('ActionTakenController@edit', $enquiry) }}" class="btn btn-primary">Action Taken</a>
                        <a href="{{ action('EnquiryController@edit', $enquiry) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif

                <table class="table table-hover">
                    <tr>
                        <th class="text-right">Enquiry Number:</th>
                        <td>{{ $enquiry->enq_number }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Enquiry Status:</th>
                        <td>{{ optional($enquiry->status)->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Case Opening Date:</th>
                        <td>{{ optional($enquiry)->opening_date->format('d/m/Y') }}</td>
                    </tr>
                    @if(!empty($enquiry->closing_date))
                    <tr>
                        <th class="text-right">Case Closing Date:</th>
                        <td>{{ optional($enquiry->closing_date)->format('d/m/Y') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th class="text-right">Accused:</th>
                        <td>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Employee</th>
                                    <th>Accusations</th>
                                    <th>Charges</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enquiry->enquiryDetails as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ optional($detail->employee)->fullname }}</td>
                                        <td>{!! $detail->accusation !!}</td>
                                        <td>
                                            <ol>
                                                @foreach($detail->charges as $charge)
                                                    <li>{{ $charge->name }}</li>
                                                @endforeach
                                            </ol>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Enquiry Committee:</th>
                        <td>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Member</th>
                                    <th>Designation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enquiry->enquiryCommittees as $committee)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ optional($committee->employee)->fullname }}</td>
                                        <td>{{ optional(optional($committee->employee)->designation)->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Action Taken:</th>
                        <td>
                            @if($enquiry->actionTakens->count() == 0)
                                <p>No action taken yet</p>
                            @else
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Employee</th>
                                    <th>Designation</th>
                                    <th>Penalty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($enquiry->actionTakens as $actionTaken)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ optional($actionTaken->employee)->fullname }}</td>
                                        <td>{{ optional(optional($actionTaken->employee)->designation)->name }}</td>
                                        <td>{{ optional($actionTaken->penalty)->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </td>
                    </tr>
                </table>
                    <hr>
                <div class="form-group">
                    <a href="{{ action('ActionTakenController@edit', $enquiry) }}" class="btn btn-primary">Action Taken</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-employee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="office_form" class="form-horizontal modal-form needs-validation">
                        @csrf
                        <div class="form-group">
                            <label for="fullname" class="control-label">Employee Name:</label>
                            <div>
                                <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" id="fullname" placeholder="Employee Name..." required autofocus autocomplete="off" value="{{ old('fullname') }}">
                                @error('fullname')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cnic" class="control-label">CNIC:</label>
                            <div>
                                <input class="form-control @error('cnic') is-invalid @enderror" type="text" name="cnic" id="cnic" placeholder="Employee Name..." required maxlength="13" minlength="13" autocomplete="off" value="{{ old('cnic') }}">
                                @error('cnic')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="code" class="control-label">Employee Code:</label>
                            <div>
                                <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" id="code" placeholder="Employee Name..." required  autocomplete="off" value="{{ old('code') }}">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile_number" class="control-label">Mobile Number:</label>
                            <div>
                                <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number" id="mobile_number" placeholder="Employee Name..." required minlength="10" maxlength="13" autocomplete="off" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bps" class="control-label">Basic Pay Scale (BPS):</label>
                            <div>
                                <input class="form-control @error('bps') is-invalid @enderror" type="number" name="bps" id="bps" placeholder="Basic Pay Scale (BPS)..." maxlength="2" minlength="1" max="20" min="5" required autocomplete="off" value="{{ old('bps') }}">
                                @error('bps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="office_id" class="control-label">Office:</label>
                            <div>
                                <select class="form-control @error('office_id') is-invalid @enderror" name="office_id" id="office_id" required></select>
                                @error('office_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="designation_id" class="control-label">Designation:</label>
                            <div>
                                <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" id="designation_id" required></select>
                                @error('designation_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-office">Create Employee</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {
        let accused = 1;
        let committee = 1;

        $('#case_closed').change(function() {
            if(!$('#case_closed').prop('checked')) {
                $('#closing_date').prop({'disabled': true}).val('');
            } else {
                $('#closing_date').prop({'disabled': false});
            }
        });

        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
        });

        $('#status_id').select2({
            placeholder:'Select a status',
            ajax: {
                url: "{{ action('StatusController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        });

        function init_employee_select() {
            $('.employee').select2({
                placeholder: 'Select an Employee',
                minimumInputLength: 3,
                ajax: {
                    url: "{{ action('EmployeeController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {
                                return {id: item.id, text: `Name: ${item.fullname} | CNIC: ${item.cnic}`}
                            })
                        };
                    }
                }
            });
        }

        init_employee_select();

        function init_committee_select() {
            $('.committee-member').select2({
                placeholder: 'Select an Enquiry Committee Member',
                minimumInputLength: 3,
                ajax: {
                    url: "{{ action('EmployeeController@index') }}",
                    cache: false,
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data.map(item => {
                                return {id: item.id, text: `Name: ${item.fullname} | CNIC: ${item.cnic}`}
                            })
                        };
                    }
                }
            });
        }

        init_committee_select();

        $(".btn-add-accused").click(()=>{
            accused++;
            let employee = `<div><div class="form-group">
                    <label for="employee_id_${accused}" class="control-label">Accused: <button title="Remove" type="button" class="btn btn-danger btn-sm btn-remove">&times;</button></label>
                    <div><select class="form-control employee" name="employee_id[]" id="employee_id_${accused}" required></select></div></div><div class="form-group">
                            <label for="charges_${accused}" class="control-label">Charges:</label>
                            <div>
                                <textarea name="charges[]" id="charges_${accused}" class="form-control"></textarea>
                            </div>
                        </div></div>`;
            $(".employees-container").append(employee);
            init_employee_select();
        });

        $(".btn-add-committee-member").click(()=>{
            accused++;
            let employee = `<div class="form-group">
                    <label for="committee_member_${accused}" class="control-label">Member: <button title="Remove" type="button" class="btn btn-danger btn-sm btn-remove">&times;</button></label>
                    <div><select class="form-control committee-member" name="committee_member_id[]" id="committee_member_${accused}" required></select></div></div>`;
            $(".committee-container").append(employee);
            init_committee_select();
        });

        $(document).on('click',".btn-remove", (evt)=>{
            let elem = $(evt.currentTarget).parent().parent().parent();
            elem.fadeOut('slow',()=>{elem.remove()})
        });

        $('#designation_id').select2({
            placeholder:'Select a Designation',
            ajax: {
                url: "{{ action('DesignationController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        });

        $('#office_id').select2({
            placeholder:'Select an Office',
            ajax: {
                url: "{{ action('OfficeController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        });
0    });
</script>
@endpush