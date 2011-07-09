<?php
	
	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/text_helper.php';
	
	class TextHelperTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->request = $this->getMock('RequestHandler',array(),array(array()));
			$this->text = new TextHelper($this->request,'pt-BR');
		}
		
		
		// Method: to_slug
		public function test_to_slug() {
			$result = $this->text->to_slug('Não? da çerto isso  eu sei - sim');
			$this->assertEquals('nao-da-certo-isso-eu-sei-sim',$result);
		}
		
		public function test_to_slug_with_other_separator() {
			$result = $this->text->to_slug('Não? da çerto isso  eu sei - sim','_');
			$this->assertEquals('nao_da_certo_isso_eu_sei_sim',$result);
		}
		
		
		// Method: twitterify
		public function test_twitterify() {
			$result = $this->text->twitterify('eu @danillos #ninja');
			$this->assertEquals('eu <a title= "Twitter Profile" href="http://www.twitter.com/danillos" target="_blank">@danillos</a> <a title="Twitter Search" href="http://search.twitter.com/search?q=ninja" target="_blank">#ninja</a>',$result);
		}
		
		
		// Method: linkfy
		public function test_linkfy() {
			$result = $this->text->linkfy('meu site é http://www.local.dev e www.local.dev');
			$this->assertEquals('meu site é <a href="http://www.local.dev" target="_blank">http://www.local.dev</a> e <a href="http://www.local.dev" target="_blank">www.local.dev</a>',$result);
		}
		
		
		// Method: highlight
		public function test_highlight_with_one_match() {
			$result = $this->text->highlight('meu texto aqui','texto');
			$this->assertEquals('meu <span class="highlight">texto</span> aqui',$result);
		}
		
		public function test_highlight_with_two_match() {
			$result = $this->text->highlight('meu texto aqui',array('meu','texto'));
			$this->assertEquals('<span class="highlight">meu</span> <span class="highlight">texto</span> aqui', $result);
		}
		
		public function test_highlight_without_math() {
			$result = $this->text->highlight('meu texto aqui','');
			$this->assertEquals('meu texto aqui',$result);
		}
		
		
		// Method: strip_links
		public function test_strip_links() {
			$result = $this->text->strip_links('meu <a href="http://www.local.dev">site</a>');
			$this->assertEquals('meu site',$result);
		}
		
		// Method: truncate
		public function test_truncate_with_max_6() {
			$result = $this->text->truncate('meu texto aqui', 6);
			$this->assertEquals('meu te...',$result);
		}
		
		public function test_truncate_with_max_6_not_exact() {
			$result = $this->text->truncate('meu texto aqui', 6,array('exact' => false));
			$this->assertEquals('meu...',$result);
		}
		
		public function test_truncate_with_text_small_then_max() {
			$result = $this->text->truncate('meu', 6);
			$this->assertEquals('meu',$result);
		}
		
		
		// Method: excerpt
		public function test_excerpt() {
			$result = $this->text->excerpt('meu texto aqui bem grande','aqui',8);
			$this->assertEquals('...xto aqui bem...',$result);
		}
		
		public function test_excerpt_without_text() {
			$result = $this->text->excerpt('meu texto aqui bem grande','',8);
			$this->assertEquals('meu texto aqui b...',$result);
		}
		
		
		
		public function test_excerpt_with_small_text() {
			$result = $this->text->excerpt('hoje','aqui',1);
			$this->assertEquals('hoje',$result);
		}
		
		
		// Method: translate
		public function test_translate() {
			$result = $this->text->translate('your_word');
			$this->assertEquals('Sua palavra', $result);
		}
		
		public function test_translate_namespace() {
			$result = $this->text->translate('user.name');
			$this->assertEquals('Danillo', $result);
		}
		
		public function test_translate_custom_file() {
			$result = $this->text->translate('hello_boy', array('from'=>'custom'));
			$this->assertEquals('Olá Garoto', $result);
		}
		
		public function test_translate_pluralization() {
			$result = $this->text->translate('records', array('count' => 0));
			$this->assertEquals('nenhum registro', $result);
			
			$result = $this->text->translate('records', array('count' => 1));
			$this->assertEquals('um registro', $result);
			
			$result = $this->text->translate('records', array('count' => 2));
			$this->assertEquals('dois registros', $result);
			
			$result = $this->text->translate('records', array('count' => 3));
			$this->assertEquals('3 registros', $result);
			
			$result = $this->text->translate('records', array('count' => 4));
			$this->assertEquals('4 registros', $result);
		}
	}

?>