<?php
/*
*桥接模式
*
*现实生活示例
*假如你有一个网站，上面有不同的网页，并且允许用户更改主题。你会如何实现呢？
*是为每个页面的各个主题创建多个副本，还是创建单独的主题，并根据用户的偏好来加载主题呢？
*桥接模式可以帮你实现后者。
*
*概述
*桥接模式主打的是组合优于继承。实现细节从对象的层次结构推送给具有单独层次结构的另一个对象。
*
*维基百科
*桥接模式是软件工程中使用的设计模式，旨在“将抽象与实现分离，使得两者可以独立变化”
*/

//程序示例
//以上面提到的网页为例，下面是 WebPage 的结构
interface WebPage
{
	public function __construct(Theme $theme);
	public function getContent();
}

class About implements WebPage
{
	protected $theme;

	public function __construct(Theme $theme)
	{
		$this->theme = $theme;
	}

	public function getContent()
	{
		return 'About page in ' . $this->theme->getColor();
	}
}

class Careers implements WebPage
{
	protected $theme;

	public function __construct(Theme $theme)
	{
		$this->theme = $theme;
	}

	public function getContent()
	{
		return 'Careers page in ' . $this->theme->getColor();
	}
}
//独立的主题结构
interface Theme
{
	public function getColor();
}

class DarkTheme implements Theme
{
	public function getColor()
	{
		return 'Dark Black';
	}
}
class LightTheme implements Theme
{
	public function getColor()
	{
		return 'Off white';
	}
}
class AquaTheme implements Theme
{
	public function getColor()
	{
		return 'Light green';
	}
}

//使用
$darkTheme = new DarkTheme();
$about = new About($darkTheme);
$careers = new Careers($darkTheme);

echo $about->getContent() . PHP_EOL;
echo $careers->getContent() . PHP_EOL;