<?php

  /*
  *  Aces Downz is a Download Manager and Bandwidth Control
  *  Copyright (C) 2009 Felipe Braz <fbraz3@gmail.com>
  *
  *  This file is part of Aces Downz.
  *
  *  Aces Downz is free software: you can redistribute it and/or modify
  *  it under the terms of the GNU General Public License as published by
  *  the Free Software Foundation, either version 3 of the License, or
  *  (at your option) any later version.
  *
  *  Aces Downz is distributed in the hope that it will be useful,
  *  but WITHOUT ANY WARRANTY; without even the implied warranty of
  *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *  GNU General Public License for more details.
  *
  *  You should have received a copy of the GNU General Public License
  *  along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
  */

define("IN_ADZ",True);

require_once('config.php');
require_once ('functions/global.func.php');
require_once('lang/'.loadconfig("language").'.lang.php');
require_once('classes/banco.class.php');
require_once('classes/download.class.php');
require_once ('classes/browser.class.php');
require_once ('pear/HTTP/Download.php');
require_once('classes/cron.class.php');

		
//Se est� setado o modulo do invision
if(strtolower(loadconfig('forum')) == "invision"){
	require_once ('classes/invision.class.php');		
}

$download = new Download();

?>
