@extends('layout')

@section('content')

<!-- <h1>Session ID: {{ session()->getId() }}</h1> -->
<h1 class="mb-2 pb-1">ประวัติการเบิกของ</h1>
<!-- <table class="table text-center table-striped rounded-table shadow-sm">
        <thead>
            <tr>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>วันที่เบิก</th>
                <th>ผู้เบิกของ</th>
                <th>เพิ่มเติม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdraws as $withdraw)
            <tr>
                <td>{{ $withdraw->item }}</td>
                <td>{{ $withdraw->quantity }}</td>
                <td>{{ $withdraw->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $withdraw->user ? $withdraw->user->name : 'ไม่ทราบ' }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table> -->

<table class="table text-center table-striped rounded-table shadow-sm">
    <thead>
        <tr>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>วันที่เบิก</th>
            <th>ผู้เบิกของ</th>
            <th>เพิ่มเติม</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($withdraws as $withdraw)
        <tr>
            <td>{{ $withdraw->item }}</td>
            <td>{{ $withdraw->quantity }}</td>
            <td>{{ $withdraw->created_at->setTimezone('Asia/Bangkok')->format('d/m/Y H:i:s') }}</td>
            <td>{{ $withdraw->user ? $withdraw->user->name : 'ไม่ทราบ' }}</td>
            <td>
                <!-- <a href="{{ route('withdraw.pdf', $withdraw->id) }}" class="btn btn-primary">ดาวน์โหลด PDF</a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-3">
    {{ $withdraws->links('pagination::bootstrap-4') }}
</div>



@endsection