<?php

declare(strict_types=1);

namespace Rector\PhpParser\Printer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Variable;

final class ZephirPrinter extends BetterStandardPrinter
{
    protected function pExpr_Variable(Variable $variable): string
    {
        if ($variable->name instanceof Expr) {
            return '{' . $this->p($variable->name) . '}';
        }

        return (string) $variable->name;
    }

    protected function pExpr_Assign(Assign $assign, int $precedence, int $lhsPrecedence): string
    {
        return 'let ' . parent::pExpr_Assign($assign, $precedence, $lhsPrecedence);
    }
}
