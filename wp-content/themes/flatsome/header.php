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
      
        .title-wrapper {
            height: 47px;

        }
        .price-wrapper {
            padding-top: 5px;
        }
        @media(min-width: 1024px) {
            .tab-container {
                max-width: 11em !important;
                padding: 0!important;
            }
            .tab-target-container {
                padding: 0!important;
            }
         }
         
          .loading-cat {
            opacity: 0.5;
        }
        #category-tab-container {
            background-image: linear-gradient(180deg, #6c6a6a, #3c3c3c);
            padding: 2em;
            margin-bottom: 3.5em;
        }

        #category-tab-container .filter-wrap {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }
        #category-tab-container .filter-wrap h4 {
            width: 8%;
            text-align: center;
        }
        #category-tab-container .list-filter {
            flex: 1;
            padding: 0 40px 0 15px;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: repeat(5,1fr);
            row-gap: 15px;
            -moz-column-gap: 10px;
            column-gap: 10px;
        }
        #category-tab-container .list-filter .subcategory-item {
        
            box-sizing: border-box;
            background: #363636;
            color: #fff;
            cursor: pointer;
            user-select: none;
            padding: 0.5em;
            display: flex;
            border-radius: 6px;
        }
        #category-tab-container .list-filter .subcategory-item span {
            margin: auto;
            text-align: center;
        }
        #category-tabs .active {
            font-weight: 600;
            box-shadow: 2px -1px;
            background-image: linear-gradient(327deg, #ff7700, #fa9419) !important;
        }
       
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
            flex-direction: column;
            gap: 10px;
        }
       
        a.list-chucnang {
            box-sizing: border-box;
            background: #363636;
            color: #fff;
            cursor: pointer;
            user-select: none;
            padding: 0.5em;
            display: flex;
            border-radius: 6px;
            max-width: 8em;
        }

        a.list-chucnang span {
            margin: auto;
        }
        a.list-chucnang i {
            line-height: normal;
            margin: auto;
            display: none;
        } 

        .tab-chucnang .active {
           font-weight: 600;
            box-shadow: 2px -1px;
            background-image: linear-gradient(327deg, #ff7700, #fa9419) !important;
        }
        
        .header-wrapper.stuck {
            display: block;
        }

        

        /*tab-let*/
        @media(min-width: 740px) and (max-width: 1023px){
            #category-tab-container .list-filter{
                 grid-template-columns: repeat(3,1fr);
            }
            .sticky-tab-fixed {
                position: fixed;
            } 

            .tab-chucnang .list-chucnang {
                height: 45px;
                width: 100px;
                display: flex;
            }

            .tab-chucnang .list-chucnang span {
                margin: auto;
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
            #category-tab-container .list-filter{
                grid-template-columns: repeat(2,1fr);
            }
            #category-tab-container .filter-wrap {
                display: block;
            }
            #category-tab-container .list-filter {
                padding: 0;
            }
            #category-tab-container .filter-wrap h4 {
                width: auto;
                text-align: left;
            }
            a.list-chucnang span {
               display: none;
            } 
            a.list-chucnang i {
                display: block;
            }
            .custom-product-page .product-title-container {
                max-height: none !important;
                min-width:  0px !important;
            }
            .tab-container {
                max-width: 5% !important;
            }
            .tab-panels .tab-container {
                padding: 0;
            }

            .tab-chucnang .list-chucnang {
                height: 30px;
                width: 30px;
                display: flex;
            }
            .tab-chucnang .list-chucnang span {
                margin: auto;
            }

            .sticky-tab-fixed {
                position: fixed;
            } 

            a.list-chucnang {
                padding: 0;
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
