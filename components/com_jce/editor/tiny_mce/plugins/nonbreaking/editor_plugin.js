/* jce - 2.9.2 | 2021-01-28 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2020 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){tinymce.create("tinymce.plugins.Nonbreaking",{init:function(ed,url){var t=this;t.editor=ed,ed.addCommand("mceNonBreaking",function(){ed.execCommand("mceInsertContent",!1,ed.plugins.visualchars&&ed.plugins.visualchars.state?'<span data-mce-bogus="1" class="mce-item-hidden mce-item-nbsp">&nbsp;</span>':"&nbsp;")}),ed.addButton("nonbreaking",{title:"nonbreaking.desc",cmd:"mceNonBreaking"}),ed.getParam("nonbreaking_force_tab")&&ed.onKeyDown.add(function(ed,e){9==e.keyCode&&(e.preventDefault(),ed.execCommand("mceNonBreaking"),ed.execCommand("mceNonBreaking"),ed.execCommand("mceNonBreaking"))}),ed.addShortcut("ctrl+shift+32","nonbreaking.desc","mceNonBreaking")}}),tinymce.PluginManager.add("nonbreaking",tinymce.plugins.Nonbreaking)}();