<?php

namespace Zizhub\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductCode extends Eloquent {

    /**
     * The metrics table.
     *
     * @var string
     */
    protected $table = 'products';
    protected $guarded = ['created_at' , 'updated_at' , 'id' ];
    protected $fillable = ['id' , 'pname' , 'product_image' ];

    /**
     * The hasMany inventory items relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //public function couponRelation() {
    //    return $this->belongsTo( 'Zizpic\Admin\Models\Coupon' , 'copoun_id' , 'id' );
    //}
    //
    //public function orderRelation() {
    //    return $this->hasMany( 'Zizpic\Admin\Models\ZizpicOrder' , 'coupon' , 'id' );
    //}

}
