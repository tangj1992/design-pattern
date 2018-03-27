<?php
/*
*装饰器模式
*
*现实生活示例
*想象一下，你在经营一家提供多种服务的汽车服务站。现在如何计算收费帐单呢？
*选择一项服务，并动态地向其添加价格，直到获得最终成本。这里每种类型的服务就是装饰器。
*
*概述
*通过将对象包装在装饰器类的对象中，装饰器模式可以在运行时动态地更改对象的行为。
*
*维基百科
*装饰器模式，是面向对象编程领域中，一种动态地或静态地往一个类中添加新行为
*而不影响相同类中其他对象的设计模式。装饰器模式对于遵守单一责任原则通常是有用的，
*因为它允许在具有独特领域的类之间划分功能。
*
*/

//程序示例

//我们以咖啡为例，首先我们通过咖啡接口实现一个简单咖啡
interface Coffee
{
	public function getCost();
	public function getDescription();
}
class SimpleCoffee implements Coffee
{
	public function getCost()
	{
		return 10;
	}
	public function getDescription()
	{
		return 'Simple coffe';
	}
}
//我们希望代码可扩展，以允许选项在需要时进行修改。 增加一些附加项（装饰器）
class MilkCoffee implements Coffee
{
	protected $coffee;

	public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }
    
	public function getCost()
	{
		return $this->coffee->getCost() + 2;
	}

	public function getDescription()
	{
		return $this->coffee->getDescription() . ',milk';
	}
}

class WhipCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 5;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', whip';
    }
}

class VanillaCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 3;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', vanilla';
    }
}
//使用
$someCoffee = new SimpleCoffee();
echo $someCoffee->getCost() . PHP_EOL; // 10
echo $someCoffee->getDescription() . PHP_EOL; // Simple Coffee

$someCoffee = new MilkCoffee($someCoffee);
echo $someCoffee->getCost() . PHP_EOL; // 12
echo $someCoffee->getDescription() . PHP_EOL; // Simple Coffee, milk 

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost() . PHP_EOL; // 17
echo $someCoffee->getDescription() . PHP_EOL; // Simple Coffee, milk, whip 

$someCoffee = new VanillaCoffee($someCoffee);
echo $someCoffee->getCost() . PHP_EOL; // 20
echo $someCoffee->getDescription() . PHP_EOL; // Simple Coffee, milk, whip, vanilla