<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;
use Illuminate\Support\Facades\Storage; // เพิ่มเพื่อใช้ Storage

class SparePartController extends Controller
{
    // Method สำหรับแสดงฟอร์มเพิ่มข้อมูลอะไหล่
    public function create()
    {
        return view('spare_parts.create');
    }

    // Method สำหรับบันทึกข้อมูลจากฟอร์มลงฐานข้อมูล
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
        $request->validate([
            'part_name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer',
            'type_spare' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // จัดการการอัปโหลดไฟล์รูปภาพ (ถ้ามี)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // บันทึกไฟล์ใน public storage
            $imagePath = $request->file('image')->store('images/spare_parts', 'public');
        }

        // สร้างข้อมูลใหม่ในฐานข้อมูล
        SparePart::create([
            'part_name' => $request->part_name,
            'amount' => $request->amount,
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'price' => $request->price,
            'year' => $request->year,
            'type_spare' => $request->type_spare,
            'image' => $imagePath, // เก็บ path รูปภาพที่อัปโหลดลงในฐานข้อมูล
        ]);

        // หลังจากบันทึกเสร็จแล้ว ให้กลับไปที่หน้า create พร้อมแสดงข้อความสำเร็จ
        return redirect()->route('spare_parts.create')->with('success', 'Spare part added successfully!');
    }

    // Method สำหรับแสดงรายการอะไหล่ทั้งหมด
    public function index()
    {
        $spareParts = SparePart::all(); // ดึงข้อมูลอะไหล่ทั้งหมดจากฐานข้อมูล
        return view('spare_parts.index', compact('spareParts')); // ส่งข้อมูลไปแสดงใน view
    }

    // Method สำหรับแก้ไขข้อมูลอะไหล่
    public function edit($id)
    {
        $sparePart = SparePart::findOrFail($id); // หาอะไหล่ที่ต้องการแก้ไข
        return view('spare_parts.edit', compact('sparePart')); // ส่งข้อมูลไปแสดงใน view
    }

    // Method สำหรับอัปเดตข้อมูลอะไหล่
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'part_name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer',
            'type_spare' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sparePart = SparePart::findOrFail($id); // หาอะไหล่ที่ต้องการแก้ไข

        // ตรวจสอบและจัดการการอัปโหลดไฟล์รูปภาพใหม่ (ถ้ามี)
        $imagePath = $sparePart->image; // เก็บ path รูปภาพเดิมก่อน
        if ($request->hasFile('image')) {
            // ลบรูปภาพเก่าถ้ามี
            if ($sparePart->image) {
                Storage::disk('public')->delete($sparePart->image);
            }
            // อัปโหลดรูปภาพใหม่และบันทึก path ลงในฐานข้อมูล
            $imagePath = $request->file('image')->store('images/spare_parts', 'public');
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $sparePart->update([
            'part_name' => $request->part_name,
            'amount' => $request->amount,
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'price' => $request->price,
            'year' => $request->year,
            'type_spare' => $request->type_spare,
            'image' => $imagePath, // อัปเดต path รูปภาพใหม่
        ]);

        // หลังจากอัปเดตเสร็จแล้ว ให้กลับไปที่หน้า index พร้อมแสดงข้อความสำเร็จ
        return redirect()->route('spare_parts.index')->with('success', 'Spare part updated successfully!');
    }

    // Method สำหรับลบข้อมูลอะไหล่
    public function destroy($id)
    {
        try {
            // หาอะไหล่ที่ต้องการลบโดยใช้ ID
            $sparePart = SparePart::findOrFail($id);

            // ลบรูปภาพถ้ามี
            if ($sparePart->image) {
                Storage::disk('public')->delete($sparePart->image);
            }

            // ลบอะไหล่ออกจากฐานข้อมูล
            $sparePart->delete();

            // คืนค่า redirect พร้อมกับข้อความสำเร็จ
            return redirect()->route('spare_parts.index')->with('success', 'ลบข้อมูลอะไหล่สำเร็จแล้ว');
        } catch (\Exception $e) {
            // คืนค่า redirect พร้อมกับข้อความแสดงข้อผิดพลาด
            return redirect()->route('spare_parts.index')->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }
    }

    // Method สำหรับหน้า homep (พนักงานคลังอะไหล่)
    public function homep()
    {
        $spareParts = SparePart::all();
        return view('homep', compact('spareParts'));
    }
}
