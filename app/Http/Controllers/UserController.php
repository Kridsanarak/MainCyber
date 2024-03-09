<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HomeController;


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

    public function searchMember(Request $request)
    {
        $search_text = $request->input('query');
        $users = User::where('name', 'LIKE', '%' . $search_text . '%')
                      ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                      ->paginate(10);
    
        return view('member', compact('users'));
    }
    

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg|max:100'
        ]);
    
        // ตรวจสอบว่ามีการอัพโหลดรูปภาพและเครื่องมือเหล่านี้ให้ตรวจสอบฟอร์มแบบ multipart/form-data ในแท็ก <form>
        if ($request->hasFile('profile_picture')) {
            $image_name = time() . '-' . $request->profile_picture->getClientOriginalName(); // ใช้เมทอด getOriginalClientName() เพื่อรับชื่อของไฟล์ที่อัพโหลดแท้จริง
            $request->profile_picture->move(public_path('users'), $image_name); // ย้ายไฟล์ไปยังโฟลเดอร์ users ใน public directory
            $path = "users/" . $image_name; // กำหนด path ที่ถูกต้องสำหรับฐานข้อมูล
        } else {
            // ถ้าไม่มีการอัพโหลดรูปภาพให้ใช้รูปภาพเดิม
            $path = Auth::user()->profile_picture;
        }
    
        $user = User::findOrFail($id); // ค้นหาข้อมูลผู้ใช้
        $user->name = $request->name;
        $user->profile_picture = $path;
        $user->save(); // บันทึกข้อมูลผู้ใช้
    
        return redirect('editprofile');
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
    
        return redirect('admin/users')->with('status','User Updated Successfully');
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
