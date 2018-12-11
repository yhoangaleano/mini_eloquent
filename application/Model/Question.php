<?php

namespace Mini\Model;

use \Illuminate\Database\Eloquent\Model;
 
class Question extends Model {
     
    protected $table = 'questions';

    protected $fillable = ['question','user_id'];
     
}
 
?>