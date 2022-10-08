<?php

if ( cocco_twitter_feed_is_core_installed() ) {
	include_once 'lib/cocco-twitter-api.php';
	include_once 'widgets/load.php';

	//load shortcodes
	require_once 'lib/shortcode-interface.php';
	require_once 'shortcodes/shortcodes-functions.php';
}