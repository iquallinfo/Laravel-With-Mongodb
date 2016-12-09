<?php

use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class User extends Eloquent{

    protected $collection = 'users';

}
