<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;

class EmployeeController extends Controller
{
	
    public function listEmployees(Request $request)
    {
    	return Employee::get();
    }

    public function getEmployee(Request $request)
    {
    	return Employee::findOrFail($request->id);
    }

    public function createEmployee(Request $request)
    {

        $company = Company::find($request->company_id);

        if($company){
            $employee = new Employee($request->all());
            $employee->save();

            return $employee;
        }
        else{
            return response()->json(["message" => "Company not found"]);
        }

    }

    public function editEmployee(Request $request)
    {

        $company = Company::find($request->company_id);

        if($company){
            $employee = Employee::findOrFail($request->id);
            $employee->update($request->all());
            
            return $employee;
        }
        else{
            return response()->json(["message" => "Company not found"]);
        }
    }

    public function deleteEmployee(Request $request)
    {
    	Employee::findOrFail($request->id)->delete();
    }
}
