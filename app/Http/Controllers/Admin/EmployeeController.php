<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

use function Ramsey\Uuid\v1;

class EmployeeController extends Controller
{
    public function index() {
        $data = [
            'personnel_employee' => DB::table('personnel_employee')
                ->leftJoin('personnel_department', 'personnel_employee.department_id', '=', 'personnel_department.id')
                ->leftJoin('personnel_position', 'personnel_employee.position_id', '=', 'personnel_position.id')
                ->select('personnel_employee.*', 'personnel_department.dept_name', 'personnel_position.position_name')
                ->get(),
            'departments' =>  DB::table('personnel_department')->get(),
            'positions' =>  DB::table('personnel_position')->get(),
        ];
    
        // dd($data);
        return view('admin.employees.index')->with($data);
    }
    
    public function create() {
        $data = [
            'departments' => Department::all(),
            'desgs' => ['Manajer','Pegawai']
        ];
        return view('admin.employees.create')->with($data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'desg' => 'required',
            'department_id' => 'required',
            'salary' => 'required|numeric',
            'email' => 'required|email',
            'photo' => 'image|nullable',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $employeeRole = Role::where('name', 'employee')->first();
        $user->roles()->attach($employeeRole);
        $employeeDetails = [
            'user_id' => $user->id, 
            'first_name' => $request->first_name, 
            'last_name' => $request->last_name,
            'sex' => $request->sex, 
            'dob' => $request->dob, 
            'join_date' => $request->join_date,
            'desg' => $request->desg, 
            'department_id' => $request->department_id, 
            'salary' => $request->salary, 
            'photo'  => 'user.png'
        ];

        // Photo upload
        if ($request->hasFile('photo')) {
            // GET FILENAME
            $filename_ext = $request->file('photo')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('photo')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            // $path = $request->file('photo')->storeAs('public'.DIRECTORY_SEPARATOR.'employee_photos', $filename_store);
            // add new file name
            $image = $request->file('photo');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(300, 300);
            $image_resize->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$filename_store));
            $employeeDetails['photo'] = $filename_store;
        }
        
        Employee::create($employeeDetails);
        
        $request->session()->flash('success', 'Karyawan berhasil ditambahkan!');
        return back();
    }

    public function attendance(Request $request) {
        $data = [
            'date' => null
        ];
        
        // dd($data);
        if($request->has('date')) {
            $dateRange = explode(' - ', $request->date);
            $startDate = Carbon::createFromFormat('d-m-Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d-m-Y', $dateRange[1])->endOfDay();
            
            $employees = $this->attendanceByDateRange($startDate, $endDate);
            $data['date'] = $startDate->format('d M, Y') . ' - ' . $endDate->format('d M, Y');
        } else {
            $employees = $this->attendanceByDate(Carbon::now());
            $today = Carbon::now()->format('Y-m-d');
            $employees = $employees->filter(function ($employee) use ($today) {
                return substr($employee->punch_time, 0, 10) === $today; });

        }

        $data['iclock_transaction'] = $employees;
                    
        return view('admin.employees.attendance')->with($data);
    }
    
    public function attendanceByDateRange($startDate, $endDate) {
        $attendances = DB::table('iclock_transaction')
            ->select('iclock_transaction.id', 'iclock_transaction.emp_id', 'iclock_transaction.sync_status', 'iclock_transaction.punch_time', 'iclock_transaction.punch_state', 'personnel_employee.first_name', 'personnel_employee.department_id', 'personnel_department.dept_name')
            ->join('personnel_employee', 'iclock_transaction.emp_id', '=', 'personnel_employee.id')
            ->join('personnel_department', 'personnel_employee.department_id', '=', 'personnel_department.id')
            ->whereBetween('iclock_transaction.punch_time', [$startDate, $endDate])
            ->get();

        return $attendances;
    }
    
    
    

    public function attendanceByDate($date) {
            $attendances = DB::table('iclock_transaction')
            ->select('iclock_transaction.id', 'iclock_transaction.emp_id', 'iclock_transaction.sync_status', 'iclock_transaction.punch_time', 'iclock_transaction.punch_state', 'personnel_employee.first_name', 'personnel_employee.department_id', 'personnel_department.dept_name')
            ->join('personnel_employee', 'iclock_transaction.emp_id', '=', 'personnel_employee.id')
            ->join('personnel_department', 'personnel_employee.department_id', '=', 'personnel_department.id')
            ->whereDate('iclock_transaction.punch_time', $date)
            ->get();    
    
        return $attendances->map(function($attendance) {
            // Menambahkan properti attendanceToday ke setiap entri employee
            $attendance->attendanceToday = $attendance->punch_time;
            return $attendance;
        });
    }
    

    public function destroy($employee_id) {
        $employee = DB::table('personnel_employee')->where('id', $employee_id)->first();
        if ($employee) {
            DB::table('personnel_employee')->where('id', $employee_id)->delete();
            request()->session()->flash('success', 'Karyawan berhasil dihapus!');
        } else {
            request()->session()->flash('warning', 'Karyawan tidak ditemukan!');
        }        
        return back();
    }

    public function attendanceDelete($attendance_id) {
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->delete();
        request()->session()->flash('success', 'Riwayat Absensi berhasil dihapus!');
        return back();
    }

    public function employeeProfile($employee_id) {
        $employee = Employee::findOrFail($employee_id);
        return view('admin.employees.profile')->with('employee', $employee);
    }

    public function updatev2(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|integer', 
            'position' => 'required|integer',
            'hire_date' => 'required|date',
        ]);
    
        // Mengambil data karyawan yang akan diupdate
        $employee = DB::table('personnel_employee')
            ->where('id', $id)
            ->first();
    
        // Jika data karyawan tidak ditemukan, kembalikan response dengan status 404 (Not Found)
        if (!$employee) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan.');
        }
    
        // Menyiapkan data baru yang akan diupdate
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name'=> $request->input('last_name'),
            'department_id' => $request->input('department'),
            'position_id' => $request->input('position'),
            'hire_date' => $request->input('hire_date'),
            // Tambahkan kolom-kolom lain yang perlu diupdate sesuai kebutuhan
        ];
    
        // Melakukan update data karyawan
        DB::table('personnel_employee')
            ->where('id', $id)
            ->update($data);
    
        // Mengembalikan response berhasil
        return redirect()->route('admin.employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }
}
