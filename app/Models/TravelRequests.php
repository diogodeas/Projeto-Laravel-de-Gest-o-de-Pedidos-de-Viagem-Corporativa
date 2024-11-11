<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelRequests extends Model
{
    use HasFactory;

    //add name, destination, start_date, return_date, status
    protected $fillable = ['applicant_name', 'destination', 'start_date', 'return_date', 'status'];
}
