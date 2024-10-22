<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'property_name',
        'property_description',
        'property_address',
        'city',
        'state',
        'zipcode',
        'property_management_address',
        'property_management_city',
        'property_management_state',
        'property_management_zipcode',
        'property_type',
        'number_of_beds',
        'rent_bed',
        'bed_deposit',
        'bed_fee',
        'number_of_bedrooms',
        'stay_one_bedroom',
        'bedroom_deposit',
        'bedroom_fee',
        'number_of_bedrooms_house',
        'number_of_bath_house',
        'rent_unit',
        'unit_deposit',
        'unit_fee',
        'is_property_occupied',
        'main_picture',
        'more_pictures',
    ];
}
