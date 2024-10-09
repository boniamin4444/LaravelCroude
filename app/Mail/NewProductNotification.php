<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class NewProductNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $productImageUrl = asset('storage/'.$this->product->image);
        return $this->markdown('emails.products.newProduct')
                ->subject('New Product Added:'.$this->product->product_name)
                ->with([
                    'productName' =>$this->product->product_name,
                    'productImage'=> $productImageUrl,
                ]);
    }
}
