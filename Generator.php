<?php
/*
*生成器模式
*
*现实生活示例
*想象一下你在 Hardee’s 餐厅点了某个套餐，比如「大 Hardee 套餐」，
*然后工作人员会正常出餐，这是简单工厂模式。
*但是在很多情况下，创建逻辑可能涉及到更多步骤。
*比如，你想要一个定制的 Subway 套餐，对于你的汉堡如何制作有几个选项可供选择，
*比如你想要什么类型的酱汁？你想要什么奶酪？ 
*在这种情况下，生成器模式便可以派上用场。
*
*概述
*允许创建不同风格的对象，同时避免构造器污染。
*当创建多种风格的对象时或者创建对象时涉及很多步骤，可以使用生成器模式。

*维基百科
*生成器模式是一种对象创建软件设计模式，其目的是找到重叠构造器反面模式的解决方案。
*
*何时使用？
*当需要构建不同风格的对象，同时需要避免构造器重叠时使用生成器模式。
*与工厂模式的主要区别在于：当创建过程一步到位时，使用工厂模式，
*而当创建过程需要多个步骤时，使用生成器模式。
*/

//程序示例

//汉堡类
class Burger
{
	protected $size;

	protected $cheese    = false;
	protected $pepperoni = false;
	protected $lettuce   = false;
	protected $tomato    = false;

	public function __construct(BurgerBuilder $builder)
	{
		$this->size      = $builder->size;
		$this->cheese    = $builder->cheese;
		$this->pepperoni = $builder->pepperoni;
		$this->lettuce   = $builder->lettuce;
		$this->tomato    = $builder->tomato;
	}

}
//builder
class BurgerBuilder
{
	public $size;

	public $cheese    = false;
	public $pepperoni = false;
	public $lettuce   = false;
	public $tomato    = false;

	public function __construct($size)
	{
		$this->size = $size;
	}

	public function addCheese()
	{
		$this->cheese = true;
		return $this;
	}

	public function addPepperoni()
	{
		$this->pepperoni = true;
		return $this;
	}

	public function addLettuce()
	{
		$this->lettuce = true;
		return $this;
	}

	public function addTomato()
	{
		$this->tomato = true;
		return $this;
	}

	public function build():Burger
	{
		return new Burger($this);
	}
}

//使用
$burger = (new BurgerBuilder(14))
		  ->addPepperoni()
		  ->addLettuce()
		  ->addTomato()
		  ->build();

print_r($burger);