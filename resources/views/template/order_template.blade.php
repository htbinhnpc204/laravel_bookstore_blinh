<div style="padding: 10px!important; background-color: transparent;">
    <p>Xin chào: <br>
        <b>{{ $demo->receiver }}</b>
    </p>
    <p>Đơn hàng của bạn đã được {{$demo->action}} vào lúc: {{date_format($demo->created_at,"H:i:s d/m/Y")}}</p>
    <?php $i = 1; $total = 0; ?>
@component('mail::table')
| STT    | Tên sách | Đơn giá | Số lượng | Thành tiền  |
| :----: |:-------- | -------:| --------:| ----------: |
@foreach($demo->cart as $key => $value)
<?php $book = \App\Book::find($key);
$name = $book['name'];
$cost = number_format($book['giaban']) . ' VNĐ';
$qty = $value['qty'];
$subtotal = number_format($book['giaban'] * $qty) . ' VNĐ';
$total += $book['giaban'] * $qty;?>
|{{$i++}}|{{$name}} |{{$cost}}|{{$qty}}  |{{$subtotal}}|
@endforeach
@endcomponent
    <p>Tổng tiền: {{number_format($total) . ' VNĐ'}}</p>
</div>

