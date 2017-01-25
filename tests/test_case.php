<?php
//for php 7 run tests with directive ` php  -dzend.assertions=1 ...`

assert_options(ASSERT_ACTIVE, true);
assert_options(ASSERT_WARNING, false);
assert_options( ASSERT_CALLBACK, 'assert_failure');

function assert_failure($file, $line, $code, $message = null)
{
    echo "Assertion failed at $file:$line: $code";
    if ($message) {
        echo ": $message";
    }
    echo "\n";
}
