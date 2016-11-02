<?php

namespace Zizhub\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CouponCode extends BaseModel {

    /**
     * The metrics table.
     *
     * @var string
     */
    protected $table = 'zizhub_copoun_codes';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['id' , 'copoun_id' , 'code' ];

    /**
     * The hasMany inventory items relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couponRelation() {
        return $this->belongsTo( 'Zizhub\Admin\Models\Coupon' , 'copoun_id' , 'id' );
    }

    public function orderRelation() {
        return $this->hasMany( 'Zizhub\Admin\Models\ZizpicOrder' , 'coupon' , 'id' );
    }

}
