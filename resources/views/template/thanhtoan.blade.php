<div style="padding: 10px!important; background-color: transparent;">
    <p>Xin chào: <br>
        <b>{{ $demo->receiver }}</b>
    </p>
    <p>Đơn hàng của bạn đã được {{$demo->action}} vào lúc: {{date_format($demo->created_at,"H:i:s d/m/Y")}}</p>
    <?php $i = 1; $total = 0; ?>
    <p>Chi tiết đơn hàng</p>
@component('mail::table')
| STT    | Tên sách | Đơn giá | Số lượng | Thành tiền  |
| :----: |:-------- | -------:| --------:| ----------: |
@foreach($demo->cart as $item)
<?php $book = \App\Book::find($item['book_id']);
$name = $book['name'];
$cost = number_format($book['giaban']) . ' VNĐ';
$qty = $item['qty'];
$subtotal = number_format($book['giaban'] * $qty) . ' VNĐ';
$total += $book['giaban'] * $qty;?>
|{{$i++}}|{{$name}} |{{$cost}}|{{$qty}}  |{{$subtotal}}|
@endforeach
@endcomponent
    @component('mail::button', ['url' => route('index')])
        Ghé thăm Vbookstore tại đây
    @endcomponent
    <p>Tổng tiền: {{number_format($total) . ' VNĐ'}}</p>
    <p>Cảm ơn bạn đã tin tưởng mua hàng tại Vbookstore</p>
    <p>Chúc bạn luôn có những trải nghiệm tuyệt vời khi mua sách tại Vbookstore</p>
    <p>Nếu thắc mắc gì liên hệ chúng tôi qua email: htbinhnpc@gmail.com</p>
</div>

