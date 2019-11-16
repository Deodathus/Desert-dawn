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
     * Multiplier for damage from cards.
     */
    public const MULTIPLIER_FOR_DAMAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'exp',
        'level',
        'password',
        'coins',
        'gems',
        'energy',
        'skill_1',
        'skill_2',
        'skill_3',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
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
     * Relation with Attribute model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attributes(): HasOne
    {
        return $this->hasOne('App\Models\User\Attribute');
    }

    /**
     * Relation with Item model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Item\Item')->withPivot('active');
    }

    /**
     * Return damage with plus from cards.
     *
     * @param CardService $cardService
     * @return float|int
     */
    public function getDamageAccordingCardsAttributes(CardService $cardService): int
    {
        return $cardService->getAttributesFromCards()['strength'] * self::MULTIPLIER_FOR_DAMAGE;
    }
}
