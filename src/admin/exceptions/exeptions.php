<?php
class ReglaException extends Exception {}

class ValidacionException extends ReglaException {
    public function __construct(private array $errores) {
        parent::__construct(implode(' ', $errores));
    }
    public function getErrores(): array { return $this->errores; }
}