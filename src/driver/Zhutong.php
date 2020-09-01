<?php
namespace mfunc\driver;

class Zhutong
{
	protected $_config;

	public function __construct ($config = [])
	{
		$this->_config = $config;
	}

	public function getReqData ($phone, $content)
	{
	    $tkey = time();
	    $data = [
	        'username'  =>  $this->_config['user'],
	        'password'  =>  md5(md5($this->_config['pass']) . $tkey),
	        'tKey'      =>  $tkey,
	        'content'   =>  $content,
	        'mobile'    =>  $phone,
	    ];

	    return json_encode($data);
	}
}