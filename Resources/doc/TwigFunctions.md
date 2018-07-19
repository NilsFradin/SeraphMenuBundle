Twig Functions
==============

We have two utilisation with the twig function `{{ get_menu() }}`

Without template
----------------

```html.twig
{{ seraph_get_menu('slug_menu') }}
```

In this case the function use the template [_menu.html.twig](/Resources/views/front/_menu.html.twig)

With template
-------------

```html.twig
{{ seraph_get_menu('slug_menu', 'template_file') }}
```

In this case the function use the template that he found in the second parameter.