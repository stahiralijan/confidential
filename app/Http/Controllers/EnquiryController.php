<?php
	
	namespace App\Http\Controllers;
	
	use App\Enquiry;
	use App\EnquiryCommittee;
	use App\EnquiryDetail;
	use App\EnquirydetailCharge;
	use App\Http\Requests\EnquiryFormRequest;
	
	class EnquiryController extends Controller
	{
		public function index()
		{
			$enquiries = Enquiry::with('status')
								->latest('opening_date')
								->paginate();
			
			return view('enquiries.index', compact('enquiries'));
		}
		
		public function create()
		{
			return view('enquiries.create');
		}
		
		public function store(EnquiryFormRequest $request)
		{
			$valid = $request->validated();
			
			//			dd(array_keys($valid['charges']));
			//			dd($valid['charges'][1][0]);
			
			$enquiry               = new Enquiry();
			$enquiry->enq_number   = $valid['enq_number'];
			$enquiry->status_id    = $valid['status_id'];
			$enquiry->opening_date = $valid['opening_date'];
			if (array_key_exists('closing_date', $valid))
			{
				$enquiry->closing_date = $valid['closing_date'];
			}
			$enquiry->save();
			
			$keys = array_keys($valid['employee_id']);
			
			foreach ($keys as $key)
			{
				$ed = EnquiryDetail::create([
												'employee_id' => $valid['employee_id'][$key],
												'accusation'  => $valid['accusation'][$key],
												'enquiry_id'  => $enquiry->id,
											]);
				
				for ($j = 0; $j < count($valid['charges'][$key]); $j++)
				{
					EnquirydetailCharge::create([
													'enquiry_detail_id' => $ed->id,
													'charge_id'         => $valid['charges'][$key][$j],
												]);
				}
			}
			
			for ($i = 0; $i < count($valid['committee_member_id']); $i++)
			{
				EnquiryCommittee::create([
											 'committee_member_id' => $valid['committee_member_id'][$i],
											 'employee_id'         => $valid['committee_member_id'][$i],
											 'enquiry_id'          => $enquiry->id,
										 ]);
			}
			return redirect(action('EnquiryController@index'))->with('status', 'Enquiry Initiated successfully');
		}
		
		public function show($id)
		{
			$enquiry = Enquiry::with([
										 'enquiryDetails',
										 'enquiryDetails.charges',
										 'enquiryDetails.employee',
										 'enquiryDetails.employee.designation',
										 'enquiryCommittees',
										 'enquiryCommittees.employee',
										 'enquiryCommittees.employee.designation',
										 'actionTakens',
										 'actionTakens.employee',
										 'actionTakens.employee.designation',
										 'actionTakens.penalty',
										 'status',
									 ])
							  ->findOrFail($id);
			//			dd($enquiry);
			
			return view('enquiries.show', compact('enquiry'));
		}
		
		public function edit($id)
		{
			$enquiry = Enquiry::with(['enquiryDetails'])
							  ->findOrFail($id);
		}
		
		public function update(EnquiryFormRequest $request, $id)
		{
			$valid   = $request->validated();
			$enquiry = Enquiry::findOrFail($id);
		}
		
		public function destroy($id)
		{
			$enquiry = Enquiry::findOrFail($id);
		}
	}