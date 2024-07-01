<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetLog extends Model
{
    use HasFactory;

    protected $table = 'financial_budget_log';
    protected $primaryKey = 'bl_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'bl_date',
        'bl_amount',
        'bl_type',
        'bl_created_by',
        'bl_created_at',
        'bl_updated_by',
        'bl_updated_at',
    ];

    protected $casts = [
        'bl_type' => 'string',
    ];
}
