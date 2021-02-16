<?php
	
	namespace App\Http\Controllers;
	
	use App\EnquiryCase;
	use App\Http\Requests\EnquiryCaseRequest;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Http\Request;
	use Yajra\DataTables\Facades\DataTables;
	
	
	class EnquiryCaseController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @param \Request $request
		 *
		 * @return \Illuminate\Http\Response
		 * @throws \Exception
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
										  ])
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
					
								   ->where(function ($q) use ($request)
								   {
									   if ($request->filled('is_finalized'))
									   {
										   $q->where('is_finalized', '=', $request->is_finalized);
									   }
									   if ($request->filled('ending_date') && $request->filled('starting_date'))
									   {
										   $q->whereBetween('issue_date', [$request->starting_date, $request->ending_date]);
									   }
								   })
								   ->latest();
				//
				//->paginate();
				
				return Datatables::of($data)
								 ->addIndexColumn()
								 ->editColumn('issue_date', function ($row)
								 {
									 //change over here
									 return $row->issue_date->format('Y-m-d');
								 })
								 ->addColumn('action', function ($row)
					{
						$btn = '';
						if (!$row->is_finalized)
						{
							$btn = "<div class='dropdown'><button type='button' class='btn btn-primary btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Action</button>"
								   . "<div class='dropdown-menu' aria-labelledby='actions'><a href=" . action('EnquiryCaseController@edit', $row->id) . " class='dropdown-item'>Finalize</a></div></div>";
						}
						return $btn;
					})
								 ->rawColumns(['action'])
								 ->make(TRUE);
			}
			
			
			return view('enquiry-cases.index');
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('enquiry-cases.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(EnquiryCaseRequest $request)
		{
			$valid = $request->validated();
			
			$ec = EnquiryCase::create($valid);
			
			\Notify::success("Case number ($ec->enquiry_no) created successfully", 'Case created');
			
			return redirect(action('EnquiryCaseController@index'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  \App\EnquiryCase $enquiryCase
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(EnquiryCase $enquiryCase)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			$enquiryCase = EnquiryCase::findOrFail($id);
			
			return view('enquiry-cases.edit', compact('enquiryCase'));
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\EnquiryCase         $enquiryCase
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(EnquiryCaseRequest $request, $id)
		{
			$enquiryCase = EnquiryCase::findOrFail($id);
			
			$valid = $request->validated();
			
			$enquiryCase->is_finalized = TRUE;
			$enquiryCase->update($valid);
			$enquiryCase->save();
			
			\Notify::success("Case number ($enquiryCase->enquiry_no) finalized successfully", 'Case finalized');
			
			return redirect(action('EnquiryCaseController@index'));
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\EnquiryCase $enquiryCase
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(EnquiryCase $enquiryCase)
		{
			//
		}
	}
