<?php

namespace App\Payroll;

class EmployeeProvider
{
    public function getPreview()
    {
        return [
            [
                'id' => 1,
                'image_url' => 'https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg',
                'display_name' => 'Ervinne Sodusta',
                'position' => 'Software Developer'
            ],
            [
                'id' => 2,
                'image_url' => 'https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg',
                'display_name' => 'Doris Sodusta',
                'position' => 'Bookkeeper'
            ]
        ];
    }
}
