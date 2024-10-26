<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\SparePart; // เพิ่มเพื่อใช้ดึงข้อมูลอะไหล่
use Illuminate\Support\Facades\Auth; // ใช้ Auth เพื่อตรวจสอบผู้ใช้ที่ล็อกอิน
// use PDF;

class WithdrawController extends Controller
{
    // Method สำหรับแสดงฟอร์มการเบิกของ
    public function create()
    {
        // ดึงข้อมูลสินค้าอะไหล่ทั้งหมดจากฐานข้อมูล
        $spareParts = SparePart::all();

        // ส่งข้อมูลไปยัง view
        return view('spare_parts.withdraw.create', compact('spareParts'));
    }

    // Method สำหรับแสดงประวัติการเบิกของ
    public function index()
    {
        $withdraws = Withdraw::all();
        return view('spare_parts.withdraw.history', compact('withdraws'));
    }

    // Method สำหรับบันทึกข้อมูลการเบิก
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'item' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        // ดึงข้อมูลอะไหล่จากฐานข้อมูลตามชื่อที่เลือก
        $sparePart = SparePart::where('part_name', $request->item)->first();

        // ตรวจสอบว่าอะไหล่มีอยู่จริงหรือไม่
        if (!$sparePart) {
            return redirect()->back()->with('error', 'ไม่พบสินค้าในระบบ');
        }

        // ตรวจสอบว่าสินค้ามีเพียงพอหรือไม่
        if ($sparePart->amount >= $request->quantity) {
            
            // ลดจำนวนสินค้าในคลัง
            $sparePart->amount -= $request->quantity;
            $sparePart->save(); // อัปเดตข้อมูลในฐานข้อมูล

            // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
            $userId = Auth::id();
            $userName = Auth::user()->name;

            // บันทึกข้อมูลการเบิกลงในฐานข้อมูล
            Withdraw::create([
                'item' => $request->item,
                'quantity' => $request->quantity,
                'withdraw_by' => $userId, // บันทึก ID ของผู้ใช้ที่ล็อกอินอยู่
            ]);

            // กลับไปยังฟอร์มการเบิก พร้อมข้อความสำเร็จ
            return redirect()->route('withdraw_form')->with('success', 'บันทึกข้อมูลการเบิกสำเร็จโดย ' . $userName . '!');
        } else {
            // กรณีที่สินค้าไม่เพียงพอ
            return redirect()->back()->with('error', 'สินค้าคงเหลือไม่เพียงพอ');
        }
    }
}
