<?php
/**
* Template Name: WPCPM - Design Review
*/
$GLOBALS["WPCM_id"] = get_id_from_slug('design-review');
?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Design Review Page</title>
        <style>
                main {position: initial !important;}
        header.banner { display: none;}
        .content-info .container {display: none;}
        #approval_overlay {display: block;}
        .text-center {
        position: absolute;
        top:1em;
        left:0em;
        width:100%;
        z-index: 1;
        }
        .content-tab {
        display: none !important;
        }
        #prev,
        #next {
        position: absolute;
        z-index: 9999;
        right: 0px;
        color: rgba(0, 0, 0, 0);
        font-size: 5em;
        height: 100%;
        line-height: 8em;
        transition: 0.3s ease all;
        cursor: pointer;
        }
         #prev {
            right: auto;
            left:0px;
         }
        #prev:hover,
        #next:hover {
            color: #fff;
            transition: 0.3s ease all;
            background: rgba(0,0,0,0.5);
        }
        .design-img {
            width: 100% !important;
            height: auto !important
        }
        .page-spacer {
             padding: 3em 0;
  width: 100%;
  text-align: center;
  font-weight: bold;
  font-size: 2em;
  color: #FFF;
  background: #000;
  display: block;
  border: 4px solid #F00;
        }
        </style>
        <script type='text/javascript'>
        <?php //get bugherd ?>
        </script>
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        $url = $_SERVER[REQUEST_URI];
        // debug($url);
        $v_boom = explode('v=',$url)[1];
        // debug($v_boom);
        $v = explode('?',$v_boom)[0];
        // debug($v);
        $page = explode('page=',$url)[1];
        // debug($page);
        $designs = get_field('design',$GLOBALS['WPCM_id']);
        // echo "Designs";
        // debug($designs);
        $count = count(get_field('design',$GLOBALS['WPCM_id'])[0]['file']);
        // debug("Count".$count);
        $max_page = count(get_field('design',$GLOBALS['WPCM_id'])[$v]['file'])-1;
        // debug("Max Pages".$max_page);
        
        ?>
        <div class="text-center">
        <?php for ($i=0; $i < $count; $i++) { ?>
            <img class="design-img" style="width:100%" src="<?php echo get_field('design',$GLOBALS['WPCM_id'])[$v]['file'][$i]['url']; ?>" alt="">
            <span class="page-spacer"> NEXT PAGE BELOW </span>
        <?php } ?>
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script>
          function nextImg(max){
            $('img').click(function(event) {
            var current;
            var new_url;
            current = window.location.href
            if(max != <?php echo $page ?>){
            new_url = window.location.href.split('page=')[0]+"page="+"<?php echo $page+1 ?>";
            } else {
            new_url = window.location.href.split('page=')[0]+"page="+<?php echo 0 ?>;
            }
            console.log(new_url)
            document.location.href = new_url;
            });
            }
         // nextImg(<?php echo $max_page ?>);
       
        </script>

    </body>
</html>