<?php
/*
*代理模式
*
* 现实生活示例
*有没有过使用门禁卡进门的经历呢？打开门的方法有多种，既可以使用门禁卡，也可以按下门上的安全按钮。
*门的主要功能是打开，但在其上添加一个代理，便可以给门添加一些功能。下面的代码示例可以给出更好的解释。
*
*概述
*使用代理模式，一个类可以代理另外一个类的功能。
*
*维基百科
*一个代理，其最一般的形式，是一个作为其他类接口的类。代理是由客户端调用的包装器或代理对象，
*用来访问幕后的真实服务对象。使用代理可以简单地向真实对象做转发，或者可以提供额外的逻辑。
*在代理模式中，可以提供额外的功能，例如当在真实对象上的操作是资源密集型时进行缓存，
*或者在调用真实对象的操作之前进行预处理。
*
*/

//程序示例

//以安全门为例，首先给出安全门接口及实现
interface Door 
{
	public function open();
	public function close();
}

class LabDoor implements Door
{
	public function open()
	{
		echo 'Opening lab door' . PHP_EOL;
	}

	public function close()
	{
		echo 'Closing the lab door' . PHP_EOL;
	}
}
//然后使用代理来确保门的安全
class Security
{
	protected $door;

	public function __construct(Door $door)
	{
		$this->door = $door;
	}

	public function open($password)
	{
		if ($this->authenticate($password)) {
			$this->door->open();
		}else{
			echo 'Big no!It arin\'t possible' . PHP_EOL;
		}
	}

	public function authenticate($password)
	{
		return $password === '$ecr@t';
	}

	public function close()
	{
		$this->door->close();
	}
}

//使用
$door = new Security(new LabDoor());
$door->open('invalid');

$door->open('$ecr@t');
$door->close();