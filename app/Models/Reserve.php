<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'reserve_date',
        'period', 'delivery_date', 'cost'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function getReserveDate()
    {
        return verta($this->reserve_date)->formatDate();
    }
    public function getDeliveryDate()
    {
        if ($this->delivery_date == null) {
            $deliveryDate = Carbon::parse($this->reserve_date)->addDays($this->period);
            if ($deliveryDate > Carbon::now())
                return $deliveryDate->diffInDays(Carbon::now(), CarbonInterface::DIFF_ABSOLUTE) . ' روز مانده';
            else
                return $deliveryDate->diffInDays(Carbon::now(), CarbonInterface::DIFF_ABSOLUTE) . ' روز گذشته';
        }

        return verta($this->reserve_date)->formatDate();
    }
    public function getPenalty()
    {
        if ($this->delivery_date == null) {
            $deliveryDate = Carbon::parse($this->reserve_date)->addDays($this->period);
            if ($deliveryDate < Carbon::now())
                return number_format($deliveryDate->diffInDays(Carbon::now(), CarbonInterface::DIFF_ABSOLUTE) * Config::first()->penalty_for_day, 0);
        }

        return number_format($this->cost, 0);
    }
}
