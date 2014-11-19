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
//

define("PARSER_EVENT_ESCAPE"		,	900);
define("STATE_ESCAPE"			,	1000);

define("PHPDOC_EVENT_CLASS"		,	300);
define("PHPDOC_EVENT_DOCBLOCK"		,	301);
define("PHPDOC_EVENT_FUNCTION"		,	302);
define("PHPDOC_EVENT_VAR"		,	303);
define("PHPDOC_EVENT_PAGE"		,	304);
define("PHPDOC_EVENT_DEFINE"		,	305);
define("PHPDOC_EVENT_MESSAGE"		,	306);
define("PHPDOC_EVENT_NEWSTATE"		,	307);

define("PARSER_EVENT_QUOTE"		,	101);
define("STATE_QUOTE"			,	201);

define("PARSER_EVENT_LOGICBLOCK"	,	102);
define("STATE_LOGICBLOCK"		,	202);

define("PARSER_EVENT_NOEVENTS"		,	103);
define("STATE_NOEVENTS"			,	203);

define("PARSER_EVENT_COMMENTBLOCK"	,	104);
define("STATE_COMMENTBLOCK"		,	204);

define("PARSER_EVENT_COMMENT"		,	105);
define("STATE_COMMENT"			,	205);

define("PARSER_EVENT_PHPCODE"		,	106);
define("STATE_PHPCODE"			,	206);

define("PARSER_EVENT_DEFINE"		,	107);
define("STATE_DEFINE"			,	207);

define("PARSER_EVENT_DEFINE_PARAMS"	,	108);
define("STATE_DEFINE_PARAMS"		,	208);

define("PARSER_EVENT_FUNCTION_PARAMS"	,	109);
define("STATE_FUNCTION_PARAMS"		,	209);

define("PARSER_EVENT_SINGLEQUOTE"	,	110);
define("STATE_SINGLEQUOTE"		,	210);

define("PARSER_EVENT_CLASS"		,	111);
define("STATE_CLASS"			,	211);

define("PARSER_EVENT_DOCBLOCK"		,	112);
define("STATE_DOCBLOCK"			,	212);

define("PARSER_EVENT_DOCKEYWORD"	,	113);
define("STATE_DOCKEYWORD"		,	213);

define("PARSER_EVENT_DOCKEYWORD_EMAIL"	,	114);
define("STATE_DOCKEYWORD_EMAIL"		,	214);

define("PARSER_EVENT_ARRAY"		,	115);
define("STATE_ARRAY"			,	215);

define("PARSER_EVENT_VAR"		,	116);
define("STATE_VAR"			,	216);

define("PARSER_EVENT_FUNCTION"		,	117);
define("STATE_FUNCTION"			,	217);

define("PARSER_EVENT_OUTPHP"		,	118);
define("STATE_OUTPHP"			,	218);

//Added for wsdl
define("PARSER_EVENT_INCLUDE"		,	119);
define("STATE_INCLUDE"			,	219);

define("PARSER_EVENT_INCLUDE_PARAMS"	,	120);
define("STATE_INCLUDE_PARAMS"		,	220);


class Parser extends Publisher
{
	var $wp;

	/**
	* An array of allowable @tags
	*/
	var $allowableTags = array("param","return","access","author","copyright","version","see","since","deprecated","exception","throws",
					"package","subpackage","link");

	/**
	* Sets the states up, and creates a new WordParser
	*/
	function Parser()
	{
		$this->wp = new WordParser;
		$this->setupStates();
	}

