@extends('layout')

@section('title', 'ดูข้อมูลอะไหล่')

@section('content')
<div class="container mt-5">
    <h1>ข้อมูลอะไหล่</h1>

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

    <table class="table text-center table-striped rounded-table shadow-sm">
        <thead>
            <tr>
                <th>ชื่ออะไหล่</th>
                <th>จำนวน</th>
                <th>ยี่ห้อ</th>
                <th>รุ่น</th>
                <th>สี</th>
                <th>ราคา</th>
                <th>ปี</th>
                <th>ประเภทอะไหล่</th>
                <th>รูปภาพ</th>
                <th>แก้ไขข้อมูลอะไหล่</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($spareParts as $sparePart)
            <tr>
                <td>{{ $sparePart->part_name }}</td>
                <td>{{ $sparePart->amount }}</td>
                <td>{{ $sparePart->brand }}</td>
                <td>{{ $sparePart->model }}</td>
                <td>{{ $sparePart->color }}</td>
                <td>{{ number_format($sparePart->price, 2) }}</td>
                <td>{{ $sparePart->year }}</td>
                <td>{{ $sparePart->type_spare }}</td>
                <td>
                    @if ($sparePart->image)
                    <img src="{{ asset('storage/' . $sparePart->image) }}" alt="{{ $sparePart->part_name }}" class="img-fluid" style="width:100px;">
                    @else
                    ไม่มีรูปภาพ
                    @endif
                </td>

                <td>
                    <!-- แก้ไขให้ใช้ 'id' แทน 'part_id' -->
                    <a href="{{ route('spare_parts.edit', ['id' => $sparePart->part_id]) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">ไม่มีข้อมูลอะไหล่</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $spareParts->links('pagination::bootstrap-4') }}
    </div>

    <!-- <div class="mb-2">
        <a href="{{ url('/home') }}" role="button" class="btn btn-danger">ย้อนกลับ</a>
    </div> -->
</div>
@endsection