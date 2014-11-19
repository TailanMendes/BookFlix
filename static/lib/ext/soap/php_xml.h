#ifndef PHP_SOAP_XML_H
#define PHP_SOAP_XML_H

xmlAttrPtr get_attribute(xmlAttrPtr node,char *name);
xmlNodePtr get_node(xmlNodePtr node,char *name);
xmlNodePtr get_node_recurisve(xmlNodePtr node,char *name);
xmlNodePtr get_node_with_attribute(xmlNodePtr node, char *name, char *attribute, char *value);
xmlNodePtr get_node_with_attribute_recursive(xmlNodePtr node, char *name, char *attribute, char *value);
int parse_namespace(char *inval,char **value,char **namespace);
xmlNodePtr check_and_resolve_href(xmlNodePtr data);

#endif
