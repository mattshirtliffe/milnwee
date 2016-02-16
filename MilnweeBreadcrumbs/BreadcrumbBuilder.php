<?php

namespace MilnweeBreadcrumbs;

use MilnweeBreadcrumbs\BreadcrumbRenderer;

class BreadcrumbBuilder {

	protected $_chunks = array();

	public function __construct() {
	}

	public function addChunk($chunk) {
		$this->_chunks[] = $chunk;

		return $this;
	}

	public function render() {
		$renderer = new BreadcrumbRenderer($this->_chunks);

		return $renderer->toHtml();
	}
}
