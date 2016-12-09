<?php

use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class Product extends Eloquent{

    protected $collection = 'products';

}
