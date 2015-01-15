<?php
/**
 * Created by PhpStorm.
 * User: vedmaka
 * Date: 13.01.2015
 * Time: 18:39
 */

class ContentFeedSpecial extends SpecialPage {

	function __construct() {
		// TODO: Implement __construct() method.
		parent::__construct('ContentFeed');
	}

	function execute() {

		$this->getOutput()->setPageTitle('Import content from external source');
		$this->getOutput()->addModules('ext.ContentFeed.main');

		$data = array();


		if( $this->getRequest()->wasPosted() ) {

			$url = $this->getRequest()->getVal('url');
			$step = $this->getRequest()->getVal('step');

			switch( $step ) {
				case 1:
					$this->previewFeed( $url );
					break;
				case 2:
					//import
					$this->importFeed( $url );
					break;
			}


		}else{

			$this->getOutput()->addHTML( Views::forge('default', $data) );

		}

	}

	function importFeed( $url ) {

		$data = array();
		$items = $this->getRequest()->getArray('items');

		if( !count($items) ) {
			$this->getOutput()->redirect('/index.php/Special:ContentFeed');
		}

		$pie = new SimplePie();
		$pie->set_feed_url( $url );
		$pie->init();

		if( $pie->error() ) {
			$this->getOutput()->addHTML('Error: '.$pie->error());
			return;
		}

		$titles = array();

		foreach( $items as $item ) {
			$item_content = $pie->get_item($item)->get_content();
			$item_title = $pie->get_item($item)->get_title();
			$titles[] = $this->createPage( $item_title, $item_content );
		}

		$data['titles'] = $titles;

		$this->getOutput()->addHTML( Views::forge('result', $data) );

	}

	function createPage( $title, $content ) {

		$wTitle = Title::newFromText($title, NS_MAIN);
		$wPage = WikiPage::factory( $wTitle );
		$wPage->doEdit( '<html>'.$content.'</html>', 'imported from feed' );

		return $wTitle;

	}

	function previewFeed( $url ) {

		$data = array();

		if( !$url ) {
			$this->getOutput()->redirect('/index.php/Special:ContentFeed');
		}

		$pie = new SimplePie();
		$pie->set_feed_url( $url );
		$pie->init();

		if( $pie->error() ) {
			$this->getOutput()->addHTML('Error: '.$pie->error());
			return;
		}

		$data['url'] = $url;
		$data['items'] = $pie->get_items();

		$this->getOutput()->addHTML( Views::forge('select', $data) );

	}

}