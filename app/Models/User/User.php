<?php

namespace App\Models\User;

use App\Services\Card\CardService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'coins',
        'gems',
        'energy',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation with attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attributes(): HasOne
    {
        return $this->hasOne('App\Models\User\Attribute');
    }

    /**
     * Relation with items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Item\Item')->withPivot('active');
    }

    /**
     * @param CardService $cardService
     * @return float|int
     */
    public function getDamageAccordingCardsAttributes(CardService $cardService): int
    {
        return $cardService->getAttributesFromCards()['strength'] * 10;
    }
}
