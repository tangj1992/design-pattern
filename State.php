<?php
/*
*状态模式
*
*现实生活示例
*想象一下，你正在使用一些绘图应用程序，你可以选择笔刷来绘画，刷子根据所选颜色改变其行为，
*即如果选择红色，它将绘制为红色，如果选择蓝色，那么它将绘制蓝色等。
*
*概述
*当状态改变时，类的行为也发生改变。
*
*维基百科
*状态模式是以面向对象的方式实现状态机的行为设计模式。对于状态模式，
*通过将每个单独状态实现为派生类的状态模式接口, 来实现一个状态机，
*并通过调用模式超类的方法来实现状态转换。状态模式可以被解释为一种策略模式，
*它能够通过调用模式接口定义的方法来切换当前策略。
*
*/

//程序示例
//以文本编辑器为例，编辑器可以改变文本的状态如选中粗体，就会以粗体输入文本，
//选中斜体便以斜体输入。

//首先是状态接口和一些状态实现
interface WritingState
{
	public function write(string $words);
}

class UpperCase implements WritingState
{
	public function write(string $words)
	{
		echo strtoupper($words) . PHP_EOL;
	}
}

class LowerCase implements WritingState
{
	public function write(string $words)
	{
		echo strtolower($words) . PHP_EOL;
	}
}

class Defaults implements WritingState
{
	public function write(string $words)
	{
		echo $words . PHP_EOL;
	}
}
//然后是文本编辑器
class TextEditor
{
	protected $state;

	public function __construct(WritingState $state)
	{
		$this->state = $state;
	}

	public function setState(WritingState $state)
	{
		$this->state = $state;
	}

	public function type(string $words)
	{
		$this->state->write($words);
	}
}
//使用
$editor = new TextEditor(new Defaults());
$editor->type('First line');

$editor->setState(new UpperCase());
$editor->type('Second line');
$editor->type('Third line');

$editor->setState(new LowerCase());
$editor->type('Fourth line');
$editor->type('Fifth line');