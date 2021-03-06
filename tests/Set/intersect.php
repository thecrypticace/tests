<?php
namespace Ds\Tests\Set;

trait intersect
{
    public function intersectDataProvider()
    {
        // Values in A that are also in B.
        // A, B, expected result
        return [
            [[],                [],         []],
            [['a'],             ['b'],      []],
            [['a'],             ['a'],      ['a']],
            [['a', 'b', 'c'],   ['a', 'b'], ['a', 'b']],
            [['a', 'b', 'c'],   ['b', 'c'], ['b', 'c']],
            [['a', 'b', 'c'],   ['c', 'd'], ['c']],
        ];
    }

    /**
     * @dataProvider intersectDataProvider
     */
    public function testIntersect(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $b = $this->getInstance($values);

        $this->assertEquals($expected, $a->intersect($b)->toArray());
    }

    /**
     * @dataProvider intersectDataProvider
     */
    public function testIntersectWithSelf(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $this->assertEquals($initial, $a->intersect($a)->toArray());
    }

    public function testIntersectContains()
    {
        $setAB = $this->getInstance(["A", "B"]);
        $setBC = $this->getInstance(["B", "C"]);

        $setB = $setAB->intersect($setBC);

        $this->assertFalse($setB->contains("A"));
        $this->assertFalse($setB->contains("C"));
        $this->assertTrue($setB->contains("B"));
    }

    public function testIntersectAdd()
    {
        $setAB = $this->getInstance(["A", "B"]);
        $setBC = $this->getInstance(["B", "C"]);

        $setB = $setAB->intersect($setBC);
        $setB->add("B");

        $this->assertEquals($setB->toArray(), ["B"]);
    }

    // /**
    //  * @dataProvider intersectDataProvider
    //  */
    // public function testIntersectOperator(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $b = $this->getInstance($values);

    //     $this->assertEquals($expected, ($a & $b)->toArray());
    // }

    // /**
    //  * @dataProvider intersectDataProvider
    //  */
    // public function testIntersectOperatorAssign(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $b = $this->getInstance($values);

    //     $a &= $b;
    //     $this->assertEquals($expected, $a->toArray());
    // }

    // /**
    //  * @dataProvider intersectDataProvider
    //  */
    // public function testIntersectOperatorWithSelf(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $this->assertEquals($initial, ($a & $a)->toArray());
    // }

    // /**
    //  * @dataProvider intersectDataProvider
    //  */
    // public function testIntersectOperatorAssignWithSelf(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);

    //     $a &= $a;
    //     $this->assertEquals($initial, $a->toArray());
    // }
}
