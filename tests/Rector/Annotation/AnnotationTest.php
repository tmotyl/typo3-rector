<?php

namespace Ssch\TYPO3Rector\Tests\Rector\Annotation;

use Iterator;
use Ssch\TYPO3Rector\Tests\AbstractRectorWithConfigTestCase;

class AnnotationTest extends AbstractRectorWithConfigTestCase
{
    /**
     * @dataProvider provideDataForTest()
     *
     * @param string $file
     */
    public function test(string $file): void
    {
        $this->doTestFile($file);
    }

    public function provideDataForTest(): Iterator
    {
        yield [__DIR__ . '/Fixture/inject.php.inc'];
        yield [__DIR__ . '/Fixture/cascade.php.inc'];
        yield [__DIR__ . '/Fixture/ignorevalidation.php.inc'];
        yield [__DIR__ . '/Fixture/lazy.php.inc'];
        yield [__DIR__ . '/Fixture/transient.php.inc'];
        yield [__DIR__ . '/Fixture/validate.php.inc'];
    }
}