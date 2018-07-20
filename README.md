SeraphMenuBundle
================

SeraphMenuBunlde is the update of Id4vMenuBundle on Symfony 4.

How it works
------------

A Menu is a tree of MenuItems, this bundle allows the configuration of multiply menu.

All menus can have a different structure. With this bundle you can provide **your own template** or you can use the *default template.*

The default template use **bootstrap 4**, but you can override any parts of this to use anything else.
 
 - Menus :
    - A Collection of MenuItem.
    - A Name.

- MenuItems :
    - A label to display.
    - A link go when clicked.
    
To read more about the using of this bundle, we invite you to check the [docs](/Resources/doc)

Installation
------------

1. Install it using composer

    ```console
    $ composer require seraph/menu-bundle-2.0
    ```
2. Add routing of the bundle

    ```yaml
    # app/config/routes.yaml   

    seraph_menu:
        resource: '@SeraphMenuBundle/Controller'
        type: annotation
        prefix: '/admin' 
    ```
3. Update your database with Menu and MenuItem

    ```console
    $ php bin/console doctrine:schema:update --force
    ```
    
Documentation
-------------

You can find in this folder, how you can use the bundle :

- [Read the documentation for Routes](/Resources/doc/Routes.md)
- [Read the documentation for Twig Functions](/Resources/doc/TwigFunctions.md)
- [Read the documentation for Forms](/Resources/doc/Forms.md)
- [Read the documentation for Entities](/Resources/doc/Entities.md)
- [Read the documentation for Templates](/Resources/doc/Templates.md)
