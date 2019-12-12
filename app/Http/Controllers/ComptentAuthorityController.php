<?php
	
	namespace App\Http\Controllers;
	
	use App\ComptentAuthority;
	use App\Designation;
	use App\Http\Requests\CompetentAuthorityRequest;
	use Illuminate\Http\Request;
	
	class ComptentAuthorityController extends Controller
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
				return ComptentAuthority::select(['id','name',])
								  ->where('name', 'like', "%" . request('q') . "%")
								  ->limit(15)->latest()->get()->toJson();
			}
			
			$competentAuthorities = ComptentAuthority::with('designation')->paginate();
			
			return view('competent-authority.index', compact('competentAuthorities'));
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			$designations = Designation::get();
			return view('competent-authority.create', compact('designations'));
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(CompetentAuthorityRequest $request)
		{
			$valid = $request->validated();
			
			$ca = ComptentAuthority::create($valid);
			
			\Notify::success("Competent Authority ($ca->name) created successfully", 'Competent authority created');
			
			return redirect(action('ComptentAuthorityController@index'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  \App\ComptentAuthority $comptentAuthority
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(ComptentAuthority $comptentAuthority)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\ComptentAuthority $comptentAuthority
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit(ComptentAuthority $comptentAuthority)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\ComptentAuthority   $comptentAuthority
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, ComptentAuthority $comptentAuthority)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\ComptentAuthority $comptentAuthority
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(ComptentAuthority $comptentAuthority)
		{
			//
		}
	}
