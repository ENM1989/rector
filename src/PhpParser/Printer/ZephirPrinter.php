<?php

declare(strict_types=1);

namespace Rector\PhpParser\Printer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Else_;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\While_;
use PhpParser\Node\Stmt\Foreach_;

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

    protected function pStmt_ElseIf(ElseIf_ $elseIf): string
    {
        return ' elseif ' . $this->p($elseIf->cond) . ' {' . $this->pStmts($elseIf->stmts) . '}';
    }

    protected function pStmt_Else(Else_ $else): string
    {
        return ' else {' . $this->pStmts($else->stmts) . '}';
    }

    protected function pStmt_While(While_ $while): string
    {
        return 'while ' . $this->p($while->cond) . ' {' . $this->pStmts($while->stmts) . '}';
    }

    protected function pStmt_Foreach(Foreach_ $foreach): string
    {
        $result = 'for ';
        if ($foreach->keyVar) {
            $result .= $this->p($foreach->keyVar) . ', ';
        }
        $result .= $this->p($foreach->valueVar) . ' in ' . $this->p($foreach->expr) . ' {';
        $result .= $this->pStmts($foreach->stmts);
        $result .= '}';
        return $result;
    }
}
