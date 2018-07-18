SeraphMenuBundle
================

SeraphMenuBunlde is the update of Id4vMenuBundle on Symfony 4.

How it works
------------

A Menu is a tree of MenuItems.

 - Menus :
    - A Collection of MenuItem.
    - A Name.

- MenuItems :
    - A label to display.
    - A link go when clicked.

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
    
Documentation
-------------

You can find in this folder, how you can use the bundle :

- [Read the documentation for Routes](/Resources/doc/Routes.md)
- [Read the documentation for Twig Functions](/Ressources/doc/TwigFunctions.md)
- [Read the documentation for Forms](/Resources/doc/Forms.md)
- [Read the documentation for Entities](/Resources/doc/Entities.md)