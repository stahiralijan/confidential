<?php
	
	namespace App\Http\Controllers;
	
	use App\Charge;
	use App\Http\Requests\ChargeFormRequest;
	use Illuminate\Http\Request;
	
	class ChargeController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return Charge::select(['id','name',])
							->where(function($q)
							{
							  	if(\request('q'))
								{
									$q->where('name', 'like', "%" . request('q') . "%");
								}
							})
							->limit(15)->latest()->get()->toJson();
			}
			
			$charges = Charge::withCount('enquiry_cases')->paginate();
			
			
			return view('charges.index',compact('charges'));
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('charges.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(ChargeFormRequest $request)
		{
			$valid = $request->validated();
			
			Charge::create($valid);
			
			return redirect(action('ChargeController@index'))
				->with('status', 'Charge created successfully');
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Charge $charge
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(Charge $charge)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Charge $charge
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Charge $charge)
		{
			return view('charges.edit', compact('charge'));
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  ChargeFormRequest $request
		 * @param  \App\Charge              $charge
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(ChargeFormRequest $request, Charge $charge)
		{
			$valid = $request->validated();
			
			$charge->update($valid);
			$charge->save();
			
			return redirect(action('ChargeController@index'))
				->with('status', 'Charge updated successfully');
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Charge $charge
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Charge $charge)
		{
			if ($charge->enquiryDetails()->count() == 0)
			{
				try
				{
					return response()->json(['success' => $charge->delete() === TRUE]);
				}
				catch (\Exception $e)
				{
					\Log::info($e->getMessage());
				}
			}
			return response()->json([
										'success' => FALSE,
										'reason'  => 'This charge can not be deleted because it is associated with Enquiries.',
									]);
		}
	}
