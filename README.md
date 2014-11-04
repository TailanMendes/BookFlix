Project BookFlix
=====================

Information about tools used: 
--------------------
 - Python 2.7 
 - Django Framework
 - Rest_framework and other "plugin"
    see how:  <a href="http://www.django-rest-framework.org" target="blank" title="Django Rest Framework"> Rest_Framework</a>
```html

User linux:
 If will run on linux, the files *.bat can be replaced for: 

  *start_site.bat -->> $ manage.py runserver
  *create_database.bat -->> $ <font color="red">manage.py syncdb</font>
  
 Request data via JSON:
  
 Example in HTML:
  <form action="http://localhost:8000/rest_excluir/1/" enctype="multipart/form-data" method="post">  
    <input name="_method" value="DELETE" />
  </form> 
 
</div> 
```