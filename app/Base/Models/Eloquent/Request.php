<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;

    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leads_id',
        'clients_id',
        'specialists_id',
        'request_types_id',
        'request_status_id',
        'uuid',
    ];

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(RequestStatus::class, 'id', 'request_status_id');
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(RequestType::class, 'id', 'request_types_id');
    }

    /**
     * @return HasOne
     */
    public function lead(): HasOne
    {
        return $this->hasOne(Lead::class, 'id', 'leads_id');
    }

    /**
     * @return HasOne
     */
    public function detail(): HasOne
    {
        return $this->hasOne(RequestDetail::class, 'requests_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function specialist(): HasOne
    {
        return $this->hasOne(Specialist::class, 'id', 'specialists_id');
    }

    /**
     * @return HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'clients_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class, 'requests_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'requests_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(RequestStatusLog::class, 'requests_id', 'id');
    }
}
