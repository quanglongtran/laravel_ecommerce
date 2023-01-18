<?php

namespace App\Repositories\Client\Coupon;

use App\Repositories\RepositoryInterface;
use App\Models\Coupon;
use Illuminate\Http\Request;

interface CouponRepositoryInterface extends RepositoryInterface
{
    public function apply(Request $request);
}
