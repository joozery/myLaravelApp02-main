@extends('layout')

@section('content')
<div class="container mt-5">
    <h1>ฟอร์มการเบิกของจากคลัง</h1>
    <div class="card px-2 py-3 shadow-sm rounded-none">

        <!-- แสดงข้อความยืนยันการบันทึกสำเร็จ -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <!-- ฟอร์มการเบิกของ -->
                <form action="{{ route('withdraw.store') }}" method="POST" onsubmit="return checkStock()">
                    @csrf

                    <!-- เลือกสินค้า -->
                    <div class="">
                        <label for="item" class="form-label">ชื่อสินค้า</label>
                    </div>
                    <div class="custom-select-wrapper mb-3">
                        <select class="form-control" id="item" name="item" required>
                            <!-- ตัวอย่างการใส่สินค้า สามารถแทนที่ด้วยการดึงข้อมูลจากฐานข้อมูล -->
                            @foreach ($spareParts as $sparePart)
                            <option value="{{ $sparePart->part_name }}" data-stock="{{ $sparePart->amount }}" >{{ $sparePart->part_name }} (คงเหลือ {{ $sparePart->amount }})</option>
                            @endforeach
                        </select>
                        <i class="bi bi-caret-down-fill"></i>
                    </div>

                    <!-- จำนวนการเบิก -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">จำนวนที่ต้องการเบิก:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>

                    <!-- ปุ่มส่งฟอร์ม -->
                    <button type="submit" class="btn button-green w-100">เบิกของ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        function checkStock() {
            // ดึงจำนวนที่ผู้ใช้กรอก
            const quantityInput = document.getElementById('quantity');
            const selectedItem = document.getElementById('item');
            const selectedStock = parseInt(selectedItem.options[selectedItem.selectedIndex].dataset.stock);

            // ตรวจสอบว่าจำนวนที่กรอกมากกว่าจำนวนใน stock หรือไม่
            if (parseInt(quantityInput.value) > selectedStock) {
                alert('สินค้าไม่พอเพียง (โปรดตรวจเช็คว่าสินค้าคงเหลือ > จำนวนที่ต้องการเบิก)');
                return false; // หยุดการ submit ฟอร์ม
            }
            return true; // อนุญาตให้ submit ถ้าผ่านการตรวจสอบ
        }
    </script>
@endsection