<!doctype html>
<html lang="vn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            font-family: DejaVu Sans, serif !important;}
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #6b5ee4;
            color: white;
        }
    </style>
    <title>Document</title>
</head>
<body>
<p>Người mua: {{$buyer}} </p>
<p>Ngày tạo đơn hàng: {{$order->created_at}}</p>
<p>Tình trạng: chờ xác nhận</p>
<table id="laravel_crud" >
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Giá bán</th>
        <th>Số lượng</th>
        <th>Tổng cộng</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; $i = 1; ?>
    @foreach($details as $item)
        <?php $book = \App\Book::find($item['book_id']) ?>
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $book->name }}</td>
            <td>{{ number_format($book->giaban) . ' VNĐ'}}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item['quantity'] * $book['giaban']) . ' VNĐ' }}</td>
        </tr>
        <?php $total += $item['quantity'] * $book['giaban']; ?>
    @endforeach
    </tbody>
</table>
<p><strong>Tổng tiền: </strong>{{ number_format($total) . ' VNĐ'}}</p>

</body>
</html>

