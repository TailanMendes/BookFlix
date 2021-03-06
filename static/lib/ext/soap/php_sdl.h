#ifndef PHP_SDL_H
#define PHP_SDL_H

#define XSD_WHITESPACE_COLLAPSE 1
#define XSD_WHITESPACE_PRESERVE 1
#define XSD_WHITESPACE_REPLACE 1

struct _sdl
{
	HashTable *functions;	//array of SoapFunctionsPtr
	HashTable *types;		//array of sdlTypesPtr
	HashTable *encoders;	//array of encodePtr
	char *location;
	char *target_ns;
	char *source;
};

struct _sdlRestrictionInt
{
	int value;
	char fixed;
	char *id;
};

struct _sdlRestrictionChar
{
	char *value;
	char fixed;
	char *id;
};

struct _sdlRestrictions
{
	HashTable *enumeration;				//array of sdlRestrictionCharPtr
	sdlRestrictionIntPtr minExclusive;
	sdlRestrictionIntPtr minInclusive;
	sdlRestrictionIntPtr maxExclusive;
	sdlRestrictionIntPtr maxInclusive;
	sdlRestrictionIntPtr totalDigits;
	sdlRestrictionIntPtr fractionDigits;
	sdlRestrictionIntPtr length;
	sdlRestrictionIntPtr minLength;
	sdlRestrictionIntPtr maxLength;
	sdlRestrictionCharPtr whiteSpace;
	sdlRestrictionCharPtr pattern;
};

struct _sdlType
{
	char *name;
	char *namens;
	int nullable;
	int min_occurs;
	int max_occurs;
	HashTable *elements;				//array of sdlTypePtr
	HashTable *attributes;				//not sure yet
	sdlRestrictionsPtr restrictions;
	encodePtr encode;
};

struct _sdlParam
{
	int order;
	encodePtr encode;
	char *paramName;
};

struct _sdlFunction
{
	int enabled;

	char *functionName;

	char *requestName;
	HashTable *requestParameters;		//array of sdlParamPtr
	char *responseName;
	HashTable *responseParameters;		//array of sdlParamPtr (this should only be one)
	char *soapAction;
};

sdlPtr get_sdl(char *uri);
sdlPtr load_wsdl(char *struri);
int load_sdl(char *struri, int force_load);
int load_ms_sdl(char *struri, int force_load);

encodePtr get_encoder_from_prefix(sdlPtr sdl, xmlNodePtr data, char *type);
encodePtr get_encoder(sdlPtr sdl, char *ns, char *type);
encodePtr get_encoder_ex(sdlPtr sdl, char *nscat);
encodePtr get_create_encoder(sdlPtr sdl, sdlTypePtr cur_type, char *ns, char *type);
encodePtr create_encoder(sdlPtr sdl, sdlTypePtr cur_type, char *ns, char *type);

xmlNodePtr sdl_convert_xml(encodeType enc, zval* data);

void delete_type(void *type);
#endif

