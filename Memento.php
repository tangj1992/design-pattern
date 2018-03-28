<?php
/*
*备忘录模式
*
* 现实生活示例
*以计算器（即发起者）为例，每当执行一些计算时，最后一次计算结果将保存在内存中（即备忘录），
*以便数据可以恢复，也可以使用某些操作按钮（即临时代理）来恢复数据。
*
*概述
*备忘录模式以一种稍后可平滑恢复的方式捕捉并存储对象的当前状态。
*
*维基百科
*备忘录模式是一种软件设计模式，可以将对象恢复到之前的状态（通过回滚来撤销）
*需要提供撤销操作时，备忘录模式通常很有用。
*
*/

//程序示例

//首先给出可以存储编辑器状态的备忘录对象
class EditorMemento
{
	protected $content;

	public function __construct(string $content)
	{
		$this->content = $content;
	}

	public function getContent()
	{
		return $this->content;
	}
}
//然后是使用备忘录对象的编辑器及发起者
class Editor
{
	protected $content = '';

	public function type(string $words)
	{
		$this->content = $this->content . ' ' . $words;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function save()
	{
		return new EditorMemento($this->content);
	}

	public function restore(EditorMemento $memento)
	{
		$this->content = $memento->getContent();
	}
}
//使用
$editor = new Editor();

$editor->type('This is the first sentence');
$editor->type('This is the second sentence');

$saved = $editor->save();

$editor->type('And this is third');
echo $editor->getContent() . PHP_EOL;

$editor->restore($saved);
echo $editor->getContent() . PHP_EOL;
