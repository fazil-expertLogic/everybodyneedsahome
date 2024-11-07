<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guests';
    protected $fillable = [
    'name',
    'ssn',
    'dob',
    'address',
    'address2',
    'city',
    'state',
    'zip',
    'phone',
    'email',
    'evicted',
    'eviction_property_name',
    'eviction_manager_name',
    'eviction_address',
    'eviction_phone',
    'eviction_date',
    'eviction_comments',
    'convicted',
    'conviction_year',
    'conviction_charge',
    'conviction_sentence',
    'sex_offender',
    'probation',
    'probation_officer_name',
    'probation_officer_phone',
    'probation_officer_email',
    'ref1_name',
    'ref1_phone',
    'ref1_email',
    'emergency_contact_name',
    'emergency_contact_phone',
    'emergency_contact_email',
    'employer_name',
    'employer_phone',
    'income',
    'expenses',
    'rental_budget',
    'user_id'
    ];
}
