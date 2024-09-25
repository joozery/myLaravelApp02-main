@extends('layout')

@section('content')

<h1>Session ID: {{ session()->getId() }}</h1>
    <h1>ประวัติการเบิกของ</h1>
    <table class="table table-bordered">
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
                    <td>{{ $withdraw->created_at->format('d/m/Y') }}</td>
                    <td>{{ $withdraw->user ? $withdraw->user->name : 'ไม่ทราบ' }}</td>
                    <td></td>
                    <!-- <td><a href="{{ route('withdraw.pdf', $withdraw->id) }}" class="btn btn-primary">ดาวน์โหลด PDF</a></td> -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
