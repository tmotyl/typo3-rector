<?php

declare(strict_types=1);

namespace Ssch\TYPO3Rector\Rector\Extbase;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\RectorDefinition\CodeSample;
use Rector\Core\RectorDefinition\RectorDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * @see https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/9.5/Deprecation-85980-InternalAnnotationInExtbaseCommands.html
 */
final class RemoveInternalAnnotationRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (! $this->isObjectType($node, CommandController::class)) {
            return null;
        }

        /** @var PhpDocInfo|null $phpDocInfo */
        $phpDocInfo = $node->getAttribute(AttributeKey::PHP_DOC_INFO);
        if (null === $phpDocInfo) {
            return null;
        }

        $phpDocInfo->removeByName('internal');

        return $node;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition(
            'Remove @internal annotation from classes extending \TYPO3\CMS\Extbase\Mvc\Controller\CommandController',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
/**
 * @internal
 */
class MyCommandController extends CommandController
{
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
class MyCommandController extends CommandController
{
}
CODE_SAMPLE
                ),
            ]
        );
    }
}
