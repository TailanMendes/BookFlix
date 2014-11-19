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
* An event Stack
* 
* @author	Joshua Eichorn <jeichorn@phpdoc.org>
* @version	$Id: EventStack.inc,v 1.1.1.1 2002/04/12 03:52:08 rodif_bl Exp $
*/
class EventStack
{
	/** The stack */
	var $stack = array(PARSER_EVENT_NOEVENTS);

	/** The number of events in the stack */
	var $num = 0;

	/**
	* Push an event onto the stack
	*
	* @param	int	$event	All events should be constants
	*/
	function pushEvent($event)
	{
		$this->num = array_push($this->stack,$event) - 1;
	}

	/**
	* Pop an event from the stack
	*
	* @return	int	An event
	*/
	function popEvent()
	{
		$this->num--;
		return array_pop($this->stack);
	}

	/**
	* Get the current event
	*
	* @return	int	An event
	*/
	function getEvent()
	{
		return $this->stack[$this->num];
	}
}
