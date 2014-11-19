<?php
//
// PhpDoc, a program for creating javadoc style documentation from php code
// Copyright (C) 2000-2001 Joshua Eichorn
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//

//
// Copyright 2000-2001 Joshua Eichorn
// Email jeichorn@phpdoc.org
// Web 		http://phpdoc.org/
// Mirror 	http://phpdocu.sourceforge.net/
// Project    	http://sourceforge.net/projects/phpdocu/

/**
* The base class for data
*
* @author	Joshua Eichorn <jeichorn@phpdoc.org>
* @version	$Id: DataTypes.inc,v 1.1.1.1 2002/04/12 03:52:10 rodif_bl Exp $
*/
class Data
{
	var $store;

	var $htmlentities = true;

	function setType ($type)
	{
		$this->store['type'] = $type;
	}

	function getType ()
	{
		return $this->store['type'];
	}

	function setName ($name)
	{
		$this->store['name'] = $name;
	}

	function getName ()
	{
		if ($this->htmlentities)
		{
			return htmlentities($this->store['name']);
		} else {
			return $this->store['name'];
		}
	}

	function setValue ($val)
	{
		$this->store['value'] = $val;
	}

	function getValue ()
	{
		if ($this->htmlentities)
		{
			return htmlentities($this->store['value']);
		} else {
			return $this->store['value'];
		}
	}

	function setDocblock ($obj)
	{
		$this->store['docblock'] = $obj->store;
	}

	function getDocblock ()
	{
		return $this->store['docblock'];
	}

	function setParent ($val)
	{
		$this->store['parent'] = $val;
	}

	function getParent ()
	{
		return $this->store['parent'];
	}

	function setSourceLocation ($val)
	{
		$this->store['sourcelocation'] = $val;
	}

	function getSourceLocation ()
	{
		return $this->store['sourcelocation'];
	}

	function dump()
	{
		print_r($this->store);
	}
}

class DataFile extends Data
{
	function DataFile ()
	{
		$this->setType("file");
	}

	function setPath($path)
	{
		$this->store['path'] = $path;
	}

	function getPath()
	{
		return $this->store['path'];
	}
}

class DataDefine extends Data
{
	function DataDefine ()
	{
		$this->setType("define");
	}

}

class DataDocBlock extends Data
{
	function DataDocBlock ()
	{
		$this->setType("docblock");
	}

	function setShortDesc ($sdesc)
	{
		$this->store['sdesc'] = $sdesc;
	}

	function getShortDesc ()
	{
		return $this->store['sdesc'];
	}

	function setDesc ( $desc )
	{
		$this->store['desc'] = $desc;
	}

	function getDesc ()
	{
		if ($this->htmlentities)
		{
			return htmlentities($this->store['desc']);
		} else {
			return $this->store['desc'];
		}
	}

	function addKeyword ($keyword, $data)
	{
		$this->store['data'][$keyword][] = $data;
	}

	function getKeyword ($keyword)
	{
		if (count($this->store['data'][$keyword]) == 1)
		{
			if ($this->htmlentities)
			{
				return htmlentities($this->store['data'][$keyword][0]);
			} else {
				return $this->store['data'][$keyword][0];
			}
		} else {
			if ($this->htmlentities)
			{
				return array_map("htmlentities",$this->store['data'][$keyword]);
			} else {
				return $this->store['data'][$keyword];
			}
		}
	}

	function listKeywords ()
	{
		if (is_array($this->store['data']))
		{
			foreach($this->store['data'] as $key => $val)
			{
				if ($this->htmlentities)
				{
					// this be a hack but the whole htmlentities is an html specific hack, xml output may take some changes
					switch ($key)
					{
						case "author":
							foreach($val as $val2)
							{
								$ret[] = array("keyword" => ucfirst($key),"data" => $val2);
							}
						break;
						case "link":
							foreach($val as $val2)
							{
								$ret[] = array(
										"keyword" => ucfirst($key),
										"data" => "<A target='_blank' href='$val'>" . htmlentities($val2) . "</a>"
									);
							}
						break;
						default:
							foreach($val as $val2)
							{
								$ret[] = array("keyword" => ucfirst($key),"data" => htmlentities($val[0]));
							}
						break;
					}
				} else {
					foreach($val as $val2)
					{
						$ret[] = array("keyword" => ucfirst($key),"data" => $val2);
					}
				}
			}
			return $ret;
		} else {
			return array();
		}
	}

	function addParam($keyword,$data)
	{
		$this->store['params'][$keyword] = $data;
	}

	function getParam($keyword)
	{
		if ($this->htmlentities)
		{
			return htmlentities($this->store['params'][$keyword]);
		} else {
			return $this->store['params'][$keyword];
		}
	}

	function listParams ()
	{
		if (is_array($this->store['params']))
		{
			foreach($this->store['params'] as $key => $val)
			{
				if ($this->htmlentities)
				{
					$ret[] = array("var" => ucfirst($key),"data" => htmlentities($val));
				} else {
					$ret[] = array("var" => ucfirst($key),"data" => $val);
				}
			}
			return $ret;
		} else {
			return array();
		}
	}
}
		
class DataVar extends Data
{
	function DataVar ()
	{
		$this->setType("var");
	}
}

class DataFunction extends Data
{
	function DataFunction ()
	{
		$this->setType("function");
	}

	function addParam ($name, $val)
	{
		$this->store['params'][$name] = $val;
	}

	function getParam ($name)
	{
		if ($this->htmlentities)
		{
			return htmlentities($this->store['params'][$name]);
		} else {
			return $this->store['params'][$name];
		}
	}

	function listParams ()
	{
		if (is_array($this->store['params']))
		{
			foreach($this->store['params'] as $key => $val)
			{
				if ($this->htmlentities)
				{
					$ret[] = array($key,htmlentities($val));
				} else {
					$ret[] = array($key,$val);
				}
			}
			return $ret;
		} else {
			return array();
		}
	}
}

class DataClass extends Data
{
	function DataClass ()
	{
		$this->setType("class");
	}

	function setExtends($e)
	{
		$this->store["extends"] = $e;
	}

	
	function getExtends()
	{
		return $this->store["extends"];
	}
}

class DataPage extends Data
{
	function DataPage ()
	{
		$this->setType("page");
	}

	function setFile($file)
	{
		$this->store["file"] = $file;
	}

	function getFile()
	{
		return $this->store["file"];
	}

	function setPath($path)
	{
		$this->store["path"] = $path;
	}

	function getPath()
	{
		return $this->store["path"];
	}
}

//Added for wsdl
class DataInclude extends Data
{
	function DataInclude()
	{
		$this->setType("include");
	}
	
	function setFile($file)
	{
		$this->store["file"] = $file;
	}

	function getFile()
	{
		return $this->store["file"];
	}
}
