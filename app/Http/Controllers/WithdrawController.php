<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\SparePart; // เพิ่มเพื่อใช้ดึงข้อมูลอะไหล่
use PDF;

class WithdrawController extends Controller
{
    // Method สำหรับแสดงฟอร์มการเบิกของ
    public function create()
    {
        // ดึงข้อมูลสินค้าอะไหล่ทั้งหมดจากฐานข้อมูล
        $spareParts = SparePart::all(); // Assuming you have a SparePart model

        // ส่งข้อมูลไปยัง view
        return view('spare_parts.withdraw.create', compact('spareParts'));
    }

    // Method สำหรับแสดงประวัติการเบิกของ
    public function index()
    {
        $withdraws = Withdraw::all(); // ดึงข้อมูลการเบิกทั้งหมด
        return view('spare_parts.withdraw.history', compact('withdraws'));
    }

    // Method สำหรับบันทึกข้อมูลการเบิก
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'item' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        // บันทึกข้อมูลการเบิกลงในฐานข้อมูล
        Withdraw::create([
            'item' => $request->item,
            'quantity' => $request->quantity,
        ]);

        // กลับไปยังหน้าฟอร์มการเบิก พร้อมข้อความยืนยันการบันทึกสำเร็จ
        return redirect()->route('withdraw_form')->with('success', 'บันทึกข้อมูลการเบิกสำเร็จ!');
    }

    // Method สำหรับดาวน์โหลด PDF
    public function downloadPDF($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $pdf = PDF::loadView('withdraw.pdf', compact('withdraw'));
        return $pdf->download('withdraw_' . $id . '.pdf');
    }
}