	/**
	* Parse a new file
	*
	* @param	string	$parse_data
	* @param	string	$path
	* @param	int	$base	number of directories to drop off the bottom when creating names using path
	* @return	bool
	*/
	function parse (&$parse_data, $path, $base = 0)
	{
		if (strlen($parse_data) == 0)
		{
			return false;
		}

		global $event_stack;
		$event_stack = new EventStack;

		$this->wp->setup($parse_data);
		

		$page = new DataPage;
		$page->setPath($path);
		$page->setFile(basename($path));
		//$name = str_replace("/","_",dirname($path)) . "_" . array_shift(explode(".",$page->getFile()));
		$name = str_replace("/","_",dirname($path)) . "_" .  str_replace(".","_",$page->getFile());
		$tmp = explode("_",$name);
		$name = implode("_",array_slice($tmp,$base));

		$page->setName($name);
		$source_location = "Program_Root/" . implode("/",	array_slice(	explode("/",$path),$base	)	);
		
		$page->setSourceLocation($source_location);

		$this->publishEvent(PHPDOC_EVENT_PAGE,$page);
		unset($page);
		$reset_quote_data = true;

		do
		{
			$lpevent = $pevent;
			$pevent = $event_stack->getEvent();
			if ($lpevent != $pevent)
			{
				$last_pevent = $lpevent;
			}

			if ($last_pevent != $pevent)
			{
				// its a new event so the word parser needs to be reconfigured 
				$this->configWordParser($pevent);
			}

		
			$this->publishEvent(PHPDOC_EVENT_NEWSTATE,($pevent + 100));


			$last_word = $word;
			$word = $this->wp->getWord();

			//echo "LAST: |" . $last_word . "|\n";
			//echo "PEVENT: " . $this->getParserEventName($pevent) . "\n";
			//echo $this->wp->getPos() . ": |$word|\n";
			switch ($pevent)
			{
				case PARSER_EVENT_QUOTE:
					if ($reset_quote_data === true)
					{
						$reset_quote_data = false;
						$quote_data = "";
					}
					$this->checkEventPush( $word, $pevent);
					if ($word != "\"")
					{
						$quote_data .= $word;
					}
					if ($this->checkEventPop($word,$pevent))
					{
						$reset_quote_data = true;
					}
				break;
				case PARSER_EVENT_LOGICBLOCK:
					$this->checkEventPush( $word, $pevent);


					$this->checkEventPop($word,$pevent);
				break;
				case PARSER_EVENT_NOEVENTS:
					$this->checkEventPush( $word, $pevent); 
				break;
				case PARSER_EVENT_PHPCODE:
					if ($this->checkEventPush( $word, $pevent) == PARSER_EVENT_DOCBLOCK)
					{
						$this->wp->setWhitespace(true);
					} 
				break;
				case PARSER_EVENT_FUNCTION:
					$this->checkEventPush( $word, $pevent);

					if (!is_subclass_of($func,"data"))
					{
						$func = new DataFunction;
						$func->setName($word);
					}

					if ($this->checkEventPop($word,$pevent) || $last_pevent == PARSER_EVENT_LOGICBLOCK)
					{
						$this->publishEvent(PHPDOC_EVENT_FUNCTION,$func);
						unset($func);
					}
					if ($last_pevent == PARSER_EVENT_LOGICBLOCK)
					{
						$event_stack->popEvent();
						// We need to backup a word because of this wiredness
						$this->wp->setPos($this->wp->getPos() - strlen($word));
					}
				break;
				case PARSER_EVENT_DOCBLOCK:
					$e1 = $this->checkEventPush( $word, $pevent);

					if (!is_subclass_of($docblock,"data"))
					{
						$docblock = new DataDocBlock();
						$useperiod = false;
						$line = array();
						$linecount = 0;
					}

					//echo $this->wp->getPos() . ": |$word|\n";

					if (!$e1 && $word != "*" && $word != "*/" && $last_word != "\n")
					{
						$line[$linecount] .= $word;
					}

					if ($last_word == "." && strlen(trim($word)) == 0 && $useperiod == false)
					{
						$useperiod = true;
						$periodline = $linecount;
					}

					if ($word == "\n")
					{
						$linecount++;
					}

					if ($this->checkEventPop($word,$pevent))
					{
						//print_r($line);
						
						// we aren't going to use period line if its over line 3, or 4 lines of short desc
						if ($periodline > 3)
						{
							$useperiod = false;
						}

						// figure out the shortdesc
						if ($useperiod === false)
						{
							// use the first non blank line for short desc
							for($i = 0; $i < count($line); $i++)
							{
								if (strlen(trim($line[$i])) > 0)
								{
									$periodline = $i;
									$i = count($line);
								}
							}
									
							// check to see if we are going to use a blank line to end the shortdesc
							// this can only be in the first 4 lines
							if (count($line) > 4)
							{
								$max = 4;
							} else {
								$max = count($line);
							}

							for($i = $periodline; $i < $max; $i++)
							{
								if (strlen(trim($line[$i])) == 0)
								{
									$periodline = $i;
									$i = $max;
								}
							}
						}

						$shortdesc = "";
						for($i = 0; $i <= $periodline; $i++)
						{
							$shortdesc .= $line[$i];
						}
						$periodline++;

						$docblock_desc = "";
						//echo "i = $periodline; i < " . count($line) . "\n";
						for($i = $periodline; $i < count($line); $i++)
						{
							$docblock_desc .= $line[$i];
						}


						$docblock->setShortDesc($shortdesc);
						$docblock->setDesc($docblock_desc);
						unset($docblock_desc);
						$this->publishEvent(PHPDOC_EVENT_DOCBLOCK,$docblock);
						unset($docblock);
						$this->wp->setWhitespace(false);
					}
				break;
				case PARSER_EVENT_CLASS:
					if ($this->checkEventPush( $word, $pevent) == PARSER_EVENT_DOCBLOCK)
					{
						$this->wp->setWhitespace(true);
					}

					if (!is_subclass_of($class,"data"))
					{
						$class = new DataClass;
						$class->setname($word);
						$class->setSourceLocation($source_location);
					}

					if (strtolower($last_word) == "extends")
					{
						$class->setExtends($word);
					}

					if ($word == "{")
					{
						$this->publishEvent(PHPDOC_EVENT_CLASS,$class);
					}
					//echo $this->wp->getPos() . ": |$word|\n";
					if ($this->checkEventPop($word,$pevent))
					{
						unset($class);
					}
				break;
				case PARSER_EVENT_DEFINE:
					$this->checkEventPush( $word, $pevent);

					if ($this->checkEventPop($word,$pevent))
					{
						$define = new DataDefine;
						$define->setName($define_name);
						$define->setValue($define_value);
						$this->publishEvent(PHPDOC_EVENT_DEFINE,$define);
						unset($define);
						unset($define_name);
						unset($define_value);
					}
				break;
				case PARSER_EVENT_DEFINE_PARAMS:
					$this->checkEventPush( $word, $pevent);
					
					if ($word == ",")
					{
						$define_name = $quote_data;
						unset($quote_data);
					}

					if ($this->checkEventPop($word,$pevent))
					{
						if (!empty($quote_data))
						{
							$define_value = $quote_data;
						} else {
							$define_value = trim($last_word);
						}
					}
				break;
				case PARSER_EVENT_INCLUDE:
					$this->checkEventPush($word, $pevent);

					if ($this->checkEventPop($word,$pevent))
					{
						$include = new DataInclude;
						$include->setFile($include_file);
						$this->publishEvent(PHPDOC_EVENT_INCLUDE, $include);
						unset($include);
						unset($include_file);
					}
				break;
				case PARSER_EVENT_INCLUDE_PARAMS:
					$this->checkEventPush( $word, $pevent);
					
					if ($this->checkEventPop($word,$pevent))
					{
						$include_file = $quote_data;
					}
				break;
				case PARSER_EVENT_VAR:
					$this->checkEventPush( $word, $pevent);

					if (!is_subclass_of($var,"data"))
					{
						$var = new DataVar;
						$var->setName($word);
					}
					if ($last_word == "=")
					{
						$var->setValue($word);
					}
					if ($last_pevent == PARSER_EVENT_QUOTE || $last_pevent == PARSER_EVENT_SINGLEQUOTE)
					{
						$var->setValue($word);
						unset($quote_data);
					}
						
					if ($this->checkEventPop($word,$pevent))
					{
						$this->publishEvent(PHPDOC_EVENT_VAR,$var);
						unset($var);
					}
				break;
				case PARSER_EVENT_COMMENT:
					$this->checkEventPush( $word, $pevent);

					$comment_data .= $word;

					$this->checkEventPop($word,$pevent);
				break;
				case PARSER_EVENT_COMMENTBLOCK:
					$this->checkEventPop($word,$pevent);
				break;
				case PARSER_EVENT_ESCAPE:
					$event_stack->popEvent();
				break;
				case PARSER_EVENT_SINGLEQUOTE:
					if ($this->checkEventPop($word,$pevent))
					{
						if ($last_word != "'")
						{
							$quote_data = $last_word;
						} else {
							$quote_data = "";
						}
					}
				break;
				case PARSER_EVENT_FUNCTION_PARAMS:
					//echo $this->wp->getPos() . ": word=|$word|\t\t\tlastword=|$last_word|\n";
					//echo "function_param = '$function_param'\n";
					//echo "function_data = '$function_data'\n";
					$e1 = $this->checkEventPush( $word, $pevent); 

					if ($e1 != PARSER_EVENT_ARRAY)
					{

						if (empty($function_param) && $word != "," && $word != "\n" && $word != ")")
						{
							 $function_param = $word;
						}
						if ($last_word == "=" && $word != "'" && $word != "\"")
						{
							$func->addParam($function_param,$word);
							unset($function_param);
						}
						if ( ($last_word == "'") && isset($function_param) )
						{
							$func->addParam($function_param,"'$quote_data'");
							unset($function_param);
						}
						if ( ($last_word == "\"") && isset($function_param) )
						{
							$func->addParam($function_param,"\"$quote_data\"");
							unset($function_param);
						}
						if ($word == "," && !empty($function_param))
						{
							if (isset($function_data))
							{
								$func->addParam($function_param,$function_data);
								unset($function_param);
								unset($function_data);
							} else {
								$func->addParam($function_param,"");
								unset($function_param);
							}
						}
						
						if ($this->checkEventPop($word,$pevent))
						{
							if ($function_param)
							{
								if (isset($function_data))
								{
									$func->addParam($function_param,$function_data);
									unset($function_param);
									unset($function_data);
								} else {
									$func->addParam($function_param,"");
									unset($function_param);
								}
							}
						}
					}
				break;
				case PARSER_EVENT_DOCKEYWORD:
					//echo $this->wp->getPos() . ": |$word|\n";

					//echo "docktype: $dockeyword_type\n";

					$this->wp->setWhitespace(true);
					$e1 = $this->checkEventPush( $word, $pevent); 
					if (!$dockeyword_type)
					{
						if (in_array($word,$this->allowableTags))
						{
							$dockeyword_type = strtolower($word);
						} else {
							$docblock_desc .= $word;
							$event_stack->popEvent();
						}
					} else if (!$e1) {
						if ($dockeyword_type == "param" && empty($param_var))
						{
							if (substr($word,0,1) == "$")
							{
								$param_var = $word;
							} else {
								$dockeyword_data .= $word;
							}
						} else if ($word != "@" && $word != "*/" && $word != "*"/* && $word != "\n"*/) {
							$dockeyword_data .= $word;
						}
					}

					if ($this->checkEventPop($word,$pevent))
					{
						if (!empty($param_var))
						{
							$docblock->addParam($param_var,trim($dockeyword_data));
						} else {
							$docblock->addKeyword($dockeyword_type,trim($dockeyword_data));
						}
						unset($param_var);
						unset($dockeyword_type);
						unset($dockeyword_data);
						$this->wp->setWhitespace(false);
						// walk back a word
						$this->wp->setPos($this->wp->getPos() - strlen($word));
					}
				break;
				case PARSER_EVENT_DOCKEYWORD_EMAIL:
					//echo $this->wp->getPos() . ": |$word|\n";
					if (!$this->checkEventPop($word,$pevent) && $word != "<")
					{
						if (strstr($word,"@"))
						{
							$dockeyword_data .= "&lt;<a href='mailto:$word'>$word</a>&gt;";
						} else {
							$dockeyword_data .= "<$word>";
						}
					}
				break;
				case PARSER_EVENT_ARRAY:
					$this->checkEventPush( $word, $pevent); 

					if (!isset($function_data))
					{
						$function_data = "array";
					}

					if ( ($last_word == "'"))
					{
						$function_data .= "$quote_data'";
					}
					if ( ($last_word == "\""))
					{
						$function_data .= "$quote_data\"";
					}

					$function_data .= $word;
					//echo "function_data = |$function_data|\n";

					if ($this->checkEventPop($word,$pevent))
					{
					}
				break;
				case PARSER_EVENT_OUTPHP:
					$this->checkEventPop($word,$pevent);
				break;
			}
		} while (!($word === false));
	}

