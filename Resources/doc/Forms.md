Forms
=====

We have three types of forms

MenuType
--------

Default data_class : Menu::class

- name : string(255)
- slug : string(255)

MenuItemOrderingType
--------------------

Default data_class : MenuItem::class

- id : int
- position : int
- depth : int
- parent : MenuItem -> label = title

MenuItemType
------------

Default data_class : MenuItem::class

- title : string(255)
- url : string(255)
- active : bool
- target : string(255) -> ChoiceType('_self', '_blank')