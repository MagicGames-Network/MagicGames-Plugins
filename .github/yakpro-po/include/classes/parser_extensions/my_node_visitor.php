<?php

use Exception;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Const_;
use PhpParser\Node\Scalar;
use PhpParser\Node\Stmt\Do_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\For_;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Case_;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Goto_;
use PhpParser\Node\Stmt\Label;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Trait_;
use PhpParser\Node\Stmt\UseUse;
use PhpParser\Node\Stmt\While_;
use PhpParser\Node\NullableType;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\Foreach_;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\Node\Stmt\TryCatch;
use PhpParser\Node\Stmt\Continue_;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\InlineHTML;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\VarLikeIdentifier;
use PhpParser\Node\Stmt\PropertyProperty;

//========================================================================
// Author: Pascal KISSIAN
// Resume: http://pascal.kissian.net
//
// Copyright (c) 2015-2021 Pascal KISSIAN
//
// Published under the MIT License
// Consider it as a proof of concept!
// No warranty of any kind.
// Use and abuse at your own risks.
//========================================================================

class MyNodeVisitor extends NodeVisitorAbstract // all parsing and replacement of scrambled names is done here!
{ // see PHP-Parser for documentation!
    private $t_loop_stack = [];
    private $t_node_stack = [];
    private $current_class_name = null;
    private $is_in_class_const_definition = false;

    private function shuffle_stmts(Node &$node)
    {
        global $conf;
        if ($conf->shuffle_stmts) {
            if (isset($node->stmts)) {
                $stmts = $node->stmts;
                $chunk_size = shuffle_get_chunk_size($stmts);
                if ($chunk_size <= 0) return false; // should never occur!

                if (count($stmts) > (2 * $chunk_size)) {
                    // $last_inst = array_pop($stmts);
                    $stmts = shuffle_statements($stmts);
                    // $stmts[] = $last_inst;
                    $node->stmts = $stmts;
                    return true;
                }
            }
        }
        return false;
    }

    private function get_identifier_name(Node $node)
    {
        if ($node instanceof Identifier || $node instanceof VarLikeIdentifier) return $node->name;
        return '';
    }

    private function set_identifier_name(Node &$node, $name)
    {
        if ($node instanceof Identifier || $node instanceof VarLikeIdentifier) {
            $node->name = $name;
        }
    }

    public function enterNode(Node $node)
    {
        global $conf;
        global $t_scrambler;

        if (count($this->t_node_stack)) {
            $node->setAttribute('parent', $this->t_node_stack[count($this->t_node_stack) - 1]);
        }
        $this->t_node_stack[] = $node;

        if ($conf->obfuscate_loop_statement) { // loop statements are replaced by goto ...
            $scrambler = $t_scrambler['label'];
            if (($node instanceof For_) || ($node instanceof Foreach_) || ($node instanceof Switch_)
                || ($node instanceof While_) || ($node instanceof Do_)
            ) {
                $label_loop_break_name = $scrambler->scramble($scrambler->generate_label_name());
                $label_loop_continue_name = $scrambler->scramble($scrambler->generate_label_name());
                $this->t_loop_stack[] = [$label_loop_break_name, $label_loop_continue_name];
            }
        }
        if (($node instanceof Class_) && ($node->name != null)) {
            $name = $this->get_identifier_name($node->name);
            if (is_string($name) && (strlen($name) !== 0)) {
                $this->current_class_name = $name;
            }
        }
        if ($node instanceof ClassConst) {
            $this->is_in_class_const_definition = true;
        }
    }

