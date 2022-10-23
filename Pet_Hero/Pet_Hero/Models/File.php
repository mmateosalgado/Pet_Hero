<?php
namespace Models;
class File{
    private $name;
    private $fullPath;
    private $type;
    private $tmp_name;
    private $error;
    private $size;

    function __construct($name, $fullPath, $type, $tmp_name, $error, $size) {
        $this->name = $name;
        $this->fullPath = $fullPath;
        $this->type = $type;
        $this->tmp_name = $tmp_name;
        $this->error = $error;
        $this->size = $size;
    }

	function getName() {
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
		return $this;
	}
	

	function getFullPath() {
		return $this->fullPath;
	}
	

	function setFullPath($fullPath){
		$this->fullPath = $fullPath;
		return $this;
	}
	

	function getType() {
		return $this->type;
	}

	function setType($type){
		$this->type = $type;
		return $this;
	}
	

	function getTmp_name() {
		return $this->tmp_name;
	}
	

	function setTmp_name($tmp_name) {
		$this->tmp_name = $tmp_name;
		return $this;
	}
	

	function getError() {
		return $this->error;
	}

	function setError($error) {
		$this->error = $error;
		return $this;
	}
	

	function getSize() {
		return $this->size;
	}
	

	function setSize($size) {
		$this->size = $size;
		return $this;
	}
}
?>