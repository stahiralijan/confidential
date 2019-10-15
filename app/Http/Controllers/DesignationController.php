<?php
	
	namespace App\Http\Controllers;
	
	use App\Designation;
	use App\Http\Requests\DesignationFormRequest;
	
	class DesignationController extends Controller
	{
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return Designation::select(['id','name',])
									->where(function($q)
									{
										if(\request('q'))
										{
											$q->where('name', 'like', "%" . request('q') . "%");
										}
									})
								  ->limit(15)->latest()->get()->toJson();
			}
			$designations = Designation::latest()->paginate();
			
			return view('designations.index', compact('designations'));
		}
		
		public function create()
		{
			return view('designations.create');
		}
		
		public function store(DesignationFormRequest $request)
		{
			$validatedDesignation = $request->validated();
			
			Designation::create($validatedDesignation);
			
			return redirect(action('DesignationController@index'))->with('status', 'Designation created successfully');
		}
		
		public function edit($id)
		{
			$designation = Designation::findOrFail($id);
			
			return view('designations.edit', compact('designation'));
		}
		
		public function update(DesignationFormRequest $request, $id)
		{
			$designation = Designation::findOrFail($id);
			
			$designation->update($request->validated());
			
			return redirect(action('DesignationController@index'))->with('status', 'Designation updated successfully');
		}
		
		public function destroy($id)
		{
			$designation = Designation::withCount('employees')
									  ->findOrFail($id);
			try
			{
				if ($designation->employees_count == 0)
				{
					return response()->json(['success' => $designation->delete() === TRUE]);
				}
				return response()->json([
											'success' => FALSE,
											'reason'  => 'This designation is associated with employees, therefore, it can not be deleted.',
										]);
			}
			catch (\Exception $e)
			{
				\Log::info($e->getMessage());
			}
		}
	}