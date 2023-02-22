<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        $positions = Position::all();
        return view('employee.create', compact('employees', 'positions'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();
        $photo = $request->file('photo');
        $name = time() . '_' . pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
        $filepath =  storage_path('app/public/img/employees/main/' . $name);
        $preview =  storage_path('app/public/img/employees/preview/' . $name);
        $img = \Intervention\Image\Facades\Image::make($photo)->crop(300, 300)->encode('jpg', 80);
        $img->save($filepath);
        $img->resize(50, 50)->save($preview );
        $data['photo'] = ('img/employees/main/' . $name );
        $data['preview_photo'] = ('img/employees/preview/' . $name);

        if(isset($data['head'])) {
            $data['head_id'] = Employee::where('name', $data['head'])->first()->id;
        }
        $data['employment_date'] = Carbon::createFromFormat('d.m.y', $data['employment_date'])->format('Y-m-d');

        $employee = Employee::create($data);

        return redirect()->route('employees.index');

    }

    public function delete(Employee $employee)
    {
        Storage::delete('/public/' . $employee->photo);
        Storage::delete('/public/' . $employee->preview_photo);
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function edit( Employee $employee)
    {
        $employees = Employee::all();
        $positions = Position::all();
        return view('employee.edit', compact('employees', 'positions', 'employee'));
    }

    public function update(UpdateEmployeeRequest $request , Employee $employee)
    {
        $data = $request->validated();

        if($request->has('photo')) {
            $photo = $request->file('photo');
            $name = time() . '_' . pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
            $filepath =  storage_path('app/public/img/employees/main/' . $name);
            $preview =  storage_path('app/public/img/employees/preview/' . $name);
            $img = \Intervention\Image\Facades\Image::make($photo)->crop(300, 300)->encode('jpg', 80);
            $img->save($filepath);
            $img->resize(50, 50)->save($preview );
            $data['photo'] = ('img/employees/main/' . $name );
            $data['preview_photo'] = ('img/employees/preview/' . $name);
        }

        if(isset($data['head'])) {
            $data['head_id'] = Employee::where('name', $data['head'])->first()->id;
        }

        $data['employment_date'] = Carbon::createFromFormat('d.m.y', $data['employment_date'])->format('Y-m-d');

        $employee = $employee->update($data);

        return redirect()->route('employees.index');
    }

    public function test($id)
    {
        $employee = Employee::find($id);

        $employee->update(['head_id' => null]);
    }
}
