<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contract extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * Get the user associated with the contract.
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(
            User::class, 'contract_id', 'id'
        );
    }
}
