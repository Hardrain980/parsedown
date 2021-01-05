<?php

use \Leo\Parsedown;
use \PHPUnit\Framework\TestCase;

/**
 * @testdox \Leo\Parsedown
 */
class ParsedownTest extends TestCase
{
	public Parsedown $p;

	function setUp():void
	{
		$this->p = new Parsedown();
	}

	/**
	 * @testdox Superscript (<sup>)
	 */
	function testSup():void
	{
		$this->assertSame('Cl<sup>-</sup>', $this->p->line('Cl^-^'));
	}

	/**
	 * @testdox Subscript (<sub>)
	 */
	function testSub():void
	{
		$this->assertSame('H<sub>2</sub>O', $this->p->line('H~2~O'));
	}

	/**
	 * @testdox Keyboard (<kbd>)
	 */
	function testKbd():void
	{
		$this->assertSame('<kbd>Enter</kbd>', $this->p->line('[[Enter]]'));
	}

	/**
	 * @testdox Flag for block code (<pre><code> => <pre>)
	 */
	function testBlockCodeFlag():void
	{
		$this->assertSame(
			'<pre>    Hello, world!</pre>',
			$this->p->text("```\n\tHello, world!\n```")
		);
	}

	/**
	 * @testdox Language identifier for block code
	 */
	function testBlockCodeLanguage():void
	{
		$this->assertMatchesRegularExpression(
			'/data-enlighter-language="python"/',
			$this->p->text("```python\nprint('Hello, world!')\n```\n")
		);
	}
}

?>
