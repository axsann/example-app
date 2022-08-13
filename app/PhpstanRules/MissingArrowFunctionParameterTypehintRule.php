<?php

declare(strict_types=1);

namespace App\PhpStanRules;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrowFunction;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

use function is_string;
use function sprintf;

/**
 * @implements Rule<ArrowFunction>
 */
final class MissingArrowFunctionParameterTypehintRule implements Rule
{
    public function getNodeType(): string
    {
        return ArrowFunction::class;
    }

    /**
     * @return string[] errors
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $messages = [];

        foreach ($node->params as $index => $param) {
            if (null !== $param->type || ! $param->var instanceof Node\Expr\Variable || ! is_string($param->var->name)) {
                continue;
            }

            $messages[] = sprintf('Parameter #%d $%s of anonymous function has no typehint.', 1 + $index, $param->var->name);
        }

        return $messages;
    }
}
