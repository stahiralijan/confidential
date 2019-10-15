<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\PenaltyFormRequest;
	use App\Jobs\Penalties\CreatePenaltyJob;
	use App\Penalty;
	
	class PenaltyController extends Controller
	{
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return Penalty::select(['id','name',])
							  ->where('name', 'like', "%" . request('q') . "%")
							  ->limit(15)->latest()->get()->toJson();
			}
			$penalties = Penalty::with('penaltyType')
								->paginate();
			
			return view('penalties.index', compact('penalties'));
		}
		
		public function create()
		{
			return view('penalties.create');
		}
		
		public function store(PenaltyFormRequest $request)
		{
			$validatedArray = $request->validated();
			
			Penalty::create($validatedArray);
			
			return redirect(action('PenaltyController@index'))->with('status', 'Penalty created successfully');
		}
		
		public function edit($id)
		{
			$penalty = Penalty::findOrFail($id);
			
			return view('penalties.edit', compact('penalty'));
		}
		
		public function update(PenaltyFormRequest $request, $id)
		{
			$validPenalty = $request->validated();
			$penalty      = Penalty::findOrFail($id);
			
			$penalty->update($validPenalty);
			
			return redirect(action('PenaltyController@index'))->with('status', 'Penalty updated successfully');
		}
		
		public function destroy($id)
		{
			$penalty = Penalty::withCount('actionTakens')
							  ->findOrFail($id);
			
			if ($penalty->action_takens_count == 0)
			{
				try
				{
					return response()->json(['success' => $penalty->delete() === TRUE]);
				}
				catch (\Exception $e)
				{
					\Log::info($e->getMessage());
				}
			}
			
			return response()->json([
										'success' => FALSE,
										'reason'  => 'This penalty is already associated with other enquiries, therefore, it cannot be deleted until the associated enquiries have been deleted first.',
									]);
		}
	}