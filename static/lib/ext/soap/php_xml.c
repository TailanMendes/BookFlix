#include "php_soap.h"

xmlAttrPtr get_attribute(xmlAttrPtr node,char *name)
{
	xmlAttrPtr trav = node;
	if(node == NULL) return NULL;
	do
	{
		if(strcmp(trav->name,name) == 0)
		{
			return trav;
		}
	}while(trav = trav->next);
	return NULL;
}

xmlNodePtr get_node(xmlNodePtr node,char *name)
{
	xmlNodePtr trav = node;
	if(node == NULL) return NULL;
	do
	{
		if(strcmp(trav->name, name) == 0)
		{
			return trav;
		}
	}while(trav = trav->next);
	return NULL;
}

xmlNodePtr get_node_recurisve(xmlNodePtr node, char *name)
{
	xmlNodePtr trav = node;
	if(node == NULL) return NULL;
	do
	{
		if(strcmp(trav->name, name) == 0)
		{
			return trav;
		}
		else
		{
			if(node->children != NULL)
			{
				xmlNodePtr tmp;
				tmp = get_node_recurisve(node->children, name);
				if(tmp)
					return tmp;
			}
		}
	}while(trav = trav->next);
	return NULL;
}

xmlNodePtr get_node_with_attribute(xmlNodePtr node, char *name, char *attribute, char *value)
{
	xmlNodePtr trav = node, cur;
	xmlAttrPtr attr;

	if(node == NULL) return NULL;
	do
	{
		if(name != NULL)
		{
			cur = get_node(trav, name);
			if(!cur)
				return cur;
		}
		else
			cur = trav;

		attr = get_attribute(cur->properties, attribute);
		if(attr != NULL && strcmp(attr->children->content, value) == 0)
			return cur;
		else
		{
			if(cur->children != NULL)
			{
				xmlNodePtr tmp;
				tmp = get_node_with_attribute(cur->children, name, attribute, value);
				if(tmp)
					return tmp;
			}
		}
	}while(trav = trav->next);
	return NULL;
}

xmlNodePtr get_node_with_attribute_recursive(xmlNodePtr node, char *name, char *attribute, char *value)
{
	xmlNodePtr trav = node, cur;
	xmlAttrPtr attr;

	if(node == NULL) return NULL;
	do
	{
		if(name != NULL)
		{
			cur = get_node_recurisve(trav, name);
			if(!cur)
				return cur;
		}
		else
			cur = trav;

		attr = get_attribute(cur->properties, attribute);
		if(attr != NULL && strcmp(attr->children->content, value) == 0)
			return cur;
		else
		{
			if(cur->children != NULL)
			{
				xmlNodePtr tmp;
				tmp = get_node_with_attribute_recursive(cur->children, name, attribute, value);
				if(tmp)
					return tmp;
			}
		}
	}while(trav = trav->next);
	return NULL;
}

xmlNodePtr check_and_resolve_href(xmlNodePtr data)
{
	xmlAttrPtr href;
	xmlNodePtr ret = data;

	if(!data || !data->properties)
		return ret;

	href = get_attribute(data->properties, "href");
	if(href)
	{
		// Internal href try and find node
		if(href->children->content[0] == '#')
		{
			ret = get_node_with_attribute_recursive(data->doc->children, NULL, "id", &href->children->content[1]);
		}
		// External href....?
	}

	return ret;
}

int parse_namespace(char *inval, char **value, char **namespace)
{
	char *found = strchr(inval, ':');

	if(found != NULL)
	{
		(*namespace) = estrndup(inval, found - inval);
		(*value) = estrdup(++found);
	}
	else
	{
		(*value) = estrdup(inval);
		(*namespace) = NULL;
	}

	return FALSE;
}