	function checkEventPush($word,$pevent)
	{
		global $event_stack;
		$e = $this->pushEvent[$pevent][strtolower($word)];
		if ($e)
		{
			$event_stack->pushEvent($e);
			return $e;
		} else {
			return false;
		}
	}

	function checkEventPop($word,$pevent)
	{
		global $event_stack;
		if (in_array(strtolower($word),$this->popEvent[$pevent]))
		{
			return $event_stack->popEvent();
		} else {
			return false;
		}
	}

	function setupStates()
	{
		$this->tokens[STATE_PHPCODE]		= array(" ", "\t",";","?>","/**", "//","/*","#","\r\n","\n","\r","(");
		$this->tokens[STATE_QUOTE]		= array("\\\"","\"");
		$this->tokens[STATE_LOGICBLOCK]		= array("{","}","\"","'","/*","//","#","?>");
		$this->tokens[STATE_NOEVENTS]		= array("<?php","<?");
		$this->tokens[STATE_COMMENTBLOCK]	= array("*/");
		$this->tokens[STATE_COMMENT]		= array("\r\n","\r","\n");
		$this->tokens[STATE_DEFINE]		= array(" ","(",";");
		$this->tokens[STATE_DEFINE_PARAMS]	= array("/*","\"",",",")"," ","'");
		$this->tokens[STATE_FUNCTION_PARAMS]	= array("/*","\"",",",")","="," ","'","(");
		$this->tokens[STATE_SINGLEQUOTE]	= array("'");
		$this->tokens[STATE_CLASS]		= array(" ","\t","?>",";","}","{","/**","//","/*","#","\r\n","\n","\r","(");
		$this->tokens[STATE_DOCBLOCK]		= array("*/","*","@","\r\n","\n","\r",".");
		$this->tokens[STATE_DOCKEYWORD]		= array("@","*/","*","\n","\r\n","\r","\t"," ","<",">");
		$this->tokens[STATE_DOCKEYWORD_EMAIL]	= array(">","\n","\r\n","\r");
		$this->tokens[STATE_VAR]		= array(" ","\t",";","=",",");
		$this->tokens[STATE_ARRAY]		= array("(",")","\"","'","array");
		$this->tokens[STATE_FUNCTION]		= array("(","{","}"," ","\t");
		$this->tokens[STATE_OUTPHP]		= array("<?php","<?");
		$this->tokens[STATE_ESCAPE]		= false;// this tells the word parser to just cycle
		$this->tokens[STATE_INCLUDE]		= array(" ","(",";");
		$this->tokens[STATE_INCLUDE_PARAMS]	= array("\"",",",")"," ","'");

		// For each event word to event mapings
		$this->pushEvent[PARSER_EVENT_QUOTE] = 
			array(
				"\\"	=> PARSER_EVENT_ESCAPE
			);
		$this->popEvent[PARSER_EVENT_QUOTE] = array("\"");
##########################
		 
		$this->pushEvent[PARSER_EVENT_LOGICBLOCK] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE,
				"//" 	=> PARSER_EVENT_COMMENT,
				"#" 	=> PARSER_EVENT_COMMENT,
				"/*" 	=> PARSER_EVENT_COMMENTBLOCK,
				"{"	=> PARSER_EVENT_LOGICBLOCK,
				"?>"	=> PARSER_EVENT_OUTPHP
			);
		$this->popEvent[PARSER_EVENT_LOGICBLOCK] = array("}");
##########################

