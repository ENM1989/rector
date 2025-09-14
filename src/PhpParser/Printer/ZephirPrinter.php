<?php

declare(strict_types=1);

namespace Rector\PhpParser\Printer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\If_;

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

    protected function pStmt_If(If_ $if): string
    {
        $result = 'if ' . $this->p($if->cond) . ' {' . $this->pStmts($if->stmts) . '}';

        if ($if->elseifs !== []) {
            $result .= $this->pImplode($if->elseifs);
        }

        if ($if->else !== null) {
            $result .= $this->p($if->else);
        }

        return $result;
    }
}
