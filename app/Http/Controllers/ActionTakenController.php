<?php
	
	namespace App\Http\Controllers;
	
	use App\ActionTaken;
	use App\Enquiry;
	use App\EnquiryDetail;
	use App\Http\Requests\ActionTakenFormRequest;
	use App\Status;
	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	
	class ActionTakenController extends Controller
	{
		public function index()
		{
		
		}
		
		public function create()
		{
		
		}
		
		public function store()
		{
		
		}
		
		public function edit($enquiryId)
		{
			$enquiry = Enquiry::with([
										 'enquiryDetails',
										 'enquiryDetails.charges',
										 'enquiryDetails.employee',
										 'enquiryDetails.employee.designation',
									 ])
							  ->findOrFail($enquiryId);
			
			$statuses = Status::select([
										   'id',
										   'name',
									   ])
							  ->get();
			
			return view('action-takens.edit', compact('enquiry', 'statuses'));
		}
		
		public function update(ActionTakenFormRequest $request, $enquiryId)
		{
			$valid   = $request->validated();
			
			$enquiry = Enquiry::findOrFail($enquiryId);
			$enquiry->status_id = $valid['status_id'];
			$enquiry->save();
			
			for ($i = 0; $i < count($valid['employee_id']); $i++)
			{
				ActionTaken::create([
										'enquiry_id'        => $enquiry->id,
										'enquiry_detail_id' => $valid['enquiry_detail_id'][$i],
										'employee_id'       => $valid['employee_id'][$i],
										'penalty_id'        => $valid['penalty_id'][$i],
										'description'       => $valid['description'][$i],
									]);
			}
			
			return redirect(action('EnquiryController@index'))
				->with('status', 'Enquiry Updated successfully');
		}
		
		public function destroy()
		{
		
		}
	}