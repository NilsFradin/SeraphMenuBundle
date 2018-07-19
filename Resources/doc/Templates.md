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

If you want you can override all part of this templates.

In the normal using case you need to include bootstrap 4. But bootstrap 4 does not support dropdown, to fix it you need to include this css in your project.

```css
html, body{
    height: 100%;
}

.starter-template {
    padding: 1rem 1.5rem;
    text-align: center;
}

.bg-color{
    background-color: #333;
}

.dropdown:hover > .dropdown-menu{
    display: block;
}

.dropdown:active > .dropdown-menu{
    display: block;
}


.dropdown-submenu:hover > .dropdown-menu{
    display: block;
}


.dropdown-submenu {
    position: relative;
}


.dropdown-submenu a::after {
    transform: rotate(-90deg);
    position: absolute;
    right: 6px;
    top: .8em;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-left: .1rem;
    margin-right: .1rem;
}

```
 
If you want to override the provide template, we invite you to see the file [_menu.html.twig](/Resources/views/front/_menu.html.twig)