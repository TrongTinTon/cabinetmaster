!function(a){"use strict";a(document).ready(function(){function b(){var a,b=d.find("#post_ID").val();a="admin.php?page=yellow-pencil-editor&href&wyp_page_id="+b+"&wyp_page_type="+typenow+"&wyp_mode="+c,window.open(a,"_blank")}var c="single",d=a("body"),e=a(document);window.default_global_customization_type&&(c="global"),"elementor_library"===typenow&&(c="global");var f=!("1"!==wypCurrentPageData?.is_post_type_public);0==d.hasClass("post-type-attachment")&&0<d.find("#postbox-container-1").length&&f?(d.find("#postbox-container-1").prepend("<a class='wyp-btn'><span class='dashicons dashicons-admin-appearance'></span>Edit Page - YellowPencil</a>"),e.on("click",".wyp-btn",function(){var c=a("form#post"),e=c.attr("action"),f=c.attr("method");"auto-draft"==d.find("#original_post_status").val()?(b(),d.find("#save-post").trigger("click")):b()})):d.hasClass("block-editor-page")&&window.wp.data.subscribe(function(){setTimeout(function(){if(0<d.find(".edit-post-header-toolbar").length&&0==d.find(".wyp-btn").length){var c=a("<button type=\"button\" class=\"components-button has-icon wyp-btn\"><span class=\"dashicons dashicons-admin-appearance\"></span></button>");c.on("click",function(){0<d.find(".editor-post-save-draft").length&&a(".editor-post-save-draft").trigger("click"),b()}),d.find(".edit-post-header-toolbar").append(c)}},1)})})}(jQuery);