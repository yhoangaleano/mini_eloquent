<?php

namespace Mini\Model;

use \Illuminate\Database\Eloquent\Model;
 
class Service extends Model {
     
    protected $table = 'tblServicio';

    protected $fillable = ['nombreServicio','estado'];

    protected $primaryKey = 'idServicio';
     
}
 
?>