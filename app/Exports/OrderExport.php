<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    private $items;

    public function __construct($items)
    {
        foreach ($items as $item) {
            $item->app_user_id = '№' . $item->app_user_id . ' ' . $item->app_user->fullname;
            // $item->app_user_id = Carbon::parse($item->created_at)->format("Y.m.d H:m:s");
        }
        $items->prepend(
            array(
                "0" => "id",
                "1" => "Buyurtmachi",
                "2" => "uyurtma turi",
                "3" => "manzil",
                "4" => "summa",
                "5" => "lat",
                "6" => "lon",
                "7" => "izoh",
                "8" => "status",
                "9" => "yaratilgan vaqti",
                "10" => "o'zgartirilgan vaqti"
            )
        );
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items;
    }
}
