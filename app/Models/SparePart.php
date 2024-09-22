<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    // ระบุคอลัมน์ primary key
    protected $primaryKey = 'part_id';

    // กำหนดให้ part_id เป็น auto-increment
    public $incrementing = true; // ถ้า part_id ไม่ใช่ auto-increment ให้เปลี่ยนเป็น false

    // ตั้งค่า key type เป็น integer
    protected $keyType = 'int'; // เปลี่ยนเป็น 'string' ถ้าใช้ string เป็นคีย์หลัก

    // กำหนดคอลัมน์ที่สามารถกรอกข้อมูลได้ (fillable)
    protected $fillable = [
        'part_name',
        'amount',
        'brand',
        'model',
        'color',
        'price',
        'year',
        'type_spare',
        'image',
    ];

    // ระบุชื่อของตารางในฐานข้อมูล
    protected $table = 'spare_parts'; // ถ้าชื่อตารางไม่ใช่ 'spare_parts' ให้แก้ไขตามชื่อตารางในฐานข้อมูล
}
