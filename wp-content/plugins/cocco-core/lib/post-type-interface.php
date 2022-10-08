<?php

namespace CoccoCore\Lib;

/**
 * interface PostTypeInterface
 * @package CoccoCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}