		$this->pushEvent[PARSER_EVENT_NOEVENTS] = 
			array(
				"<?php" => PARSER_EVENT_PHPCODE,
				"<?" => PARSER_EVENT_PHPCODE
			);
##########################

		$this->pushEvent[PARSER_EVENT_PHPCODE] = 
			array(
				"function" 	=> PARSER_EVENT_FUNCTION,
				"class" 	=> PARSER_EVENT_CLASS,
				"define" 	=> PARSER_EVENT_DEFINE,
				"//" 		=> PARSER_EVENT_COMMENT,
				"#" 		=> PARSER_EVENT_COMMENT,
				"/*" 		=> PARSER_EVENT_COMMENTBLOCK,
				"/**" 		=> PARSER_EVENT_DOCBLOCK,
				"\""		=> PARSER_EVENT_QUOTE,
				"'"		=> PARSER_EVENT_SINGLEQUOTE,
				"?>" 		=> PARSER_EVENT_OUTPHP,
				//Added for wsdl
				"include"	=> PARSER_EVENT_INCLUDE				
			);
##########################

		$this->pushEvent[PARSER_EVENT_FUNCTION] = 
			array(
				"(" 	=> PARSER_EVENT_FUNCTION_PARAMS,
				"{" 	=> PARSER_EVENT_LOGICBLOCK
			);
		$this->popEvent[PARSER_EVENT_FUNCTION] = array("}");
##########################