    public function leaveNode(Node $node)
    {
        global $conf;
        global $t_scrambler;
        global $debug_mode;

        $node_modified = false;

        if ($node instanceof Class_) $this->current_class_name = null;
        if ($node instanceof ClassConst) $this->is_in_class_const_definition = false;

        if ($conf->obfuscate_string_literal) {
            if ($node instanceof InlineHTML) {
                $node = new Echo_([new Scalar\String_($node->value)]);
                $node_modified = true;
            }
        }

        if ($conf->obfuscate_variable_name) {
            $scrambler = $t_scrambler['variable'];
            if ($node instanceof Expr\Variable) {
                $name = $node->name;
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $node->name = $r;
                        $node_modified = true;
                    }
                }
            }
            if (($node instanceof Catch_) || ($node instanceof Expr\ClosureUse) || ($node instanceof Param)) {
                $name = $node->{'var'}; // equivalent to $node->var, that works also on my php version!
                if (is_string($name) && (strlen($name) !== 0)) { // but 'var' is a reserved function name, so there is no warranty
                    // that it will work in the future, so the $node->{'var'} form
                    $r = $scrambler->scramble($name); // has been used!
                    if ($r !== $name) {
                        $node->{'var'} = $r;
                        $node_modified = true;
                    }
                }
            }
        }

        if ($conf->obfuscate_function_name) {
            $scrambler = $t_scrambler['function_or_class'];
            if ($node instanceof Function_) {
                $name = $node->name->name;
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $node->name = $r;
                        $node_modified = true;
                    }
                }
            }
            if ($node instanceof Expr\FuncCall) {
                if (isset($node->name->parts)) { // not set when indirect call (i.e.function name is a variable value!)
                    $parts = $node->name->parts;
                    $name = $parts[count($parts) - 1];
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            $node->name->parts[count($parts) - 1] = $r;
                            $node_modified = true;
                        }
                    }
                }
            }
            if ($node instanceof Expr\FuncCall) { // processing function_exists('function_name');
                if (isset($node->name->parts)) { // not set when indirect call (i.e.function name is a variable value!)
                    $parts = $node->name->parts;
                    $name = $parts[count($parts) - 1];
                    if (is_string($name) && ($name == 'function_exists')) {
                        for ($ok = false;;) {
                            if (!isset($node->args[0]->value)) break;
                            if (count($node->args) != 1) break;
                            $arg = $node->args[0]->value;
                            if (!($arg instanceof Scalar\String_)) {
                                $ok = true;
                                $warning = true;
                                break;
                            }
                            $name = $arg->value;
                            if (!is_string($name) || (strlen($name) == 0)) break;
                            $ok = true;
                            $warning = false;
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $arg->value = $r;
                                $node_modified = true;
                            }
                            break;
                        }
                        if (!$ok) {
                            throw new Exception("Error: your use of function_exists() function is not compatible with yakpro-po!" . PHP_EOL . "\tOnly 1 literal string parameter is allowed...");
                        }
                        if ($warning) fprintf(STDERR, "Warning: your use of function_exists() function is not compatible with yakpro-po!" . PHP_EOL . "\t Only 1 literal string parameter is allowed..." . PHP_EOL);
                    }
                }
            }
        }

        if ($conf->obfuscate_class_name) {
            $scrambler = $t_scrambler['function_or_class'];
            if ($node instanceof Class_) {
                if ($node->name != null) {
                    $name = $this->get_identifier_name($node->name);
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            $this->set_identifier_name($node->name, $r);
                            $node_modified = true;
                        }
                    }
                }
                if (isset($node->{'extends'})) {
                    $parts = $node->{'extends'}->parts;
                    $name = $parts[count($parts) - 1];
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            $node->{'extends'}->parts[count($parts) - 1] = $r;
                            $node_modified = true;
                        }
                    }
                }
            }
            if (($node instanceof Expr\New_)
                || ($node instanceof Expr\StaticCall)
                || ($node instanceof Expr\StaticPropertyFetch)
                || ($node instanceof Expr\ClassConstFetch)
                || ($node instanceof Expr\Instanceof_)
            ) {
                if (isset($node->{'class'}->parts)) {
                    $parts = $node->{'class'}->parts;
                    $name = $parts[count($parts) - 1];
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            $node->{'class'}->parts[count($parts) - 1] = $r;
                            $node_modified = true;
                        }
                    }
                }
            }
            if ($node instanceof Param) {
                if (isset($node->type) && isset($node->type->parts)) {
                    $parts = $node->type->parts;
                    $name = $parts[count($parts) - 1];
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            $node->type->parts[count($parts) - 1] = $r;
                            $node_modified = true;
                        }
                    }
                }
            }
            if ($node instanceof ClassMethod || $node instanceof Function_) {
                if (isset($node->returnType)) {
                    $node_tmp = $node->returnType;
                    if ($node_tmp instanceof NullableType && isset($node_tmp->type)) {
                        $node_tmp = $node_tmp->type;
                    }
                    if ($node_tmp instanceof Name && isset($node_tmp->parts)) {
                        $parts = $node_tmp->parts;
                        $name = $parts[count($parts) - 1];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node_tmp->parts[count($parts) - 1] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            if ($node instanceof Catch_) {
                if (isset($node->types)) {
                    $types = $node->types;
                    foreach ($types as &$type) {
                        $parts = $type->parts;
                        $name = $parts[count($parts) - 1];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $type->parts[count($parts) - 1] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
        }

        if ($conf->obfuscate_interface_name) {
            $scrambler = $t_scrambler['function_or_class'];
            if ($node instanceof Interface_) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
                if (isset($node->{'extends'}) && count($node->{'extends'})) {
                    for ($j = 0; $j < count($node->{'extends'}); ++$j) {
                        $parts = $node->{'extends'}[$j]->parts;
                        $name = $parts[count($parts) - 1];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->{'extends'}[$j]->parts[count($parts) - 1] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            if ($node instanceof Class_) {
                if (isset($node->{'implements'}) && count($node->{'implements'})) {
                    for ($j = 0; $j < count($node->{'implements'}); ++$j) {
                        $parts = $node->{'implements'}[$j]->parts;
                        $name = $parts[count($parts) - 1];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->{'implements'}[$j]->parts[count($parts) - 1] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
        }

        if ($conf->obfuscate_trait_name) {
            $scrambler = $t_scrambler['function_or_class'];
            if ($node instanceof Trait_) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
            if ($node instanceof TraitUse) {
                if (isset($node->{'traits'}) && count($node->{'traits'})) {
                    for ($j = 0; $j < count($node->{'traits'}); ++$j) {
                        $parts = $node->{'traits'}[$j]->parts;
                        $name = $parts[count($parts) - 1];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->{'traits'}[$j]->parts[count($parts) - 1] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
        }

        if ($conf->obfuscate_property_name) {
            $scrambler = $t_scrambler['property'];
            if (($node instanceof Expr\PropertyFetch) || ($node instanceof PropertyProperty) || ($node instanceof Expr\StaticPropertyFetch)) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
        }

        if ($conf->obfuscate_method_name) {
            $scrambler = $t_scrambler['method'];
            if (($node instanceof ClassMethod) || ($node instanceof Expr\MethodCall) || ($node instanceof Expr\StaticCall)) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
        }

        if ($conf->obfuscate_constant_name) {
            $scrambler = $t_scrambler['constant'];
            if ($node instanceof Expr\FuncCall) { // processing define('constant_name',value);
                if (isset($node->name->parts)) { // not set when indirect call (i.e.function name is a variable value!)
                    $parts = $node->name->parts;
                    $fn_name = $parts[count($parts) - 1];
                    if (is_string($fn_name) && (($fn_name == 'define') || ($fn_name == 'defined'))) {
                        for ($ok = false;;) {
                            if (!isset($node->args[0]->value)) break;
                            if (($fn_name == 'define') && (count($node->args) != 2)) break;
                            $arg = $node->args[0]->value;
                            if (!($arg instanceof Scalar\String_)) break;
                            $name = $arg->value;
                            if (!is_string($name) || (strlen($name) == 0)) break;
                            $ok = true;
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $arg->value = $r;
                                $node_modified = true;
                            }
                            break;
                        }
                        if (!$ok) {
                            if ($fn_name == 'define') throw new Exception("Error: your use of $fn_name() function is not compatible with yakpro-po!" . PHP_EOL . "\tOnly 2 parameters, when first is a literal string is allowed...");
                            else throw new Exception("Error: your use of $fn_name() function is not compatible with yakpro-po!" . PHP_EOL . "\tOnly 1 literal string parameter is allowed...");
                        }
                    }
                }
            }
            if ($node instanceof Expr\ConstFetch) {
                $parts = $node->name->parts;
                $name = $parts[count($parts) - 1];
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $node->name->parts[count($parts) - 1] = $r;
                        $node_modified = true;
                    }
                }
            }
            if (($node instanceof Const_) && !$this->is_in_class_const_definition) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
        }

        if ($conf->obfuscate_class_constant_name) {
            $scrambler = $t_scrambler['class_constant'];
            if (($node instanceof Const_) && $this->is_in_class_const_definition) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
            if ($node instanceof Expr\ClassConstFetch) {
                $name = $node->name;
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $this->set_identifier_name($node->name, $r);
                        $node_modified = true;
                    }
                }
            }
        }

        if ($node instanceof UseUse) {
            if ($conf->obfuscate_function_name || $conf->obfuscate_class_name) {
                if (isset($node->alias)) {
                    if (!$conf->obfuscate_function_name || !$conf->obfuscate_class_name) {
                        fprintf(STDERR, "Warning:[use alias] cannot determine at compile time if it is a function or a class alias" . PHP_EOL . "\tyou must obfuscate both functions and classes or none..." . PHP_EOL . "\tObfuscated code may not work!" . PHP_EOL);
                    }
                    $scrambler = $t_scrambler['function_or_class'];
                    $name = $this->get_identifier_name($node->alias);
                    if (is_string($name) && (strlen($name) !== 0)) {
                        $r = $scrambler->scramble($name);
                        if ($r !== $name) {
                            //$node->alias = $r;
                            $this->set_identifier_name($node->alias, $r);
                            $node_modified = true;
                        }
                    }
                }
            }
        }


        if ($conf->obfuscate_namespace_name) {
            $scrambler = $t_scrambler['function_or_class'];
            if (($node instanceof Namespace_) || ($node instanceof UseUse)) {
                if (isset($node->name->parts)) {
                    $parts = $node->name->parts;
                    for ($i = 0; $i < count($parts); ++$i) {
                        $name = $parts[$i];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->name->parts[$i] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            /* 
 if ($node instanceof UseUse) {
 //$name = $node->alias;
 $name = $this->get_identifier_name($node->alias);
 if ( is_string($name) && (strlen($name) !== 0) ) {
 $r = $scrambler->scramble($name);
 if ($r!==$name) {
 //$node->alias = $r;
 $this->set_identifier_name($node->alias,$r);
 $node_modified = true;
 }
 }
 }
 */
            if (($node instanceof Expr\FuncCall) || ($node instanceof Expr\ConstFetch)) {
                if (isset($node->name->parts)) { // not set when indirect call (i.e.function name is a variable value!)
                    $parts = $node->name->parts;
                    for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                        $name = $parts[$i];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->name->parts[$i] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            if (($node instanceof Expr\New_)
                || ($node instanceof Expr\Instanceof_)
                || ($node instanceof Expr\StaticCall)
                || ($node instanceof Expr\StaticPropertyFetch)
                || ($node instanceof Expr\ClassConstFetch)
            ) {
                if (isset($node->{'class'}->parts)) { // not set when indirect call (i.e.function name is a variable value!)
                    $parts = $node->{'class'}->parts;
                    for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                        $name = $parts[$i];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->{'class'}->parts[$i] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            if ($node instanceof Class_) {
                if (isset($node->{'extends'}) && isset($node->{'extends'}->parts)) {
                    $parts = $node->{'extends'}->parts;
                    for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                        $name = $parts[$i];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->{'extends'}->parts[$i] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
                if (isset($node->{'implements'}) && count($node->{'implements'})) {
                    for ($j = 0; $j < count($node->{'implements'}); ++$j) {
                        $parts = $node->{'implements'}[$j]->parts;
                        for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                            $name = $parts[$i];
                            if (is_string($name) && (strlen($name) !== 0)) {
                                $r = $scrambler->scramble($name);
                                if ($r !== $name) {
                                    $node->{'implements'}[$j]->parts[$i] = $r;
                                    $node_modified = true;
                                }
                            }
                        }
                    }
                }
            }
            if ($node instanceof Param) {
                if (isset($node->type) && isset($node->type->parts)) {
                    $parts = $node->type->parts;
                    for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                        $name = $parts[$i];
                        if (is_string($name) && (strlen($name) !== 0)) {
                            $r = $scrambler->scramble($name);
                            if ($r !== $name) {
                                $node->type->parts[$i] = $r;
                                $node_modified = true;
                            }
                        }
                    }
                }
            }
            if ($node instanceof Interface_) {
                if (isset($node->{'extends'}) && isset($node->{'extends'}->parts)) {
                    for ($j = 0; $j < count($node->{'extends'}); ++$j) {
                        $parts = $node->{'extends'}[$j]->parts;
                        for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                            $name = $parts[$i];
                            if (is_string($name) && (strlen($name) !== 0)) {
                                $r = $scrambler->scramble($name);
                                if ($r !== $name) {
                                    $node->{'extends'}[$j]->parts[$i] = $r;
                                    $node_modified = true;
                                }
                            }
                        }
                    }
                }
            }
            if ($node instanceof TraitUse) {
                if (isset($node->{'traits'}) && count($node->{'traits'})) {
                    for ($j = 0; $j < count($node->{'traits'}); ++$j) {
                        $parts = $node->{'traits'}[$j]->parts;
                        for ($i = 0; $i < count($parts) - 1; ++$i) { // skip last part, that is processed in his own section
                            $name = $parts[$i];
                            if (is_string($name) && (strlen($name) !== 0)) {
                                $r = $scrambler->scramble($name);
                                if ($r !== $name) {
                                    $node->{'traits'}[$j]->parts[$i] = $r;
                                    $node_modified = true;
                                }
                            }
                        }
                    }
                }
            }
            if ($node instanceof Catch_) {
                if (isset($node->types)) {
                    $types = $node->types;
                    foreach ($types as &$type) {
                        $parts = $type->parts;
                        for ($i = 0; $i < count($parts) - 1; ++$i) {
                            $name = $parts[$i];
                            if (is_string($name) && (strlen($name) !== 0)) {
                                $r = $scrambler->scramble($name);
                                if ($r !== $name) {
                                    $type->parts[$i] = $r;
                                    $node_modified = true;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($conf->obfuscate_label_name) { // label: goto label; -
            $scrambler = $t_scrambler['label'];
            if (($node instanceof Label) || ($node instanceof Goto_)) {
                $name = $this->get_identifier_name($node->name);
                if (is_string($name) && (strlen($name) !== 0)) {
                    $r = $scrambler->scramble($name);
                    if ($r !== $name) {
                        $node->name = $r;
                        $node_modified = true;
                    }
                }
            }
        }

        if ($conf->obfuscate_if_statement) { // if else elseif are replaced by goto ...
            $scrambler = $t_scrambler['label'];
            $ok_to_scramble = false;
            if (($node instanceof If_)) { // except if function_exists is ther...
                $ok_to_scramble = true;
                $condition = $node->cond;
                if ($condition instanceof Expr\BooleanNot) {
                    $expr = $condition->expr;
                    if ($expr instanceof Expr\FuncCall) {
                        $name = $expr->name;
                        if ($name instanceof Name) {
                            $parts = $name->parts;
                            $part = $parts[0];
                            if ($part == 'function_exists') {
                                $ok_to_scramble = false;
                            }
                        }
                    }
                }
            }
            if ($ok_to_scramble) {
                $condition = $node->cond;
                $stmts = $node->stmts;
                $else = isset($node->{'else'}) ? $node->{'else'}->stmts : null;
                $elseif = $node->elseifs;

                if (isset($elseif) && count($elseif)) { // elseif mode
                    $label_endif_name = $scrambler->scramble($scrambler->generate_label_name());
                    $label_endif = [new Label($label_endif_name)];
                    $goto_endif = [new Goto_($label_endif_name)];

                    $new_nodes_1 = [];
                    $new_nodes_2 = [];
                    $label_if_name = $scrambler->scramble($scrambler->generate_label_name());
                    $label_if = [new Label($label_if_name)];
                    $goto_if = [new Goto_($label_if_name)];
                    $if = new If_($condition);
                    $if->stmts = $goto_if;
                    $new_nodes_1 = array_merge($new_nodes_1, [$if]);
                    $new_nodes_2 = array_merge($new_nodes_2, $label_if, $stmts, $goto_endif);

                    for ($i = 0; $i < count($elseif); ++$i) {
                        $condition = $elseif[$i]->cond;
                        $stmts = $elseif[$i]->stmts;
                        $label_if_name = $scrambler->scramble($scrambler->generate_label_name());
                        $label_if = [new Label($label_if_name)];
                        $goto_if = [new Goto_($label_if_name)];
                        $if = new If_($condition);
                        $if->stmts = $goto_if;
                        $new_nodes_1 = array_merge($new_nodes_1, [$if]);
                        $new_nodes_2 = array_merge($new_nodes_2, $label_if, $stmts);
                        if ($i < count($elseif) - 1) {
                            $new_nodes_2 = array_merge($new_nodes_2, $goto_endif);
                        }
                    }
                    if (isset($else)) {
                        $new_nodes_1 = array_merge($new_nodes_1, $else);
                    }
                    $new_nodes_1 = array_merge($new_nodes_1, $goto_endif);
                    $new_nodes_2 = array_merge($new_nodes_2, $label_endif);
                    return array_merge($new_nodes_1, $new_nodes_2);
                } else { // no elseif : if , else
                    if (isset($else)) { // else statement found
                        $label_then_name = $scrambler->scramble($scrambler->generate_label_name());
                        $label_then = [new Label($label_then_name)];
                        $goto_then = [new Goto_($label_then_name)];
                        $label_endif_name = $scrambler->scramble($scrambler->generate_label_name());
                        $label_endif = [new Label($label_endif_name)];
                        $goto_endif = [new Goto_($label_endif_name)];
                        $node->stmts = $goto_then;
                        $node->{'else'} = null;
                        return array_merge([$node], $else, $goto_endif, $label_then, $stmts, $label_endif);
                    } else { // no else statement found
                        if ($condition instanceof Expr\BooleanNot) { // avoid !! in generated code
                            $new_condition = $condition->expr;
                        } else {
                            $new_condition = new Expr\BooleanNot($condition);
                        }
                        $label_endif_name = $scrambler->scramble($scrambler->generate_label_name());
                        $label_endif = [new Label($label_endif_name)];
                        $goto_endif = [new Goto_($label_endif_name)];
                        $node->cond = $new_condition;
                        $node->stmts = $goto_endif;
                        return array_merge([$node], $stmts, $label_endif);
                    }
                }
            }
        }

        if ($conf->obfuscate_loop_statement) { // for while do while are replaced by goto ...
            $scrambler = $t_scrambler['label'];
            if ($node instanceof For_) {
                list($label_loop_break_name, $label_loop_continue_name) = array_pop($this->t_loop_stack);

                //$init = $node->init;
                $init = null;
                if ((isset($node->init) && count($node->init))) foreach ($node->init as $tmp) $init[] = new Expression($tmp);

                $condition = (isset($node->cond) && count($node->cond)) ? $node->cond[0] : null;

                //$loop = $node->loop;
                $loop = null;
                if ((isset($node->loop) && count($node->loop))) foreach ($node->loop as $tmp) $loop[] = new Expression($tmp);

                $stmts = $node->stmts;
                $label_loop_name = $scrambler->scramble($scrambler->generate_label_name());
                $label_loop = [new Label($label_loop_name)];
                $goto_loop = [new Goto_($label_loop_name)];
                $label_break = [new Label($label_loop_break_name)];
                $goto_break = [new Goto_($label_loop_break_name)];
                $label_continue = [new Label($label_loop_continue_name)];
                $goto_continue = [new Goto_($label_loop_continue_name)];

                $new_node = [];
                if (isset($init)) {
                    $new_node = array_merge($new_node, $init);
                }
                $new_node = array_merge($new_node, $label_loop);
                if (isset($condition)) {
                    if ($condition instanceof Expr\BooleanNot) { // avoid !! in generated code
                        $new_condition = $condition->expr;
                    } else {
                        $new_condition = new Expr\BooleanNot($condition);
                    }
                    $if = new If_($new_condition);
                    $if->stmts = $goto_break;
                    $new_node = array_merge($new_node, [$if]);
                }
                if (isset($stmts)) {
                    $new_node = array_merge($new_node, $stmts);
                }
                $new_node = array_merge($new_node, $label_continue);
                if (isset($loop)) {
                    $new_node = array_merge($new_node, $loop);
                }
                $new_node = array_merge($new_node, $goto_loop);
                $new_node = array_merge($new_node, $label_break);
                return $new_node;
            }

            if ($node instanceof Foreach_) {
                list($label_loop_break_name, $label_loop_continue_name) = array_pop($this->t_loop_stack);

                $label_break = [new Label($label_loop_break_name)];
                $node->stmts[] = new Label($label_loop_continue_name);
                $this->shuffle_stmts($node);
                return array_merge([$node], $label_break);
            }

            if ($node instanceof Switch_) {
                list($label_loop_break_name, $label_loop_continue_name) = array_pop($this->t_loop_stack);

                $label_break = [new Label($label_loop_break_name)];
                $label_continue = [new Label($label_loop_continue_name)];
                return array_merge([$node], $label_continue, $label_break);
            }

            if ($node instanceof While_) {
                list($label_loop_break_name, $label_loop_continue_name) = array_pop($this->t_loop_stack);

                $condition = $node->cond;
                $stmts = $node->stmts;
                $label_break = [new Label($label_loop_break_name)];
                $goto_break = [new Goto_($label_loop_break_name)];
                $label_continue = [new Label($label_loop_continue_name)];
                $goto_continue = [new Goto_($label_loop_continue_name)];
                if ($condition instanceof Expr\BooleanNot) { // avoid !! in generated code
                    $new_condition = $condition->expr;
                } else {
                    $new_condition = new Expr\BooleanNot($condition);
                }
                $if = new If_($new_condition);
                $if->stmts = $goto_break;
                return array_merge($label_continue, [$if], $stmts, $goto_continue, $label_break);
            }

            if ($node instanceof Do_) {
                list($label_loop_break_name, $label_loop_continue_name) = array_pop($this->t_loop_stack);

                $condition = $node->cond;
                $stmts = $node->stmts;
                $label_break = [new Label($label_loop_break_name)];
                $label_continue = [new Label($label_loop_continue_name)];
                $goto_continue = [new Goto_($label_loop_continue_name)];
                $if = new If_($condition);
                $if->stmts = $goto_continue;
                return array_merge($label_continue, $stmts, [$if], $label_break);
            }

            if ($node instanceof Break_) {
                $n = 1;
                if (isset($node->num)) {
                    if ($node->num instanceof Scalar\LNumber) {
                        $n = $node->num->value;
                    } else {
                        throw new Exception("Error: your use of break statement is not compatible with yakpro-po!" . PHP_EOL . "\tAt max 1 literal numeric parameter is allowed...");
                    }
                }
                if (count($this->t_loop_stack) - $n < 0) {
                    throw new Exception("Error: break statement outside loop found!;" . PHP_EOL . (($debug_mode == 2) ? print_r($node, true) : ''));
                }
                list($label_loop_break_name, $label_loop_continue_name) = $this->t_loop_stack[count($this->t_loop_stack) - $n];
                $node = new Goto_($label_loop_break_name);
                $node_modified = true;
            }
            if ($node instanceof Continue_) {
                $n = 1;
                if (isset($node->num)) {
                    if ($node->num instanceof Scalar\LNumber) {
                        $n = $node->num->value;
                    } else {
                        throw new Exception("Error: your use of continue statement is not compatible with yakpro-po!" . PHP_EOL . "\tAt max 1 literal numeric parameter is allowed...");
                    }
                }
                if (count($this->t_loop_stack) - $n < 0) {
                    throw new Exception("Error: continue statement outside loop found!;" . PHP_EOL . (($debug_mode == 2) ? print_r($node, true) : ''));
                }
                list($label_loop_break_name, $label_loop_continue_name) = $this->t_loop_stack[count($this->t_loop_stack) - $n];
                $node = new Goto_($label_loop_continue_name);
                $node_modified = true;
            }
        }

        if ($conf->shuffle_stmts) {
            if (($node instanceof Function_)
                || ($node instanceof Expr\Closure)
                || ($node instanceof ClassMethod)
                || ($node instanceof Foreach_) // occurs when $conf->obfuscate_loop_statement is set to false
                || ($node instanceof If_) // occurs when $conf->obfuscate_loop_statement is set to false
                || ($node instanceof TryCatch)
                || ($node instanceof Catch_)
                || ($node instanceof Case_)
                //|| ($node instanceof Namespace_)
            ) {
                if ($this->shuffle_stmts($node)) $node_modified = true;
            }

            if (($node instanceof If_)) { // occurs when $conf->obfuscate_if_statement is set to false
                if (isset($node->{'else'})) {
                    if ($this->shuffle_stmts($node->{'else'})) $node_modified = true;
                }

                $elseif = $node->elseifs;
                if (isset($elseif) && count($elseif)) { // elseif mode
                    for ($i = 0; $i < count($elseif); ++$i) {
                        if ($this->shuffle_stmts($elseif[$i])) $node_modified = true;
                    }
                }
            }
        }
        array_pop($this->t_node_stack);
        if ($node_modified) return $node;
    }
}
