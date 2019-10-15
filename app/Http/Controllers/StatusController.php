<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\StatusFormRequest;
	use App\Status;
	
	class StatusController extends Controller
	{
		public function index()
		{
			if(request()->ajax() && request('_type') == 'query')
			{
				return Status::select(['id','name'])
						->where('name', 'like', "%".request('q')."%")
						->limit(15)->latest()->get()->toJson();
			}
			
			$statuses = Status::withCount('enquiries')->paginate();
			
			return view('statuses.index', compact('statuses'));
		}
		
		public function create()
		{
			return view('statuses.create');
		}
		
		public function store(StatusFormRequest $request)
		{
			$valid = $request->validated();
			
			Status::create($valid);
			
			return redirect(action('StatusController@index'))
				->with('status','Enquiry-status created successfully');
		}
		
		public function edit($id)
		{
			$status = Status::findOrFail($id);
			
			return view('statuses.edit', compact('status'));
		}
		
		public function update(StatusFormRequest $request, $id)
		{
			$valid = $request->validated();
			
			$status = Status::findOrFail($id);
			$status->save($valid);
			
			return redirect(action('StatusController@index'))
				->with('status','Enquiry-status updated successfully');
		}
		
		public function destroy($id)
		{
		
		}
	}