		$this->pushEvent[PARSER_EVENT_DOCBLOCK] = 
			array(
				"@" 	=> PARSER_EVENT_DOCKEYWORD,
			);
		$this->popEvent[PARSER_EVENT_DOCBLOCK] = array("*/");
##########################

		$this->pushEvent[PARSER_EVENT_CLASS] = 
			array(
				"function" 	=> PARSER_EVENT_FUNCTION,
				"var" 		=> PARSER_EVENT_VAR,
				"/**" 		=> PARSER_EVENT_DOCBLOCK,
				"//" 		=> PARSER_EVENT_COMMENT,
				"#" 		=> PARSER_EVENT_COMMENT,
				"?>"		=> PARSER_EVENT_OUTPHP
			);
		$this->popEvent[PARSER_EVENT_CLASS] = array("}");
##########################

		$this->pushEvent[PARSER_EVENT_DEFINE] = 
			array(
				"/*" 	=> PARSER_EVENT_COMMENTBLOCK,
				"(" 	=> PARSER_EVENT_DEFINE_PARAMS
			);
		$this->popEvent[PARSER_EVENT_DEFINE] = array(";");
##########################

		$this->pushEvent[PARSER_EVENT_DEFINE_PARAMS] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE,
			);
		$this->popEvent[PARSER_EVENT_DEFINE_PARAMS] = array(")");

