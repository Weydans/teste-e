<?php

namespace Lib;

final class Flash
{
	public static function set( string $key, $value ) : void
	{
		self::startSession();

		$_SESSION[ $key ] = $value;
	}

	public static function get( string $key ) : mixed
	{
		self::startSession();

		if ( empty( $_SESSION[ $key ] ) ) {
			return null;
		}
		
		$value = $_SESSION[ $key ];

		unset( $_SESSION[ $key ] );

		return $value;
	}

	private static function startSession() : void
	{
		if( session_id() == '' 
			|| !isset($_SESSION) 
			|| session_status() === PHP_SESSION_NONE
		) {
			session_start();
		}		 
	}
}

