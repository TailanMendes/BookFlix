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
// Copyright 2000-2001 Kellin
// Email passionplay@hotmail.com
// Portions Copyright 2000-2001 Joshua Eichorn
// Email jeichorn@phpdoc.org
// Web 		http://phpdoc.org/
// Mirror 	http://phpdocu.sourceforge.net/
// Project    	http://sourceforge.net/projects/phpdocu/
//

/**
* a class for handling the publishing of data
*
* @author Kellin <passionplay@hotmail.com>
* @author Joshua Eichorn <jeichorn@phpdoc.org>
*/
class Publisher
{
	var $subscriber	=	array();

	var $tokens	=	array();

	var $pushEvent	=	array();
	var $popEvent	=	array();



	function subscribe($event, &$object)
	{
		$this->subscriber[$event] =& $object;
	}

	function publishEvent($event,$data)
	{
		// see if there is a specific event handler
		if (!empty($this->subscriber[$event]))
		{
			$this->subscriber[$event]->HandleEvent($event,$data);
		} 
		 else if (is_object($this->subscriber['*'])) // check to see if a generic handler exists
		{
			$this->subscriber['*']->HandleEvent($event,$data);
		}
	}	
}
?>
