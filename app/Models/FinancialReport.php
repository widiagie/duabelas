<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class FinancialReport extends Model
{
    use HasFactory;

    protected $table = 'financial_report';
    protected $primaryKey = 'fr_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $dates = ['fr_date'];

    /* timestamps */
	public $timestamps = false;
	const CREATED_AT = 'fr_created_at';
    const UPDATED_AT = 'fr_updated_at';

    protected $fillable = [
        'fr_type',
        'fr_item',
        'fr_date',
        'fr_balance',
        'fr_created_at',
        'fr_created_by',
        'fr_updated_at',
        'fr_updated_by',
    ];

    public function getFrDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
