Twig Functions
==============

We have two utilisation with the twig function `{{ get_menu() }}`

Without template
----------------

```html.twig
{{ seraph_get_menu('slug-menu') }}
```

In this case, the function use the template [_menu.html.twig](/Resources/views/front/_menu.html.twig)

```htlm.twig
{{ seraph_get_menu_ul('slug-menu') }}
```

In this case, the function return the same templates without `<nav></nav>` tags. 

So you can create your menu with different bootstrap menus.

With template
-------------

```html.twig
{{ seraph_get_menu('slug-menu', 'template_file') }}
```

In this case, the function use the template that he found in the second parameter.