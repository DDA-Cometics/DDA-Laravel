<div>Him Đẹp Trai</div>

@foreach ($vouchers as $voucher)
    <div>{{$voucher->id}}</div>
    <div>{{$voucher->discount*100}}%</div>
    <div>{{$voucher->active_datetime}}</div>
    <div>{{$voucher->expired_datetime}}</div>
@endforeach ()