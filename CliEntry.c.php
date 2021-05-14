#include <stdio.h>
#include <stdlib.h>
#include <math.h> /* pow() */

typedef unsigned int uint;
struct DOM_EL;

struct DOM_EL {
	uint tagId;
	uint attr_keys;
	char* attr_values;
	#define ATTR_VALUE_SEP ','
	char *innerText;
	struct DOM_EL* firstChild;
	struct DOM_EL* nextSibbling;
};

typedef struct DOM_EL DOM_EL;

/*
*  1. HTML Tags
*
*/

<?php $tags = ["html","body","head","script","link","title","h1"]; ?>
<?php foreach($tags as $no => $tag) : ?>
#define DOM_TAG_<?=strtoupper($tag)?>   <?=($no+1)?> 
<?php endforeach; ?>

<?php $attrs = ["href","rel","src"]; ?>
<?php foreach($attrs as $no => $attr) : ?>
#define DOM_ATTR_<?=strtoupper($attr)?>   <?=pow(2,($no))?> 
<?php endforeach; ?>

/*
* 2. HTML Attribute Names 
*
*/
	
void _printHtmlTagName(int tagId) {
	if (0) {}
	else if (tagId == DOM_TAG_HTML)   { printf("html"); }
	else if (tagId == DOM_TAG_BODY)   { printf("body"); }
	else if (tagId == DOM_TAG_HEAD)   { printf("head"); }
	else if (tagId == DOM_TAG_SCRIPT) { printf("script"); }
	else if (tagId == DOM_TAG_LINK)   { printf("link"); }
	else if (tagId == DOM_TAG_TITLE)  { printf("title"); }
	else if (tagId == DOM_TAG_H1)     { printf("h1"); }

}
int _printAttrName(uint id) {
	
	printf(" ");

	if (0) {}
	else if (id == DOM_ATTR_HREF)  { printf("href"); }
	else if (id == DOM_ATTR_REL)   { printf("rel"); }
	else if (id == DOM_ATTR_SRC)   { printf("src"); }
	else return 0;
	
	printf("=\"");

	return 1;
}

int _printAttrValue(uint id, char *values) { 

	/* Fast-forward to the appropriate ID */
	for(;values[0] != '\0' && id != 0; values = &values[1])
		if (values[0] == ATTR_VALUE_SEP)
			id --;

	
	
	printf("%s", values);
	
	printf("\""); 
	
	return 1;
}


void printDomEl(DOM_EL* el) {
	// 1. Open tag
	if (el->tagId) {
		printf("<"); _printHtmlTagName(el->tagId);

		// 1.1 Check if there are any attributes
		if (el->attr_keys) {
			for (int i=0,j=0; i!=sizeof(el->attr_keys)*8; i++)
				if ( (el->attr_keys >> (i-1)) & 1)
					_printAttrName(pow(2,i-1)) && _printAttrValue(j++,el->attr_values);
		}
		printf(">");
	}

	// 2. Include the TEXT if any
	if (el->innerText) printf("%s", el->innerText);

	// 3. Include the children
	if (el->firstChild)
		printDomEl(el->firstChild);

	// 10. Close tag
	if (el->tagId) {
		printf("</"); _printHtmlTagName(el->tagId); printf(">");
	}

	// 15. Print next tag, if there is a sibbling
	if (el->nextSibbling)
		printDomEl(el->nextSibbling);
}
	

DOM_EL* _(uint tagId, uint attr_keys, char* attr_values, char* innerText, DOM_EL* firstChild, DOM_EL* nextSibbling) {
	DOM_EL* el = malloc(sizeof(DOM_EL));
	el->tagId = tagId;
	el->attr_keys = attr_keys;
	el->attr_values = attr_values;
	el->innerText = innerText;
	el->firstChild = firstChild;
	el->nextSibbling = nextSibbling;

	return el;
}

#include "httpResponse.c"
#include "gui/pages/mainPage.c"

int main() {
	
	httpResponse(385);
	mainPage();
	return 0;
}

/* vim:set syntax=c: */
