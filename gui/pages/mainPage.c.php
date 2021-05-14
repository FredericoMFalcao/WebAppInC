<?php require_once "DOM_El.class.php";

$output = body([
	h1("Hello world"),
	h1("Hello Mars")
]);

?>




void mainPage() {
	DOM_EL *body = <?=$output?>; 

	printDomEl(
		_(DOM_TAG_HTML, 0,0, "",
			_(DOM_TAG_HEAD,0,0, "",
				_(DOM_TAG_TITLE,0,0, "HELLO WORLD",0,
				_(DOM_TAG_LINK, 
					DOM_ATTR_HREF|DOM_ATTR_REL,
					"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css,stylesheet"
					,NULL,NULL,
				_(DOM_TAG_SCRIPT,
					DOM_ATTR_SRC,
					"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
					,NULL,NULL,NULL)
				))
			,body)
		,0)
		
	);
}
/* vim:set syntax=c: */
