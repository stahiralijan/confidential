@extends('layouts.app')

@section('content')
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h1>Finalized Cases</h1>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="starting_date" class="control-label">Starting Date:</label>
                                    <div>
                                        <input class="form-control" type="text" data-toggle="datepicker" name="starting_date" id="starting_date" autocomplete="off" placeholder="Starting Date..." value="{{ old('starting_date') }}">
                                        @error('starting_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ending_date" class="control-label">Ending Date:</label>
                                    <div>
                                        <input class="form-control" type="text" data-toggle="datepicker" name="ending_date" id="ending_date" autocomplete="off" placeholder="Ending Date..." value="{{ old('ending_date') }}">
                                        @error('ending_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success btn-filter" type="button">Filter</button>
                                    <button class="btn btn-sm btn-danger btn-clear" type="button">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ action('EnquiryCaseController@create') }}" class="btn btn-primary">Create Case</a>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <table class="table table-hover data-table">
                <thead>
                <tr>
                    <th>Enquiry No.</th>
                    <th>Name</th>
                    <th width="120px" style="padding:0">
                        <div class="input-group">
                            <select class="form-control" name="designation_id" id="designation_id"></select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger btn-xs btn-clear">&times;</button>
                            </div>
                        </div>
                    </th>
                    <th width="100px" style="padding:0">
                        <div class="input-group">
                            <select class="form-control" name="charges_id" id="charges_id"></select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger btn-xs btn-clear">&times;</button>
                            </div>
                        </div>
                    </th>
                    <th>Issue Date</th>
                    <th>Competent Authority</th>
                    <th width="180px" style="padding:0">
                        <div class="input-group">
                            <select class="form-control" name="punishment_id" id="punishment_id"></select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger btn-xs btn-clear">&times;</button>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(() => {

        let designation_id = '';
        let office_id = '';
        let charges_id = '';
        let punishment_id = '';
        let startingDate = '';
        let endingDate = '';

        fetch_data();

        function fetch_data() {
            $('.data-table').DataTable({
                "dom": '<"top"Bif>rt<"bottom"lp><"clear">',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                "searching": true,
                "pageLength": 50,
                processing:true,
                serverSide: true,
                "lengthMenu": [[10, 25, 50, 150, -1], [10, 25, 50, 150, "All"]],
                ajax: {
                    url: "{{ action('FinzalizedCasesController@index') }}",
                    data: {
                        designation_id: designation_id,
                        charges_id: charges_id,
                        punishment_id: punishment_id,
                        starting_date: startingDate,
                        ending_date: endingDate
                    },
                },
                columns: [
                    {data: 'enquiry_no', name: 'enquiry_no'},
                    {data: 'employee.fullname', name: 'employee.fullname'},
                    {data: 'designation.name', name: 'designation.name', orderable: false},
                    {data: 'charges.name', name: 'charges.name', orderable: false},
                    {data: 'issue_date', name: 'issue_date', orderable: true},
                    {data: 'competent_authority.name', name: 'competent_authority.name', orderable: false},
                    {data: 'punishment.name', name: 'punishment.name', orderable: false}
                ]
            });
        }

        $(".btn-clear").click(() => {
            designation_id = '';
            office_id = '';
            charges_id = '';
            punishment_id = '';
            startingDate = '';
            endingDate = '';
            $("#starting_date").val("");
            $("#ending_date").val("");
            $("#punishment_id").val("");
            $('.data-table').DataTable().destroy();
            $("select").val('');
            fetch_data();
        });

        $(".btn-filter").click((e)=>{
            startingDate = $("#starting_date").val();
            endingDate = $("#ending_date").val();
            console.log(startingDate, endingDate);
            $('.data-table').DataTable().destroy();
            fetch_data();
        });

        $('#office_id').select2({
            placeholder:'Office',
            dropdownCssClass : 'bigdrop',
            ajax: {
                url: "{{ action('OfficeController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: data => {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        }).on("select2:select", e => { office_id = e.params.data.id; $('.data-table').DataTable().destroy(); fetch_data(); });

        $('#punishment_id').select2({
            placeholder:'Punishment',
            dropdownCssClass : 'bigdrop',
            ajax: {
                url: "{{ action('PunishmentsController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: data => {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        }).on("select2:select", e => { punishment_id = e.params.data.id; $('.data-table').DataTable().destroy(); fetch_data(); });

        $('#charges_id').select2({
            placeholder:'Charges',
            dropdownCssClass : 'bigdrop',
            ajax: {
                url: "{{ action('ChargeController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: data => {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        }).on("select2:select", e => { charges_id = e.params.data.id; $('.data-table').DataTable().destroy(); fetch_data(); });

        $('#designation_id').select2({
            placeholder:'Designation',
            dropdownCssClass : 'bigdrop',
            ajax: {
                url: "{{ action('DesignationController@index') }}",
                cache: false,
                dataType: 'json',
                processResults: data => {
                    return {
                        results: data.map(item => {
                            return {id: item.id, text: item.name}
                        })
                    };
                }
            }
        }).on("select2:select", e => { designation_id = e.params.data.id; $('.data-table').DataTable().destroy(); fetch_data(); });

        $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            format: 'yyyy-mm-dd',
            endDate: new Date()
        });
    });
</script>
@endpush