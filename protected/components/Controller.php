<?php

class Controller extends CController
{
	// Layout
	public $layout = '//layouts/default';

	// Main menu
	public $menu = array();

	// Breadcrumb
	public $breadcrumbs = array();

	// Meta SEO
	public $pageDescription = '';
	public $pageKeywords = '';

	// CSS
	public $cssInclude = array();
	public $cssCode = '';

	//JS
	public $jsInclude = array();
	public $jqCode = '';
	public $jsCode = '';

	// Blocks flags
	public $showSideAuth = true;
	public $showIndexSNB = false;
	public $showSideJournal = true;
}