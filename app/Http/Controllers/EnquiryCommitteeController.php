<?php
	
	namespace App\Http\Controllers;
	
	use App\EnquiryCommittee;
	use App\Http\Requests\EnquiryCommitteeFormRequest;
	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	
	class EnquiryCommitteeController extends Controller
	{
		public function index()
		{
		
		}
		
		public function create()
		{
		
		}
		
		public function store(EnquiryCommitteeFormRequest $request)
		{
			$valid = $request->validated();
		}
		
		public function edit($id)
		{
			$enquiryCommittee = EnquiryCommittee::findOrFail($id);
		}
		
		public function update(EnquiryCommitteeFormRequest $request, $id)
		{
			$valid = $request->validated();
			$enquiryCommittee = EnquiryCommittee::findOrFail($id);
		}
		
		public function destroy($id)
		{
			$enquiryCommittee = EnquiryCommittee::findOrFail($id);
		}
	}