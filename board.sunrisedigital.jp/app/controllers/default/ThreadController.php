<?php
/**
 *
 *
 * @author  Masamoto Miyata <miyata@able.ocn.ne.jp>
 * @create  2010/03/21
 * @copyright 2007 Sunrise Digital Corporation.
 * @version  v 1.0 2010/03/21 18:50:08 Miyata
 **/

class ThreadController extends Sdx_Controller_Action_Http
{
	public function indexAction()
	{
		sdx_debug::dump($this->_getParam('thread_id'), 'title');
	}

  public function addAction()
  {
    sdx_debug::dump($this->_getParam('thread_id'), 'title');
  }

  public function deleteAction()
  {
    sdx_debug::dump($this->_getParam('thread_id'), 'title');
  }

}