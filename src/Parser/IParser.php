<?php

namespace BlackFramework\Routing\Parser;

interface IParser
{
    public function parse();

    public function getContainer();
}