<?php
	
	namespace App\Http\Controllers;
	
	use App\PenaltyType;
	
	class PenaltyTypeController extends Controller
	{
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return PenaltyType::select(['id','name',])
								  ->orWhere('name', 'like', "%" . request('q') . "%")
								  ->limit(15)->latest()->get()->toJson();
			}
			$penaltyTypes = PenaltyType::withCount('actionTakens')->latest()->paginate();
			
			return view('penalty-types.index', compact('penaltyTypes'));
		}
		
		public function create()
		{
		
		}
		
		public function store()
		{
		
		}
		
		public function edit()
		{
		
		}
		
		public function update()
		{
		
		}
		
		public function destroy()
		{
		
		}
	}