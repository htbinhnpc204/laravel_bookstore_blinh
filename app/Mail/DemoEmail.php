<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $demo;

    public function __construct($demo)
    {
        //
        $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->demo->action == 'duyệt'){
            return $this->from('no-reply@htbinh.com')
                ->subject('Đơn hàng của bạn đã được duyệt')
                ->markdown('template.aprove_template');
        }
        elseif($this->demo->action == 'thanh toán'){
            return $this->from('no-reply@htbinh.com')
                ->subject('Đơn hàng của bạn đã được duyệt')
                ->markdown('template.thanhtoan');
        }
        return $this->from('no-reply@htbinh.com')
            ->subject('Đơn hàng của bạn đã được tạo')
            ->markdown('template.order_template');
    }
}
