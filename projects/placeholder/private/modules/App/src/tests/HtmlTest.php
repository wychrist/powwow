<?php
use App\Lib\Ui\Html;
use PHPUnit\Framework\TestCase;

final class HtmlTest extends TestCase
{

  
    public function testNodeCreatedCorrectly()
    {
        $this->assertEquals('<b id="empty_bold"></b>', (new Html('b','empty_bold'))->__toString(),'Generated html is not what was expected');
    
        $div = new Html('div','div1');
        $this->assertEquals('<div id="div1"></div>', $div->render(),'Generated html is not what was expected');

        $div->add('b','bold');
        $div->getNode('bold');
        $this->assertEquals('<b id="bold"></b>',$div->getNode('bold')->render(),'Generated html is not what was expected');

        $this->assertEquals('<div id="div1"><b id="bold"></b></div>',$div->render(),'Generated html is not what was expected');
        $this->assertEquals('div',$div->getTag(), 'Tag returned is not the same as the one that was set');
    }

    public function testNodeToArrayCreated()
    {
        $div = new Html('div','div');
        $div->add('span', 'span1');

        $this->assertArrayHasKey('tag', $div->toArray(), 'Node array does not have a tag key');
        $this->assertArrayHasKey('children', $div->toArray(), 'Node array does not have children key');
        $this->assertArrayHasKey('text', $div->toArray(), 'Node array does not have a text key');
        $this->assertArrayHasKey('metadata', $div->toArray(), 'Node array does not have a metadata key');
        $this->assertArrayHasKey('isVoidTag', $div->toArray(), 'Node array does not have an isVoidTag key');
        $this->assertArrayHasKey('property', $div->toArray(), 'Node array does not have a property key');
        $this->assertArrayHasKey('id',$div->toArray()['property'],'Node array property does not have an id');
    }

    public function testNodeCreatedFromArray()
    {

        $div1 = new Html('div','div');
        $div1->add('span', 'span1');

        $div2 = new Html();
        $div2->fromArray($div1->toArray());

        $this->assertEquals($div2->toArray(),$div1->toArray(), 'Generated Node from array is not the same the original node');
        $this->assertEquals($div2->render(),$div1->render(), 'Generated Node from array is not the same the original node');
    }

    public function testNoteProperty()
    {
        
        $div1 = new Html('div','div');

        $div1->set('style','background-color:red;');
        $this->assertEquals('background-color:red;',$div1->get('style'), 'Incorrect property returned');
    }
}