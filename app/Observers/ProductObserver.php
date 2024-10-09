<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\User;
use App\Mail\NewProductNotification;
use Illuminate\Support\Facades\Mail;


class ProductObserver
{
    
    public function created(Product $product)
    {
        $users = User::all();
        foreach($users as $user)
        {
            Mail::to($user->eamil)->queue(new NewProductNotification($product));
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
