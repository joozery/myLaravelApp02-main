<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // แสดงหน้า register
    public function register()
    {
        return view('register');
    }

    // การจัดการการลงทะเบียน
    public function registerPost(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed', // เพิ่มการยืนยันรหัสผ่าน
            'role' => 'required|string', // กำหนด role เป็นค่าว่างไม่ได้
        ]);

        // สร้างผู้ใช้ใหม่
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password); // เข้ารหัสรหัสผ่าน
        $user->role = $request->role; // บันทึก role ที่ผู้ใช้เลือก
        $user->save();

        // ส่งกลับไปพร้อมกับข้อความสำเร็จ
        return redirect()->route('login')->with('success', 'สมัครสมาชิกสำเร็จ!');
    }

    // แสดงหน้า login
    public function login()
    {
        return view('login');
    }

    // จัดการการล็อกอิน
    public function loginPost(Request $request)
    {
        // ตรวจสอบข้อมูลผู้ใช้
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        // ตรวจสอบข้อมูลรับรองความถูกต้อง
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ

            if ($user) {
                // ตรวจสอบ role ของผู้ใช้ และเปลี่ยนเส้นทางไปยังหน้าที่เหมาะสม
                switch ($user->role) {
                    case 'แอดมิน':
                        return redirect('/home')->with('success', 'Login Success');
                    case 'พนักงานคลังอะไหล่':
                        return redirect('/homep')->with('success', 'Login Success');
                    case 'เจ้าของอู่':
                        return redirect('/home')->with('success', 'Login Success');
                    default:
                        return back()->with('error', 'Unauthorized role');
                }
            }
        }

        // ส่งกลับไปพร้อมกับข้อความแสดงข้อผิดพลาดหากข้อมูลรับรองไม่ถูกต้อง
        return back()->with('error', 'Error: Username or Password is incorrect');
    }

    // จัดการการล็อกเอาท์
    public function logout()
    {
        Auth::logout(); // ออกจากระบบ
        return redirect()->route('login')->with('success', 'ออกจากระบบสำเร็จ!');
    }
}
