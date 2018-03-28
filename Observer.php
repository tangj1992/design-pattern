<?php
/*
*观察者模式
*
*现实生活示例
*一个很好的例子是，求职者订阅了一些招聘网站，每当有匹配的工作机会时，求职者就会收到通知。
*
*概述
*定义了对象之间的依赖，一旦其中一个对象的状态发生改变，依赖它的对象都会收到通知。
*
*维基百科
*观察者模式是软件设计模式的一种。在此种模式中，一个目标对象管理所有相依于它的观察者对象，
*并且在它本身的状态改变时主动发出通知。通常通过调用目标对象所提供的方法来实现。
*
*/

//程序示例

//以上述求职订阅为例，首先给出求职者，有职位发布时会收到通知
class JobPost
{
	protected $title;

	public function __construct(string $title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}
}
interface Observer
{
	public function __construct(string $name);
	public function onJobPosted(JobPost $job);
}
class JobSeeker implements Observer
{
	protected $name;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function onJobPosted(JobPost $job)
	{
		echo 'Hi,' . $this->name . '!New job posted:' . $job->getTitle() . PHP_EOL;
	}
}
//然后是求职者订阅的职位发布类
interface Observable
{
	public function attach(Observer $observer);
	public function addJob(JobPost $jobPosting);
}
class JobPostings implements Observable
{
	protected $observers = [];

	protected function notify(JobPost $jobPosting)
	{
		foreach ($this->observers as $observer) {
			$observer->onJobPosted($jobPosting);
		}
	}

	public function attach(Observer $observer)
	{
		$this->observers[] = $observer;
	}

	public function addJob(JobPost $jobPosting)
	{
		$this->notify($jobPosting);
	}
}
//使用
$johnDoe = new JobSeeker('John Doe');
$janeDoe = new JobSeeker('Jane Doe');

$jobPostings = new JobPostings();
$jobPostings->attach($johnDoe);
$jobPostings->attach($janeDoe);

$jobPostings->addJob(new JobPost('Software Engineer'));