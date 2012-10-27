<?php
use Bootstrapper\Navigation;

class NavigationTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createNavMatcher($class, $extraClass = '', $stacked = false)
  {
    $class = $class == 'lists' ? 'list' : $class;
    $class = $class == 'unstyled' ? '' : ' nav-'.$class;

    $extraClass = $extraClass != '' ? ' '.$extraClass : '';

    $extraClass .= $stacked ? ' nav-stacked' : '';

    return $this->rootMater('nav'.$class.$extraClass);
  }

  private function createDropdownMatcher($class = '')
  {
    $class = $class != '' ? ' '.$class : '';

    return $this->rootMater('dropdown-menu'.$class);
  }

  private function rootMater($class)
  {
    return array(
      'tag' => 'ul',
      'attributes' => array(
        'class' => $class
      ),
      'children' => array(
        'count' => 2,
        'only' => array('tag' => 'li', 'child' => array('tag' => 'a')),
      )
    );
  }

  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('lists'),
      array('pills'),
      array('tabs'),
      array('unstyled'),
    );
  }

  // Tests --------------------------------------------------------- /

  public function testLinkBasic()
  {
    $link = Navigation::link('foo', '#');
    $match = array('label'=> 'foo', 'url' => '#', 'active' => false, 'disabled' => false, 'items' => null);
    $this->assertEquals($match, $link);
  }

  public function testLinkAll()
  {
    $link = Navigation::link('foo', '#', true, false, array('label' => 'bar', 'url' => '#1'));
    $match = array('label'=> 'foo', 'url' => '#', 'active' => true, 'disabled' => false, 'items' => array('label' => 'bar', 'url' => '#1'));
    $this->assertEquals($match, $link);
  }

  public function testLinksBasic()
  {
    $link = Navigation::links(array(
        array('foo', '#'),
        array('bar', '#')
      ));
    $match = array(
      array('label'=> 'foo', 'url' => '#', 'active' => false, 'disabled' => false, 'items' => null),
      array('label'=> 'bar', 'url' => '#', 'active' => false, 'disabled' => false, 'items' => null),
      );
    $this->assertEquals($match, $link);
  }

  public function testLinksAll()
  {
    $link = Navigation::links(array(
        array('foo', '#', true, false, 
          array(
            array('foo1', '#foo1'), 
            array('foo2', '#foo2')
          ) 
        ),
        array('bar', '#', false, true)
      ));

    $match = array(
        array('label'=> 'foo', 'url' => '#', 'active' => true, 'disabled' => false, 'items' => 
          array(
            array('label'=> 'foo1', 'url' => '#foo1', 'active' => false, 'disabled' => false, 'items' => null),
            array('label'=> 'foo2', 'url' => '#foo2', 'active' => false, 'disabled' => false, 'items' => null),
          )
        ),
        array('label'=> 'bar', 'url' => '#', 'active' => false, 'disabled' => true, 'items' => null),
      );

    $this->assertEquals($match, $link);
  }

  public function testDropdownBasic()
  {    
    $links = Navigation::links(array(array('foo', '#'),array('bar','#')));
    $dropdown = Navigation::dropdown($links);

    $matcher = $this->createDropdownMatcher();

    $this->assertTag($matcher, $dropdown);
  }

  public function testDropdownAll()
  {    
    $links = Navigation::links(array(array('foo', '#'),array('bar','#')));
    $dropdown = Navigation::dropdown($links, array('class' => 'bar', 'data-foo' => 'bar'));

    $matcher = $this->createDropdownMatcher('bar');
    $matcher['attributes']['data-foo'] = 'bar';

    $this->assertTag($matcher, $dropdown);
  }

  /**
   * @dataProvider classes
   */
  public function testStylesBasic($class)
  {
    $links = Navigation::links(array(array('foo', '#'),array('bar','#')));

    $menu = Navigation::$class($links);
    $match = $this->createNavMatcher($class);

    $this->assertTag($match, $menu);
  }

  /**
   * @dataProvider classes
   */
  public function testStylesStacked($class)
  {
    $links = Navigation::links(array(array('foo', '#'),array('bar','#')));

    $menu = Navigation::$class($links, true);
    $match = $this->createNavMatcher($class, '', true);

    $this->assertTag($match, $menu);
  }

  /**
   * @dataProvider classes
   */
  public function testStylesAll($class)
  {
    $links = Navigation::links(array(array('foo', '#'),array('bar','#')));

    $menu = Navigation::$class($links, true, array('class' => 'bar', 'data-foo' => 'bar'));
    $match = $this->createNavMatcher($class, 'bar', true);
    $match['attributes']['data-foo'] = 'bar';

    $this->assertTag($match, $menu);
  }
}