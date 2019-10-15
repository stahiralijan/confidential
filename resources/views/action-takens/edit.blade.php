@extends('layouts.app')

@section('content')
<div class="col-md-10">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8"><h1>Action Taken</h1></div>
                <div class="col-4 text-right">
                    <a href="{{ action('EnquiryController@show', $enquiry) }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            <form id="employee_form" action="{{ action('ActionTakenController@update', $enquiry) }}" method="post" class="form-horizontal">
                @csrf
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="enquiry_id" value="{{ $enquiry->id }}">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Employee<br>Designation</th>
                        <th>Accusation</th>
                        <th>Charges</th>
                        <th>Penalty</th>
                        <th>Remarks</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enquiry->enquiryDetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($detail->employee)->fullname }}<br>{{ optional(optional($detail->employee)->designation)->name }}<br>(BPS-{{ optional(optional($detail->employee)->designation)->bps }})</td>
                            <td>{!! $detail->accusation !!}</td>
                            <td>
                                <ol>
                                    @foreach($detail->charges as $charge)
                                        <li>{{ $charge->name }}</li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>
                                <div style="width:150px">
                                    <input type="hidden" name="employee_id[]" value="{{ $detail->employee_id }}">
                                    <input type="hidden" name="enquiry_detail_id[]" value="{{ $detail->id }}">
                                    <select style="width:150px" name="penalty_id[]" class="from-control penalties"></select>
                                </div>
                            </td>
                            <td>
                                <div style="width:150px;">
                                    <textarea name="description[]" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="form-group">
                    <label for="status_id" class="control-label">Enquiry Status</label>
                    <div>
                        <select name="status_id" id="status_id" class="form-control">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-submit-employee">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $('.penalties').select2({
                placeholder:'Select a Designation',
                ajax: {
                    url: "{{ action('PenaltyController@index') }}",
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
        });
    </script>
@endpush