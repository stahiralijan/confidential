<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\OfficeFormRequest;
	use App\Office;
	
	class OfficeController extends Controller
	{
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return Office::select(['id','name',])
					
					->where(function($q)
					{
						if(\request('q'))
						{
							$q->where('name', 'like', "%" . request('q') . "%");
						}
					})
							 ->limit(15)->latest()->get()->toJson();
			}
			
			$offices = Office::withCount('employees')
							 ->latest()->paginate();
			
			return view('offices.index', compact('offices'));
		}
		
		public function create()
		{
			return view('offices.create');
		}
		
		public function store(OfficeFormRequest $request)
		{
			$valid = $request->validated();
			
			Office::create($valid);
			
			return redirect(action('OfficeController@index'))->with('status', 'Office Created Successfully');
		}
		
		public function edit($id)
		{
			$office = Office::findOrFail($id);
			
			return view('offices.edit', compact('office'));
		}
		
		public function update(OfficeFormRequest $request, $id)
		{
			$valid = $request->validated();
			
			$office = Office::findOrFail($id);
			
			$office->update($valid);
			
			return redirect(action('OfficeController@index'))->with('status', 'Office Updated Successfully');
		}
		
		public function destroy($id)
		{
			$office = Office::withCount('employees')
							->findOrFail($id);
			if ($office->employees_count == 0)
			{
				try
				{
					return response()->json(['success' => $office->delete() === TRUE]);
				}
				catch (\Exception $e)
				{
					\Log::info($e->getMessage());
				}
			}
			return response()->json([
										'success' => FALSE,
										'reason'  => 'This office can not be deleted because it is associated with Employees.',
									]);
		}
	}