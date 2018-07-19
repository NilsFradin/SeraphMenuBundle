Templates
=========

You can override all templates in this bundle with twig block.

We can find to part of templates :

Back
----

All the templates for the back extend 'base.html.twig' and they contains different type of block.

- base.html.twig :

    ```html.twig
    <html>
        <head>
            <meta charset="UTF-8">

            <title>{% block title %} ... {% endblock %}</title>
            
            {% block stylesheets %} ... {% endblock %}
            
        </head>
        <body>
            {% block body %} ... {% endblock %}
            
            {% block javascripts %} ... {% endblock %}
        </body>
    </html>
    ```

- menu/list.html.twig :

    ```html.twig
    {% block title %} ... {% endblock %}
    
    {% block body %}        
        <table {% block table_attr %} ... {% endblock %}> 
    
            {% block thead %} ... {% endblock %}
            
            {% block tbody %} 
                ...
                {% block tbody_actions %} ... {% endblock %}
                ...
                {% block tbody_noResults %} ... {% endblock %}
                ...
            {% endblock %}
        
        </table>
        {% block page_actions %} ... {% endblock %}
    {% endblock %}
    ```

- menuItem/list.html.twig :  

    ```html.twig
    {% block title %} ... {% endblock %}
    
    {% block stylesheets %} ... {% endblock %}
    
    {% block body %}
        
        {% block button_valid %} ... {% endblock %}
        
        {% block form %}    
            <table {% block table_attr %} ... {% endblock %}> 
                ... 
            </table>
                     
            {% block page_actions %} ... {% endblock %}
            
        {% endblock %}
        
    {% endblock %}
    ```
    
    The block architecture of this template isn't totaly the same.
    In this templates you can override one block stylesheets, button valide, form, under this block, the architecture is the same.

- modify.html.twig

    ```html.twig
    {% block title %} ... {% endblock %}
        
    {% block body %}
        {% block form_fields %} ... {% endblock %}
        
        {% block form_actions %} ... {% endblock %}
     
    {% endblock %}          
    ```

    The templates menu/modify.html.twig add menuItem/modify.html.twig have the same block architecture.

Front
----- 