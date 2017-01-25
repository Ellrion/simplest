<?php

const TEST_PATH = __DIR__ . '/tests';

echo "Start...\n";
foreach (glob(TEST_PATH . '/*_test.php') as $test) {
    passthru('php  -dzend.assertions=1 ' . $test);
}
echo "End testing\n";
