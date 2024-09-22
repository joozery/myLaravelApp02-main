@extends('layout')

@section('title', 'Welcome Page')

@section('content')

    <div class="container">
        <!-- คุณสามารถเพิ่มเนื้อหาเพิ่มเติมภายใน container นี้ได้ -->
    </div>

    <!-- ปุ่มเพิ่มอะไหล่ -->
    <div class="mb-2">
        <a href="{{ url('/spare-parts/create') }}" role="button" class="btn btn-danger">เพิ่มอะไหล่</a>
    </div>

    <!-- ปุ่มดูข้อมูลอะไหล่ -->
    <div class="mb-2">
        <a href="{{ url('/spare-parts') }}" role="button" class="btn btn-danger">ดูข้อมูลอะไหล่รถ</a>
    </div>

    <!-- ฟอร์ม Logout -->
    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Logout</button>
    </form>

@endsection
