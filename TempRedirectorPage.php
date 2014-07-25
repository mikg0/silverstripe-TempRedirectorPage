<?php
/*
 * The MIT License (MIT)
 * 
 * Copyright (c) 2014 mikg0
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
*/

class TempRedirectorPage extends RedirectorPage {
	private static $db = array(
			"HTTPStatusCode" => "Int",
	);
	
	private static $defaults = array(
			"HTTPStatusCode" => 307
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab('Root.Main',
				array(
						new DropdownField(
								"HTTPStatusCode",
								'HTTP status code',
								array(
										307 => '307 Temporary Redirect',	// the default value is ignored, at least when the translatable
																			// module is used, so we put the default value first.
										301 => '301 Moved Permanently',
										302 => '302 Found',
										303 => '303 See Other',
										304 => '304 Not Modified',
										305 => '305 Use Proxy',
								),
								307
						)
				)
		);
	
		return $fields;
	}
	
}


class TempRedirectorPage_Controller extends RedirectorPage_Controller {

	public function init() {
		// I think it is acceptable to omit the call to parent::init() as all this should do is a redirect
		// if however you have special functions in your Page or other subclasses you might want to review this
		//parent::init();

		if($link = $this->redirectionLink()) {
			$this->redirect($link, $this->HTTPStatusCode);
			return;
		}
	}
}
