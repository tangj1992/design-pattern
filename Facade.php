<?php
/**
*外观模式
*
*现实生活示例
*请问你会如何打开计算机呢？你会回答：“按电源键就行！”。
*你会这样想是因为你在使用计算机对外提供的简易接口，但是在内部，
*计算机完成了很多工作后才得以启动，这种复杂子系统的简单接口就是外观模式。
*
*概述
*外观模式提供了一个简化复杂系统的简单接口。
*
*维基百科
*外观模式是指针对像类库这种大体积代码提供简化接口的对象。
*
*/

//程序示例

//以上面提到的计算机为例，给出计算机类
class Computer
{
	public function getEletricShock()
	{
		echo 'Ouch!' . PHP_EOL;
	}

	public function makeSound()
	{
		echo 'Beep beep!' . PHP_EOL;
	}

	public function showLoadingScreen()
	{
		echo 'Loading...' . PHP_EOL;
	}

	public function bam()
	{
		echo 'Ready to be used!' . PHP_EOL;
	}

	public function closeEverything()
    {
        echo "Bup bup bup buzzzz!" . PHP_EOL;
    }

    public function sooth()
    {
        echo "Zzzzz" . PHP_EOL;
    }

    public function pullCurrent()
    {
        echo "Haaah!" . PHP_EOL;
    }
}
//下面是计算机的外观
class ComputerFacade
{
	protected $computer;

	public function __construct(Computer $computer)
	{
		$this->computer = $computer;
	}

	public function turnOn()
	{
		$this->computer->getEletricShock();
		$this->computer->makeSound();
		$this->computer->showLoadingScreen();
		$this->computer->bam();
	}

	public function turnOff()
	{
		$this->computer->closeEverything();
		$this->computer->pullCurrent();
		$this->computer->sooth();

	}
}
//使用
$computer = new ComputerFacade(new Computer());
$computer->turnOn();
$computer->turnOff();