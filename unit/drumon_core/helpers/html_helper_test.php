<?php
	
	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/html_helper.php';
	require_once CORE_PATH. '/helpers/text_helper.php';
	require_once CORE_PATH. '/class/request.php';
	
	class HtmlHelperTest extends PHPUnit_Framework_TestCase {
		
		public function setUp() {
			$this->request = $this->getMock('Request', array(), array(array(), APP_PATH));
			$this->html = new HtmlHelper($this->request, 'pt-BR');
		}
		
		// Method: block
		public function test_block_without_values() {
			$this->assertNull($this->html->block('meta'), 'Need return NULL');
		}
		
		public function test_block_with_one_value() {
			$this->html->block('meta','<meta>test</meta>');
			$meta = $this->html->block('meta');
			$this->assertEquals('<meta>test</meta>', $meta, 'Need return equal "<meta>test</meta>" but returned "'.$meta.'"');
		}
		
		public function test_block_with_two_values() {
			$this->html->block('meta','<meta>test</meta>');
			$this->html->block('block','my block');
			
			$meta = $this->html->block('meta');
			$this->assertEquals('<meta>test</meta>', $meta, 'Need return equal "<meta>test</meta>" but returned "'.$meta.'"');
			
			$block = $this->html->block('block');
			$this->assertEquals('my block', $block, 'Need return equal "my block" but returned "'.$block.'"');
		}
		
		// Method: css
		public function test_css_show_with_one_string_value() {
			$result = $this->html->styles('main');
			$this->assertEquals('<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>',$result);
		}
		
		public function test_css_show_with_one_array_value() {
			$result = $this->html->styles(array('main'));
			$this->assertEquals('<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>',$result);
		}
		
		public function test_css_show_with_two_array_values() {
			$result = $this->html->styles(array('main','basic'));
			
			$js_array = array();
			$js_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>';
			$js_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'basic.css" type="text/css" media="all"/>';
			$this->assertEquals(implode("\n",$js_array),$result);
		}
		
		public function test_css_show_and_add_with_correct_order() {
			$this->html->css('home');
			$result = $this->html->styles(array('main','basic'));
			
			$css_array = array();
			$css_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>';
			$css_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'basic.css" type="text/css" media="all"/>';
			$css_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'home.css" type="text/css" media="all"/>';
			$this->assertEquals(implode("\n", $css_array), $result);
		}
		
		public function test_css_add_with_one_value_and_null_show() {
			$this->html->css('main');
			$result = $this->html->styles(null);
			$this->assertEquals('<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>',$result);
		}
		
		public function test_css_add_with_one_value_empty_string_show() {
			$this->html->css('main');
			$result = $this->html->styles('');
			$this->assertEquals('<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>',$result);
		}
		
		public function test_css_with_options_inline() {
			$result = $this->html->css('page','inline');
			$this->assertEquals('<link rel="stylesheet" href="'.STYLESHEETS_PATH.'page.css" type="text/css" media="all"/>',$result);
		}
		
		public function test_css_with_options_media() {
			$result = $this->html->css('page','header','print');
			$result = $this->html->styles('main');
			$css_array = array();
			$css_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'main.css" type="text/css" media="all"/>';
			$css_array[] = '<link rel="stylesheet" href="'.STYLESHEETS_PATH.'page.css" type="text/css" media="print"/>';
			$this->assertEquals(implode("\n", $css_array), $result);
		}
		
		
		// Method: js
		public function test_js_show_with_one_string_value() {
			$result = $this->html->scripts('main');
			$this->assertEquals('<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'main.js"></script>',$result);
		}
		
		public function test_js_show_with_one_array_value() {
			$result = $this->html->scripts(array('main'));
			$this->assertEquals('<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'main.js"></script>',$result);
		}
		
		public function test_js_show_with_two_array_values() {
			$result = $this->html->scripts(array('main','basic'));
			
			$js_array = array();
			$js_array[] = '<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'main.js"></script>';
			$js_array[] = '<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'basic.js"></script>';
			
			
			$this->assertEquals(implode("\n", $js_array),$result);
		}
		
		public function test_js_show_and_add_with_correct_order() {
			$this->html->js('home');
			$result = $this->html->scripts(array('main','basic'));
			
			$js_array = array();
			$js_array[] = '<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'main.js"></script>';
			$js_array[] = '<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'basic.js"></script>';
			$js_array[] = '<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'home.js"></script>';
			
			$this->assertEquals(implode("\n", $js_array), $result);
		}
		
		public function test_js_with_options_inline() {
			$result = $this->html->js('main','inline');
			$this->assertEquals('<script type="text/javascript" src="'.JAVASCRIPTS_PATH.'main.js"></script>',$result);
		}
		
		
		// Method: link
		public function test_link_simple() {
			$result = $this->html->link('Title','url');
			$this->assertEquals('<a href="url" >Title</a>',$result);
		}
		
		public function test_link_with_html_attributes() {
			$result = $this->html->link('Title','url',array('title'=>'title'));
			$this->assertEquals('<a href="url" title="title" >Title</a>',$result);
		}
		
		public function test_link_with_invalid_html_attributes() {
			$result = $this->html->link('Title','url',array('hack'=>'me_ninja'));
			$this->assertEquals('<a href="url" >Title</a>',$result);
		}
		
		public function test_link_with_method_put() {
			$html = $this->getMock('HtmlHelper', array('js'), array(&$this->request,'pt-BR'));
			
			$html->expects($this->once())->method('js')->with($this->equalTo('vendor/drumon-jquery'));
			
			$result = $html->link('Title','url',array('method'=>'put'));
			$this->assertEquals('<a href="url" data-method="put" >Title</a>', $result);
		}
		
		public function test_link_with_confirm() {
			$html = $this->getMock('HtmlHelper', array('js'), array(&$this->request));
			
			$html->expects($this->once())->method('js')->with($this->equalTo('vendor/drumon-jquery'));
			
			$result = $html->link('Title','url',array('confirm' => 'Ninja?'));
			$this->assertEquals('<a href="url" data-confirm="Ninja?" >Title</a>',$result);
		}
		
		
		// Method: form
		public function test_form_with_method_post() {
			$result = $this->html->form('comment');
			$this->assertEquals('<form action="comment" method="post" ><input type="hidden" name="_token" value="token"><input type="hidden" name="_method" value="post">',$result);
		}
		
		public function test_form_with_method_put() {
			$result = $this->html->form('comment',array('method'=>'put'));
			$this->assertEquals('<form action="comment" method="post" ><input type="hidden" name="_token" value="token"><input type="hidden" name="_method" value="put">',$result);
		}
		
		public function test_form_with_method_get() {
			$result = $this->html->form('comment',array('method'=>'get'));
			$this->assertEquals('<form action="comment" method="get" >',$result);
		}
		
		public function test_form_with_options() {
			$result = $this->html->form('comment',array('id'=>'comment'));
			$this->assertEquals('<form action="comment" method="post" id="comment" ><input type="hidden" name="_token" value="token"><input type="hidden" name="_method" value="post">',$result);
		}
		
		public function test_form_with_options_file() {
			$result = $this->html->form('comment',array('file'=>true));
			$this->assertEquals('<form action="comment" method="post" enctype="multipart/form-data" ><input type="hidden" name="_token" value="token"><input type="hidden" name="_method" value="post">',$result);
		}
		
		
		// Method: form_end
		public function test_form_end() {
			$result = $this->html->form_end();
			$this->assertEquals('</form>',$result);
		}
		
		
		// Method: value
		public function test_value_with_valid_value() {
			$result = $this->html->value('ninja',array('ninja'=>'xxx'));
			$this->assertEquals('xxx',$result);
		}
		
		public function test_value_with_invalid_value() {
			$result = $this->html->value('ninja',array('noob'=>'xxx'));
			$this->assertEquals('',$result);
		}
		
		
		// Method: select
		public function test_select_with_two_values() {
			$result = $this->html->select('sex',array('m'=>'Male','f'=>'Female'));
			$this->assertEquals('<select name="sex" ><option value="m">Male</option><option value="f">Female</option></select>',$result);
		}
		
		public function test_select_with_option_selected() {
			$result = $this->html->select('sex',array('m'=>'Male','f'=>'Female'),array('selected'=>'m'));
			$this->assertEquals('<select name="sex" ><option selected value="m">Male</option><option value="f">Female</option></select>',$result);
		}
		
		public function test_select_with_option_include_blank_true() {
			$result = $this->html->select('sex',array('m'=>'Male','f'=>'Female'),array('include_blank'=>true));
			$this->assertEquals('<select name="sex" ><option value=""></option><option value="m">Male</option><option value="f">Female</option></select>',$result);
		}
		
		public function test_select_with_option_include_blank_false() {
			$result = $this->html->select('sex',array('m'=>'Male','f'=>'Female'),array('include_blank'=>false));
			$this->assertEquals('<select name="sex" ><option value="m">Male</option><option value="f">Female</option></select>',$result);
		}
		
		public function test_select_with_option_include_blank_with_value() {
			$result = $this->html->select('sex',array('m'=>'Male','f'=>'Female'),array('include_blank'=>'Select'));
			$this->assertEquals('<select name="sex" ><option value="">Select</option><option value="m">Male</option><option value="f">Female</option></select>',$result);
		}
		
		
		// Method: select_date_years
		public function test_select_date_years() {
			$result = $this->html->select_date_years('date',2000,2002);
			$this->assertEquals('<select name="date" ><option value="2000">2000</option><option value="2001">2001</option><option value="2002">2002</option></select>',$result);
		}
		
		// Method: select_date_months
		public function test_select_date_months() {
			$this->html->text = new TextHelper($this->request,'pt-BR');
			$result = $this->html->select_date_months('month',array('selected' => 1));
			$this->assertEquals('<select name="month" ><option selected value="1">Janeiro</option><option value="2">Fevereiro</option><option value="3">Março</option><option value="4">Abril</option><option value="5">Maio</option><option value="6">Junho</option><option value="7">Julho</option><option value="8">Agosto</option><option value="9">Setembro</option><option value="10">Outubro</option><option value="11">Novembro</option><option value="12">Dezembro</option></select>',$result);
		}
		
		// Method: select_date_days
		public function test_select_date_days() {
			$result = $this->html->select_date_days('day',array('selected'=>28));
			$this->assertEquals('<select name="day" ><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option selected value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>',$result);
		}
	}
?>