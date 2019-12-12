<?php
	
	namespace App\Http\Controllers;
	
	use App\EnquiryCase;
	use Illuminate\Http\Request;
	use Yajra\DataTables\Facades\DataTables;
	
	class FinzalizedCasesController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index(Request $request)
		{
			if ($request->ajax())
			{
				$data = EnquiryCase::with([
											  'employee',
											  'designation',
											  'office',
											  'charges',
											  'competent_authority',
											  'competent_authority.designation',
											  'imposing_authority',
											  'imposing_authority.designation',
											  'punishment',
										  ])
					->where('is_finalized', true)
								   ->whereHas('office', function ($q) use ($request)
								   {
									   if ($request->filled('office_id'))
									   {
										   $q->where('id', '=', $request->office_id);
									   }
								   })
								   ->whereHas('charges', function ($q) use ($request)
								   {
									   if ($request->filled('charges_id'))
									   {
										   $q->where('id', '=', $request->charges_id);
									   }
								   })
								   ->whereHas('designation', function ($q) use ($request)
								   {
									   if ($request->filled('designation_id'))
									   {
										   $q->where('id', '=', $request->designation_id);
									   }
								   })
									->whereHas('punishment', function ($q) use ($request)
									{
										if ($request->filled('punishment_id'))
										{
											$q->where('id', '=', $request->punishment_id);
										}
									})
								   ->where(function ($q) use ($request)
								   {
										$q->where('is_finalized', '=', true);
									   if ($request->filled('ending_date') && $request->filled('starting_date'))
									   {
										   $q->whereBetween('issue_date', [$request->starting_date, $request->ending_date]);
									   }
								   })
								   ->latest('enquiry_cases.created_at');
				//
				//->paginate();
				
				return Datatables::of($data)
								 ->addIndexColumn()
								 ->editColumn('issue_date', function ($row)
								 {
									 //change over here
									 return $row->issue_date->format('d/m/Y');
								 })
								 ->addColumn('action', function ($row)
								 {
									 $btn = '';
									 if (!$row->is_finalized)
									 {
										 $btn = "<div class='dropdown'><button type='button' class='btn btn-primary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>" . "<div class='dropdown-menu' aria-labelledby='actions'><a href=" . action('EnquiryCaseController@edit', $row->id) . " class='dropdown-item'>Finalize</a></div></div>";
									 }
									 return $btn;
								 })
								 ->rawColumns(['action'])
								 ->make(TRUE);
			}
			
			return view('finalized-cases.index');
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			//
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			//
		}
	}
