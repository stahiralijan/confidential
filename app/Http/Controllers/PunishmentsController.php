<?php
	
	namespace App\Http\Controllers;
	
	use App\Http\Requests\PunishmentRequest;
	use App\Punishments;
	use Illuminate\Http\Request;
	
	class PunishmentsController extends Controller
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
				return Punishments::select([
											   'id',
											   'name',
										   ])
								  ->where('name', 'like', "%" . request('q') . "%")
								  ->limit(15)
								  ->latest()
								  ->get()
								  ->toJson();
			}
			$punishments = Punishments::paginate();
			
			return view('punishments.index', compact('punishments'));
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('punishments.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(PunishmentRequest $request)
		{
			$valid = $request->validated();
			
			$punishment = Punishments::create($valid);
			
			\Notify::success("Punishment ($punishment->name) created successfully", 'Punishment created');
			
			return redirect(action('PunishmentsController@index'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Punishments $punishments
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(Punishments $punishments)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Punishments $punishments
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Punishments $punishments)
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \App\Punishments         $punishments
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Punishments $punishments)
		{
			//
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Punishments $punishments
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Punishments $punishments)
		{
			//
		}
	}
