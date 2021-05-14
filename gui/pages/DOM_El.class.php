<?php

class DOM_El {

	private $text = "";
	private $html_tag = "";
	private $firstChild;
	private $nextSibbling;

	public function __construct($html_tag) { $this->html_tag = $html_tag; }

	public function setText(string $text) { $this->text = $text; return $this; }

	public function addChild(DOM_El &$el)    { if($this->firstChild) $this->firstChild->addSibbling($el); else $this->firstChild = $el; return $this; }
	public function addSibbling(DOM_El &$el) { $s = $this; while($s->nextSibbling) $s=$s->nextSibbling; $s->nextSibbling = $el; return $this; }

	public function generateCCode() {
		return "_(DOM_TAG_".strtoupper($this->html_tag).",0,0, \"{$this->text}\","
			.($this->firstChild?$this->firstChild->generateCCode():"NULL")
			.",".($this->nextSibbling?$this->nextSibbling->generateCCode():"NULL").")";
	}

	public function __toString() { return $this->generateCCode(); }
}

function h1($text) {
	return (new DOM_El("h1"))->setText($text);
}

function body(array $children) {
	$body = new DOM_El("body"); foreach($children as $child) $body->addChild($child); return $body;
}

