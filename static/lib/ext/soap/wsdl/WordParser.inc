<?php
$WORD_PARSER_SEPERATORS = array( 
" ", "\t", "\r\n", "\n", "\r", ";", "\\", ",", "=", "@", ":", "\"", "{", "}", "(", ")", 
"<?php", "<?", "?>", "//", "/*", "*/" 
);

class wordParser
{
	/*
	New lines around the world
	Macintosh: \r 
        Unix : \n 
	Windows : \r\n 
	*/
	
	var $wordseperators = array( 
		" ", "\t", "\r\n", "\n", "\r", ";", "\\", ",", "=", "@", ":", "\"", "{", "}", "(", ")", 
		"<?php", "<?", "?>", "//", "/*", "*/" 
		);
	
	// This is getting mighty large and at some point im going to have to figure out if all these seperators are needed
	// And if so were going to have to do lots of setSeperators cause things are annoyinly 

	var $pos = 0;

	var $size;

	var $data;

	var $cache;

	/**
	* return whitespace
	*/
	var $ReturnWhiteSpace = false;

	function setup(&$input)
	{
		$this->size = strlen($input);
		$this->data = & $input;
		$this->pos = 0;
		$this->cache = array();
		//$this->run = 0;
		//$this->word = WORD_PARSER_RET_WORD;
	}

	function getWord()
	{
		//$st = $this->mtime();
		if ($this->size == $this->pos)
		{
			return false;
		}

		$npos = $this->size;
		if (is_array($this->wordseperators))
		{
			//$this->wordseperators = array();
			foreach($this->wordseperators as $sep)
			{
				$tpos = $this->cache[$sep];
				if ($tpos < $this->pos || !is_int($tpos))
				{
					$tpos = strpos($this->data,$sep,$this->pos);
				}
			
				if ( ($tpos < $npos) && !($tpos === false))
				{
					//echo trim($sep) . "=$tpos\n";
					$npos = $tpos;
					$seplen = strlen($sep);
				} 
			 	 else if (!($tpos === false))
				{
					$this->cache[$sep] = $tpos;
				}
			}
		} else {
			// its time to cycle
			return "";
		}

		$len = $npos - $this->pos;
		if ($len == 0)
		{
			$len = $seplen;
		}

		//$st3 = $this->mtime();
		$word = substr($this->data,$this->pos,$len);
		$this->pos = $this->pos + $len;
		//$this->word = WORD_PARSER_RET_SEP;

		// Change random other os newlines to the unix one
		if ($word == "\r" || $word == "\r\n")
		{
			$word = "\n";
		}

		// Things like // commenats rely on the newline to find their end so im going to have to return them
		// never return worthless white space /t ' '
		if ($this->returnWhiteSpace == false)
		{
			if (strlen(trim($word)) == 0 && $word != "\n") 
			{
				$word = $this->getWord();
			}
		}
		//$this->time3 = $this->time3 + ($this->mtime() - $st3);
		//$this->time = $this->time + ($this->mtime() - $st);
		return $word;
	}
	

	/**
	* Returns the current pointer position, or 1 character after the end of the word
	*/
	function getPos()
	{
		return $this->pos;
	}

	function getBlock($start,$len)
	{
		return substr($this->data,$start,$len);
	}

	function setSeperator(&$seps)
	{
		$this->wordseperators = &$seps;
	}

	function setPos($pos)
	{
		$this->pos = $pos;
	}

	/**
	* set parser to return or strip whitespace
	*/
	function setWhitespace($val = false)
	{
		$this->returnWhiteSpace = $val;
	}
}
