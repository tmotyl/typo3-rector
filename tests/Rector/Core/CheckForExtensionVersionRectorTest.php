<?php

namespace Ssch\TYPO3Rector\Tests\Rector\Core;

use Iterator;
use Ssch\TYPO3Rector\Tests\AbstractRectorWithConfigTestCase;

class CheckForExtensionVersionRectorTest extends AbstractRectorWithConfigTestCase
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
        yield [__DIR__ . '/Fixture/check_for_workspaces_instead_of_version.php.inc'];
    }
}