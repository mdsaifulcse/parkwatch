<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';

    const FAQ='Faq';
    const TERMSCONDITION='Term_condition';
    const PRIVACYPOLICY='Privacy_Policy';
    const PARKINGBUDDYLAW='Parking_Buddy_Law';

    protected $table = 'faqs';
    protected $softDelete = true;
    protected $fillable = ['question','answer','status','type'];

}
