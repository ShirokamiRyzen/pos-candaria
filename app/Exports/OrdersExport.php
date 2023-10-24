<?php

namespace App\Exports;

use App\Models\OrderItem;
use App\Models\User;
use Countable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrdersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
{

    use Exportable;
public function query()
    {
        return OrderItem::with('User');
    }
    //Heading
    public function headings() : array
    {
        return [
            'ID',
            'Produk',
            'Harga',
            'Jumlah',
            'ID Produk',
            'Dibuat Pada',
            'Kasir',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
            },
        ];
    }

    public function map($row): array
    {
        $orderItem = $row;
        $user = $orderItem->order->user;
        $product = $orderItem->product;
        


        return [
            $orderItem->id,
            $product->name,
            $orderItem->price,
            $orderItem->quantity,
            $orderItem->product_id,
            $orderItem->created_at,
            $user ? $user->name : '',
        ];
        

        return [];

    }
}
