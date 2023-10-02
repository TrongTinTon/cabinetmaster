<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>" style="
    scroll-behavior: smooth;
"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<style>

	    .tab-chucnang {
            position: sticky;
            width: 100%;
            justify-content: flex-start;
            top: 0px;
            z-index: 3;
            font-weight: 600;
            text-align: center;
            display: flex;
            flex-wrap: nowrap;
            padding-top: 5px;
            
        }
	   
	    a.list-chucnang {
            box-sizing: border-box;
            padding: 10px 30px;
            background: #f96d00;
            color: white;
            margin-left: 5px;
            border-radius: 5px;
        }
	    
	    .header-wrapper.stuck {
	        display: block;
        }
        .product-small.box {
            height: 325px;
        }
        

        /*tab-let*/
        @media(min-width: 740px) and (max-width: 1023px){
            .tab-chucnang {
            position: fixed;
            margin-left: 0px;
           }
           
           a.list-chucnang {
            padding: 0px 0px;
           }
           
           .header .flex-row {
            height: 100%;
            background-color: #2d2d2d;
            }
            
            .product-small.box {
            height: 215px;
            }
        }
        
        /*mobie*/
        @media(max-width: 740px){
           .tab-chucnang {
                margin-left: 0px;
                position: fixed;
                margin-right: 20px;
           } 
           a.list-chucnang {
                padding: 5px 10px;
                font-size: 14px;
                
           }
           .header .flex-row {
                height: 100%;
                background-color: #2d2d2d;
            }
            
            .product-small.box {
            height: 215px;
            }
        }
        
        h1.product-title.product_title.entry-title {
            font-size: 25px;
            color: #f96d00;
            padding: 0px 0px 20px 0px;
        }
        
	</style>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'flatsome_after_body_open' ); ?>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>

<div id="wrapper">

	<?php do_action( 'flatsome_before_header' ); ?>

	<header id="header" class="header <?php flatsome_header_classes(); ?>">
		<div class="header-wrapper">
			<?php get_template_part( 'template-parts/header/header', 'wrapper' ); ?>
		</div>
	</header>

	<?php do_action( 'flatsome_after_header' ); ?>

	<main id="main" class="<?php flatsome_main_classes(); ?>">
