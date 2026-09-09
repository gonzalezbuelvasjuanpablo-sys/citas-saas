<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $business = auth()->user()->business;

        $employees = Employee::where('business_id', $business->id)
            ->with('user')
            ->get();

        return view('business.employees.index', compact('employees', 'business'));
    }

    public function create()
    {
        $business = auth()->user()->business;
        return view('business.employees.create', compact('business'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'title'    => 'nullable|string|max:255',
        ]);

        $business = auth()->user()->business;

        // Crear usuario para el empleado
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'business_id' => $business->id,
        ]);
        $user->assignRole('employee');

        // Crear empleado
        Employee::create([
            'business_id' => $business->id,
            'user_id'     => $user->id,
            'title'       => $request->title,
            'is_active'   => true,
        ]);

        return redirect()->route('business.employees.index')
            ->with('success', 'Empleado creado exitosamente.');
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);
        $business = auth()->user()->business;
        return view('business.employees.edit', compact('employee', 'business'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $request->validate([
            'name'  => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
        ]);

        $employee->user->update([
            'name' => $request->name,
        ]);

        $employee->update([
            'title'     => $request->title,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('business.employees.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);
        $employee->user->delete();
        $employee->delete();

        return redirect()->route('business.employees.index')
            ->with('success', 'Empleado eliminado.');
    }
}