<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Middleware\TrustProxies;

class TestModel extends Model
{
    // specify model's table
    protected $table = 'products';

    // define table's primary key INFO (by default laravel uses: id int AUTOINCREMENT)
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // to ignore created_at, updated_at
    public $timestamps = false; 

    // define timestamps columns format
    protected $dateFormat = 'Y-m-d H:i:s';
    
    // to inform timestamps columns name
    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_atualizacao';

    // to specify connection
    protected $connection = 'mysql_new';


}
