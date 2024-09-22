@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1>ฟอร์มการเบิกของจากคลัง</h1>

        <!-- แสดงข้อความยืนยันการบันทึกสำเร็จ -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- ฟอร์มการเบิกของ -->
        <form action="{{ route('withdraw.store') }}" method="POST">
            @csrf

            <!-- เลือกสินค้า -->
            <div class="mb-3">
                <label for="item" class="form-label">ชื่อสินค้า</label>
                <select class="form-control" id="item" name="item" required>
                    <!-- ตัวอย่างการใส่สินค้า สามารถแทนที่ด้วยการดึงข้อมูลจากฐานข้อมูล -->
                    @foreach ($spareParts as $sparePart)
                        <option value="{{ $sparePart->part_name }}">{{ $sparePart->part_name }} (คงเหลือ {{ $sparePart->amount }})</option>
                    @endforeach
                </select>
            </div>

            <!-- จำนวนการเบิก -->
            <div class="mb-3">
                <label for="quantity" class="form-label">จำนวน</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>

            <!-- ปุ่มส่งฟอร์ม -->
            <button type="submit" class="btn btn-primary">เบิกของ</button>
        </form>
    </div>
@endsection
