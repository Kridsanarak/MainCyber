<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }
    

    // ฟังก์ชันสำหรับแสดงรายละเอียดของผู้ใช้
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('users'));
    }

    public function adminUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function updateName(Request $request)
    {
        // รับข้อมูลจากแบบฟอร์ม
        $newName = $request->input('new_name');

        // หาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // อัปเดตชื่อผู้ใช้
        $user->name = $newName;
        $user->save();

        // กลับไปยังหน้า profile หลังจากอัปเดตเสร็จสิ้น
        return redirect()->route('editprofile');
    }

    public function updatePassword(Request $request)
    {
        // ตรวจสอบรหัสผ่านใหม่และการยืนยันรหัสผ่าน
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        // หาผู้ใช้ที่เข้าสู่ระบบ
        $user = Auth::user();

        // อัปเดตรหัสผ่าน
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        // กลับไปยังหน้า profile หลังจากอัปเดตเสร็จสิ้น
        return redirect()->route('home');
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:100|string',
            'email' => 'required',
            'password' => 'nullable|string|min:8',
        ]);
    
        $user = User::findOrFail($id);
    
        // ตรวจสอบว่ามีการเปลี่ยนแปลงรหัสผ่านหรือไม่
        if ($request->filled('password')) {
            $password = bcrypt($request->password); // เข้ารหัสรหัสผ่านใหม่
        } else {
            $password = $user->password; // ใช้รหัสผ่านเดิม
        }
    
        // ถอดรหัสรหัสผ่านที่ถูกเข้ารหัสออก
        $decodedPassword = password_verify($user->password, $request->password);
    
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password, // ใช้รหัสผ่านที่เข้ารหัสแล้ว
        ];
    
        $user->update($updateData);
    
        return redirect()->back()->with('status','User Update');
    }
    
    

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('status','User Deleted');
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $users = User::where('name', 'LIKE', '%' . $search_text . '%')
              ->orWhere('email', 'LIKE', '%' . $search_text . '%')
              ->get();


        return view('admin.users',compact('users'));
    }

    public function searchUser()
    {
        $search_text = $_GET['query'];
        $users = User::where('name', 'LIKE', '%' . $search_text . '%')
              ->orWhere('email', 'LIKE', '%' . $search_text . '%')
              ->get();


        return view('admin.users',compact('users'));
    }

    public function searchNormal()
    {
        $search_text = $_GET['query'];
        $users = User::where('name', 'LIKE', '%' . $search_text . '%')
              ->orWhere('email', 'LIKE', '%' . $search_text . '%')
              ->get();


        return view('admin.users',compact('users'));
    }
}
