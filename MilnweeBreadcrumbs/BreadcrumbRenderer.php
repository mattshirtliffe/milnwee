<?php

namespace MilnweeBreadcrumbs;

class BreadcrumbRenderer {

	protected $_chunks = array();
	protected $_separator = null;
	protected $_ol_class = null;
	protected $_li_class = null;
	protected $_a_class = null;

	public function __construct($chunks) {
		$this->_chunks = $chunks;

		if (\Config::has('breadcrumbs.separator') && !empty(\Config::get('breadcrumbs.separator'))) {
			$this->_separator = \Config::get('breadcrumbs.separator');
		}
		if (\Config::has('breadcrumbs.ol_class') && !empty(\Config::get('breadcrumbs.ol_class'))) {
			$this->_ol_class = \Config::get('breadcrumbs.ol_class');
		} else {
			$this->_ol_class = 'breadcrumb';
		}
		if (\Config::has('breadcrumbs.li_class') && !empty(\Config::get('breadcrumbs.li_class'))) {
			$this->_li_class = \Config::get('breadcrumbs.li_class');
		} else {
			$this->_li_class = '';
		}
		if (\Config::has('breadcrumbs.a_class')) {
			$this->_a_class = \Config::get('breadcrumbs.a_class');
		}
	}

	public function toHtml() {
		$html = '';
		$html .= '<ol class="'.$this->_ol_class.'">';

		// check if theres a default back chunk set
		if (\Config::has('breadcrumbs.back')) {
			array_unshift($this->_chunks, \Config::get('breadcrumbs.back'));
		}

		$count = 1;
		foreach ($this->_chunks as $chunk) {
			if (empty($chunk[1])) {
				// no url, so just make it a list item
				$html .= '<li class="'.$this->_li_class.'">'.$chunk[0].'</li>';
			} else {
				// theres a url, so give it a link
				$html .= '<li class="'.$this->_li_class.'"><a href="'.route($chunk[1]).'">'.$chunk[0].'</a></li>';
			}
			$count++;

			if (!empty($this->_separator)) {
				if ($count <= count($this->_chunks)){
					$html .= $this->_separator;
				}
			}
		}
		$html .= '</ol>';
		return $html;
	}
}
