<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\AuditLog',
            'date_field' => 'created_at',
            // 'field'      => 'sale_price',
            // 'prefix'     => 'Order',
            // 'suffix'     => '',
            // 'route'      => 'admin.orders.show',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                // $crudFieldValue = $model->getAttributes()[$source['date_field']];

                // if (!$crudFieldValue) {
                //     continue;
                // }
                // $events[] = [
                //     // 'title' => trim($source['prefix'] . ' ' . changePrice($model->{$source['field']}) . ' ' . $source['suffix']),
                //     'start' => $crudFieldValue,
                //     // 'url'   => route($source['route'], $model->id),
                // ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
