<?php
	
	namespace App\Http\Controllers;
	
	use App\Employee;
	use App\EnquiryCase;
	use App\Http\Requests\EmployeeFormRequest;
	use Illuminate\Support\Facades\Request;
	
	class EmployeeController extends Controller
	{
		private $user = null;
		
		public function index()
		{
			if (request()->ajax() && request('_type') == 'query')
			{
				return Employee::select(['id','fullname','cnic','fathername'])
								->orWhere('fullname', 'like', "%".request('q')."%")
								->orWhere('fathername', 'like', "%".request('q')."%")
								->orWhere('cnic', 'like', "%".request('q')."%")
								->limit(15)->latest()->get()->toJson();
			}
			
			$employees = Employee::select(['id','fullname','fathername', 'employee_code', 'mobile_number'])
				->latest()->paginate();
			
			return view('employees.index', compact('employees'));
		}
		
		public function create()
		{
			return view('employees.create');
		}
		
		public function store(EmployeeFormRequest $request)
		{
			$validatedEmployee = $request->validated();
			
			Employee::create($validatedEmployee);
			
			\Notify::success("Employee created successfully", 'Employee created');
			
			return redirect(action('EmployeeController@index'));
		}
		
		public function search()
		{
			if(request()->filled('employee_id'))
			{
				$id = request()->employee_id;
				$employee = Employee::findOrFail($id);
				$enquiries = EnquiryCase::with(['charges','punishment','competent_authority','office'])
										->where('employee_id','=',$id)->get();
				
				return view('employees.result', compact('enquiries','employee'));
			}
			return view('employees.search');
		}
		
		public function show($id)
		{
			$employee = Employee::with(['office','designation'])->findOrFail($id);
			
			return view('employees.show', compact('employee'));
		}
		
		public function edit($id)
		{
			$employee = Employee::findOrFail($id);
			
			return view('employees.edit', compact('employee'));
		}
		
		public function update(EmployeeFormRequest $request, $id)
		{
			$employee = Employee::findOrFail($id);
			$valid = $request->validated();
			
			$employee->update($valid);
			
			\Notify::success("Employee ($request->fullname) updated successfully", 'Employee updated');
			
			return redirect(action('EmployeeController@index'));
		}
		
		public function destroy($id)
		{
			$employee = Employee::findOrFail($id);
		}
	}