//Added for wsdl
##########################
##########################


		$this->pushEvent[PARSER_EVENT_INCLUDE] = 
			array(
				"(" 	=> PARSER_EVENT_INCLUDE_PARAMS
			);
		$this->popEvent[PARSER_EVENT_INCLUDE] = array(";");
##########################

		$this->pushEvent[PARSER_EVENT_INCLUDE_PARAMS] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE,
			);
		$this->popEvent[PARSER_EVENT_INCLUDE_PARAMS] = array(")");

##########################
##########################
		
		
##########################

		$this->pushEvent[PARSER_EVENT_VAR] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE
			);
		$this->popEvent[PARSER_EVENT_VAR] = array(";");
##########################

		$this->pushEvent[PARSER_EVENT_COMMENT] = 
			array(
				"\\"	=> PARSER_EVENT_ESCAPE
			);
		$this->popEvent[PARSER_EVENT_COMMENT] = array("\n");
##########################

		$this->popEvent[PARSER_EVENT_COMMENTBLOCK] = array("*/");
##########################

		$this->popEvent[PARSER_EVENT_SINGLEQUOTE] = array("'");
##########################
		$this->pushEvent[PARSER_EVENT_FUNCTION_PARAMS] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE,
				"array" => PARSER_EVENT_ARRAY
			);
		$this->popEvent[PARSER_EVENT_FUNCTION_PARAMS] = array(")");
