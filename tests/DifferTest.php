<?php

use PHPUnit\Framework\TestCase;
    /**
    * @covers ::\Differ\Differ\genDiff()
    */
class DifferTest extends TestCase
{
    private function getPath($file)
    {
        return __DIR__ .  DIRECTORY_SEPARATOR .
                "fixtures" . DIRECTORY_SEPARATOR . $file;
    }
    public function testGendiffPlane()
    {
        $actual = \Differ\Differ\genDiff($this->getPath("plane_1.json"), $this->getPath("plane_2.json"));
        $expect = file_get_contents(realpath($this->getPath("plane_expected")));
        $this->assertEquals($expect, $actual);
    }
}