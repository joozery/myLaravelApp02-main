<!DOCTYPE html>
<html>
<head>
    <title>Withdraw Details</title>
</head>
<body>
    <h1>รายละเอียดการเบิกของ</h1>
    <p>ชื่อสินค้า: {{ $withdraw->item }}</p>
    <p>จำนวน: {{ $withdraw->quantity }}</p>
    <p>วันที่เบิก: {{ $withdraw->created_at->format('d/m/Y') }}</p>
</body>
</html>
