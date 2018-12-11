<?php

namespace Mini\Model;

use \Illuminate\Database\Eloquent\Model;

	class Movie extends Model {

		protected $table = 'movies';
		protected $primaryKey = 'id';
		protected $fillable = [
			'title',
			'director',
			'describe',
			'rate',
			'release_at',
		];

	}
