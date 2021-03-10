<?php

use PHPUnit\Framework\TestCase;

class DifferTest extends TestCase
{
     /**
     * @coversNothing
     */
    private function getPath($file)
    {
        return __DIR__ .  DIRECTORY_SEPARATOR
                       . "fixtures" . DIRECTORY_SEPARATOR . $file;
    }
     /**
     * @coversNothing
     */
    public function testGendiffJson()
    {
        $actual = \Differ\Differ\genDiff($this->getPath("file1.json"), $this->getPath("file2.json"));
        $expect = file_get_contents(realpath($this->getPath("json_expected")));
        $this->assertEquals($expect, $actual);
    }
     /**
     * @coversNothing
     */
    public function testGendiffYml()
    {
        $actual = \Differ\Differ\genDiff($this->getPath("file1.yml"), $this->getPath("file2.yml"));
        $expect = file_get_contents(realpath($this->getPath("yml_expected_yml")));
        $this->assertEquals($expect, $actual);
    }
     /**
     * @coversNothing
     */
    public function testGendiffTree()
    {
        $actual = \Differ\Differ\genDiff($this->getPath("tree_1.yml"), $this->getPath("tree_2.yml"));
        $expect = file_get_contents(realpath($this->getPath("tree_yml_expected")));
        $this->assertEquals($expect, $actual);
    }
     /**
     * @coversNothing
     */
    public function testGendiffPlain()
    {
        $actual = \Differ\Differ\genDiff($this->getPath("file1.json"), $this->getPath("file2.json"), 'plain');
        $expect = file_get_contents(realpath($this->getPath("plain_expexted")));
        $this->assertEquals($expect, $actual);
    }
}