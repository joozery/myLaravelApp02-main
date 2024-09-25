<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // เพิ่มเพื่อเชื่อมต่อกับโมเดล User

class Withdraw extends Model
{
    use HasFactory;

    // ระบุชื่อของตารางที่ใช้ในฐานข้อมูล (optional หากชื่อตรงกับชื่อ Model)
    protected $table = 'withdraws';

    // ระบุ field ที่สามารถบันทึกข้อมูลลงได้ (mass-assignable)
    protected $fillable = [
        'item',
        'quantity',
        'withdraw_by',
    ];

    // หากมีความสัมพันธ์กับ Model อื่นๆ ก็สามารถกำหนดได้ เช่น ความสัมพันธ์กับ SparePart
    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'spare_part_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'withdraw_by');
    }
}