##########################
		$this->pushEvent[PARSER_EVENT_DOCKEYWORD] = 
			array(
				"<"	=> PARSER_EVENT_DOCKEYWORD_EMAIL
			);

		$this->popEvent[PARSER_EVENT_DOCKEYWORD] = array("@","*/");
##########################

		$this->popEvent[PARSER_EVENT_OUTPHP] = array("<?php","<?");
##########################

		$this->popEvent[PARSER_EVENT_DOCKEYWORD_EMAIL] = array(">","\n");
##########################

		$this->pushEvent[PARSER_EVENT_ARRAY] = 
			array(
				"\""	=> PARSER_EVENT_QUOTE,
				"'"	=> PARSER_EVENT_SINGLEQUOTE,
				"array" => PARSER_EVENT_ARRAY
			);
		$this->popEvent[PARSER_EVENT_ARRAY] = array(")");
##########################
	}

	function configWordParser($e)
	{
		$this->wp->setSeperator($this->tokens[($e + 100)]);
	}

	function getParserEventName ($value)
	{	
	$lookup = array(
		PARSER_EVENT_NOEVENTS 		=> "PARSER_EVENT_NOEVENTS",
		PARSER_EVENT_PHPCODE		=> "PARSER_EVENT_PHPCODE",
		PARSER_EVENT_DOCBLOCK		=> "PARSER_EVENT_DOCBLOCK",
		PARSER_EVENT_FUNCTION		=> "PARSER_EVENT_FUNCTION",
		PARSER_EVENT_CLASS		=> "PARSER_EVENT_CLASS",
		PARSER_EVENT_DEFINE		=> "PARSER_EVENT_DEFINE",
		PARSER_EVENT_DEFINE_PARAMS	=> "PARSER_EVENT_DEFINE_PARAMS",
		PARSER_EVENT_COMMENT		=> "PARSER_EVENT_COMMENT",
		PARSER_EVENT_COMMENTBLOCK	=> "PARSER_EVENT_COMMENTBLOCK",
		PARSER_EVENT_ESCAPE		=> "PARSER_EVENT_ESCAPE",
		PARSER_EVENT_QUOTE		=> "PARSER_EVENT_QUOTE",
		PARSER_EVENT_FUNCTION_PARAMS	=> "PARSER_EVENT_FUNCTION_PARAMS",
		PARSER_EVENT_SINGLEQUOTE	=> "PARSER_EVENT_SINGLEQUOTE",
		PARSER_EVENT_VAR		=> "PARSER_EVENT_VAR",
		PARSER_EVENT_LOGICBLOCK		=> "PARSER_EVENT_LOGICBLOCK",
		PARSER_EVENT_OUTPHP		=> "PARSER_EVENT_OUTPHP",
		PARSER_EVENT_DOCKEYWORD		=> "PARSER_EVENT_DOCKEYWORD",
		PARSER_EVENT_DOCKEYWORD_EMAIL	=> "PARSER_EVENT_DOCKEYWORD_EMAIL",
		PARSER_EVENT_ARRAY		=> "PARSER_EVENT_ARRAY",
		//Added for wsdl
		PARSER_EVENT_INCLUDE		=> "PARSER_EVENT_INCLUDE",
		PARSER_EVENT_INCLUDE_PARAMS	=> "PARSER_EVENT_INCLUDE_PARAMS"
	);
	return $lookup[$value];
}
}
