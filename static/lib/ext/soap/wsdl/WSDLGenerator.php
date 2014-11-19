<?

class WSDLGenerator
{
	var $wsdl;
	
	function WSDLGenerator($file, $service)
	{
		include("Publisher.inc");
		include("WordParser.inc");
		include("EventStack.inc");
		include("DataTypes.inc");
		include("Parser.inc");
		
		$parse = new Parser();
		$wsdl = new WSDLGenerator();

		$infile = "wsdltest.php";
		$parse->subscribe("*", $wsdl);
		$parse->parse(implode(file($infile),"\n"), "asdf", 9);
		header("Content-Type: text/xml\r\n");
		$wsdl->getwsdl();
	
		$this->wsdl = new_xmldoc("1.0");
		$this->wsdl_root = $this->wsdl->add_root("definitions");
		$this->wsdl_root->set_attribute("xmlns:soap","http://schemas.xmlsoap.org/wsdl/soap/");
	}
	
	function HandleEvent($event, $data)
	{
		if($event == PHPDOC_EVENT_NEWSTATE)
			return true;

		$this->lasttype = $this->type;
		$type = $data->getType();
		$this->type = $type;
		switch($type)
		{
			case "docblock":
				$this->last = $data;
			break;
			case "include":
				$file = $data->getFile();
			break;
			case "page":
			break;
			case "define":
			break;
			case "class":
				$class->name = $data->getName();
				$class->sdesc = $this->last->getShortDesc();
				$class->desc = $this->last->getDesc();
				$class->parent = $data->getExtends();
				$this->available_classes[$class->name] = $class;
				$this->current_class = $class->name;
			break;
			case "var":
				if($this->current_class != NULL)
				{
					$member->type = $this->last->getType();
					$member->desc = $this->last->getDesc();
					$member->name = $data->getName();
					$member->sdesc = $this->last->getShortDesc();
					$this->available_classes[$this->current_class]->members[] = $member;
				}
			break;
			case "function":
			break;
		}

	}
	
	function getwsdl()
	{
		echo $this->wsdl->dumpmem();
		
/*****************************************
				if($this->wsdl_porttype == null)
					$this->wsdl_porttype = $this->wsdl_root->new_child("portType","");
				if($this->wsdl_binding == null)
				{
					$this->wsdl_binding = $this->wsdl_root->new_child("binding","");
					$soap = $this->wsdl_binding->new_child("soap:binding", "");
					$soap->set_attribute("style", "rpc");
					$soap->set_attribute("transport", "http://schemas.xmlsoap.org/soap/http");
				}
				
				if($this->wsdl_service == null)
				{
					$this->wsdl_service = $this->wsdl_root->new_child("service", "");
					$this->wsdl_service->set_attribute("name", "changeMe");
					$port = $this->wsdl_service->new_child("port", "");
					$port->set_attribute("binding", "changeMe");
					$port->set_attribute("name", "changeMe");
					$soap = $port->new_child("soap:address", "");
					$soap->set_attribute("location", "changeMe");
				}
				
				$function_name = $data->store['name'];
				$operation = $this->wsdl_porttype->new_child("operation", "");
				$operation->set_attribute("name", $function_name);
				
				$bindoper = $this->wsdl_binding->new_child("operation", "");
				$bindoper->set_attribute("name", $function_name);
				
				$soapoper = $bindoper->new_child("soap:operation", "");
				$soapoper->set_attribute("soapAction", $function_name);
				$soapoper->set_attribute("style", "rpc");
								
				if($this->last->store['sdesc'])
					$operation->new_child("documentation", trim($this->last->store['sdesc']));
					
				if($this->last->store['params'])
				{
					$params = $this->last->store['params'];
					$keys = array_keys($params);

					$operation->set_attribute("parameterOrder", implode(" ", $keys));
					$input = $operation->new_child("input","");
					$input->set_attribute("name", $function_name . "In");
					$input->set_attribute("message", $function_name . "In");
					
					$bindin = $bindoper->new_child("input", "");
					$bindin->set_attribute("name", $function_name . "In");
					$soapbody = $bindin->new_child("soap:body", "");
					$soapbody->set_attribute("use", "encoded");
					$soapbody->set_attribute("encodingStyle", "http://schemas.xmlsoap.org/soap/encoding/");
										
					$message = $this->wsdl_root->new_child("message","");
					$message->set_attribute("name", $function_name . "In");
					foreach($keys as $key)
					{
						$part = $message->new_child("part","");
						$part->set_attribute("name", $key);
						$tmp = split("[[:space:]]", $params[$key]);
						$part->set_attribute("type", $tmp[0]);
						if(sizeof($tmp) > 1)
							$part->new_child("documentation", trim(implode(" ", array_slice($tmp,1))));
					}
				}
				
				if($this->last->store['data']['return'])
				{
					$params = $this->last->store['data']['return'];
					$input = $operation->new_child("output","");
					$input->set_attribute("name", $function_name . "Out");
					$input->set_attribute("message", $function_name . "Out");

					$bindout = $bindoper->new_child("output", "");
					$bindout->set_attribute("name", $function_name . "Out");
					$soapbody = $bindout->new_child("soap:body", "");
					$soapbody->set_attribute("use", "encoded");
					$soapbody->set_attribute("encodingStyle", "http://schemas.xmlsoap.org/soap/encoding/");

					$message = $this->wsdl_root->new_child("message","");
					$message->set_attribute("name", $function_name . "Out");
					$part = $message->new_child("part","");
					$tmp = split("[[:space:]]", $params[0]);
					$part->set_attribute("type", $tmp[0]);
					$part->set_attribute("name", "Result");
					if(sizeof($tmp) > 1)
						$part->new_child("documentation", trim(implode(" ", array_slice($tmp,1))));
				}
**********************************************/



	}
}
?>