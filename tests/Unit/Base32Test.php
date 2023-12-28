<?php

namespace Mika\Base32\Test\Unit;

use Mika\Base32\Base32;
use PHPUnit\Framework\TestCase;

class Base32Test extends TestCase
{
    public function test_encode(): void
    {
        $stringExpectedMaps = [
            '' => '',
            'f' => 'MY======',
            'fo' => 'MZXQ====',
            'foo' => 'MZXW6===',
            'foob' => 'MZXW6YQ=',
            'fooba' => 'MZXW6YTB',
            'foobar' => 'MZXW6YTBOI======',
            'sure.' => 'ON2XEZJO',
            'sure' => 'ON2XEZI=',
            'sur' => 'ON2XE===',
            'su' => 'ON2Q====',
            'leasure.' => 'NRSWC43VOJSS4===',
            'easure.' => 'MVQXG5LSMUXA====',
            'asure.' => 'MFZXK4TFFY======',
        ];

        foreach ($stringExpectedMaps as $string => $expected) {
            $this->assertEquals($expected, Base32::encode($string));
        }
    }
}
