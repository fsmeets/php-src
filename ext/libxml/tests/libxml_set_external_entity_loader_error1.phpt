--TEST--
libxml_set_external_entity_loader() error: bad arguments
--SKIPIF--
<?php if (!extension_loaded('dom')) die('skip dom extension not available'); ?>
--FILE--
<?php
$xml = <<<XML
<!DOCTYPE foo PUBLIC "-//FOO/BAR" "http://example.com/foobar">
<foo>bar</foo>
XML;

$dd = new DOMDocument;
$r = $dd->loadXML($xml);

var_dump(libxml_set_external_entity_loader(function($a, $b, $c, $d) {}));
try {
	var_dump($dd->validate());
} catch (Throwable $e) {
	echo "Exception: " . $e->getMessage() . "\n";
}

echo "Done.\n";
--EXPECTF--
bool(true)

Warning: DOMDocument::validate(): Could not load the external subset "http://example.com/foobar" in %s on line %d
Exception: Too few arguments to function {closure}(), 3 passed and exactly 4 expected
Done.
