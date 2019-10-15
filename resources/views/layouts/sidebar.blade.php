<div class="list-group">
    <span class="list-group-item list-group-item-dark">Tasks</span>
    <a class="list-group-item @highlight_on('cases')" href="{{ action('EnquiryCaseController@index') }}">All Cases</a>
    <a class="list-group-item @highlight_on('finalized-cases')" href="{{ action('FinzalizedCasesController@index') }}">Finalized Cases</a>
    <a class="list-group-item @highlight_on('search-employees')" href="{{ action('EmployeeController@search') }}">Search Employee</a>
    <a class="list-group-item @highlight_on('competent-authority')" href="{{ action('ComptentAuthorityController@index') }}">Competent Authorities</a>
    <a class="list-group-item @highlight_on('punishments')" href="{{ action('PunishmentsController@index') }}">Punishments</a>
    <a class="list-group-item @highlight_on('charges')" href="{{ action('ChargeController@index') }}">Charges</a>
    <a class="list-group-item @highlight_on('offices')" href="{{ action('OfficeController@index') }}">Offices</a>
    {{--<a class="list-group-item @highlight_on('enquiries')" href="{{ action('EnquiryController@index') }}">Enquiries</a>--}}
    {{--<a class="list-group-item @highlight_on('enquiry-statuses')" href="{{ action('StatusController@index') }}">Enquiry Statuses</a>--}}
    <a class="list-group-item @highlight_on('employees')" href="{{ action('EmployeeController@index') }}">Employees</a>
    <a class="list-group-item @highlight_on('designations')" href="{{ action('DesignationController@index') }}">Designations</a>
    {{--<a class="list-group-item @highlight_on('offices')" href="{{ action('OfficeController@index') }}">Offices</a>--}}
    {{--<a class="list-group-item @highlight_on('penalties')" href="{{ action('PenaltyController@index') }}">Penalties</a>--}}
    {{--<a class="list-group-item @highlight_on('charges')" href="{{ action('ChargeController@index') }}">Charges</a>--}}
    {{--<a class="list-group-item @highlight_on('penalty-types')" href="{{ action('PenaltyTypeController@index') }}">Penalty Types</a>--}}
    {{--<span class="list-group-item list-group-item-dark">Reports</span>--}}
    {{--<a class="list-group-item" href="#">Enquiries</a>--}}
</div>