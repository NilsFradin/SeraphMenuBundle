Entities
========

We have to type of entities : 

Menu
----

Attributes :
- \# id : int
- \# name : string(255)
- \# slug : string(255) + @Gedmo\Slug
- \# items : ArrayCollection + OneToMany on MenuItem


Functions :
- \+ __construct()
- \+ get() and set()
- \+ removeItem(MenuItem)
- \+ addItem(MenuItem) 
- \+ __toString()

MenuItem
--------

Attributes :
- \# id : int
- \# title : string(255)
- \# url : string(255)
- \# active : bool
- \# target : string(255)
- \# position : int
- \# depth : int
- \# parents : ManyToOne on MenuItem
- \# childrens : ArrayCollection + OneToMany MenuItem
- \# menu : ManyToOne on Menu


Functions :
- \+ __construct()
- \+ get() and set()
- \+ removeChildren(MenuItem)
- \+ addChildren(MenuItem)