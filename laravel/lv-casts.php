<?php 

class Home extends Model
{
    protected $casts = [
        'created_at' => 'datetime', // casted to Carbon instance, and can use Carbon methods
        'updated_at' => 'datetime',
    ];
    // or
        'created_at' => 'date:d/m/Y',  // casted to string, and can use string methods
}

// use in controller
$home = Home::first()->created_at->diffForHumans();
?>
