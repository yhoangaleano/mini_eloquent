<?php

namespace Mini\Model;

use \Illuminate\Database\Eloquent\Model;

	class UserTest extends Model {

		protected $table = 'tblUsuario';
		protected $primaryKey = 'idUsuario';
		protected $fillable = [
			'usuario',
			'contrasena',
			'nombreCompleto',
			'correoElectronico',
			'estado',
			'rol',
		];

	}
