SeraphMenuBundle
================

SeraphMenuBunlde is the update of Id4vMenuBundle on Symfony 4.

How it works
------------

A Menu is a tree of MenuItems.

Menus :
* A Collection of MenuItem.
* A Name.

MenuItems :
* A label to display.
* A link go when clicked.

Installation
------------

1. Install it using composer

    ```console
    $ composer require ...
    ```
2. Add routing of the bundle

    ```yaml
    # app/config/routes.yaml   


    seraph_menu:
        resource: '@SeraphMenuBundle/Controller'
        type: annotation
    ```
3. Update your database with Menu and MenuItem

    ```console
    $ php bin/console doctrine:schema:update --force
    ```
    
Usage
-----


1. Create your menu in the admin of your website
2. Organize your menu by adding MenuItems, drag and dropping them
3. Render your Menu in twig templates
4. Full exemple of implementation

    ```html
    {{ get_menu(<slug-menu>) }}
    ```
    Or
    ```html
    {{ get_menu(<slug-menu>, <template>) }}
    ```