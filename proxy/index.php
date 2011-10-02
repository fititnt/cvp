<?php
/*
 * @package         cURLVisualProxy
 * @author          Emerson Rocha Luiz ( emerson@webdesign.eng.br - @fititnt -  http://fititnt.org )
 * @copyright       Copyright (C) 2005 - 2011 Webdesign Assessoria em Tecnologia da Informacao.
 * @license         MIT License. See license.txt
 * @version         0.1alpha
 */

include_once '../library/cvp.php';
$cvp = new cvp;

if ( $cvp->getUrlVar('remote') === NULL ){
?>
<!DOCTYPE HTML>
<html>
<head>
    <style>
        body { margin:0;padding:0;}
        #info {position: fixed;bottom: 20px;z-index: 1069;text-align: center;width: 100%;padding: 5px;background-color: #ccc;}
    </style>
</head>
</style>
<body>
    <div id="result">
    <iframe id="site" src="<?php echo $cvp->delUrlVar( 'url' , $cvp->getUrl() ) . 'remote=' . $cvp->getUrlVar('url') ;?>" width="100%" frameborder="0"> </iframe>
    <div id="info">
        URL: <a target="_blank" href="<?php echo $cvp->getUrlVar('url'); ?>"><?php echo $cvp->getUrlVar('url'); ?></a> 
        <!--IP: <?php echo $cvp->getUrlIp('url'); ?>-->
    </div>
    </div>
    <script>
        function getDocHeight() { //http://james.padolsey.com/javascript/get-document-height-cross-browser/
            var D = document;
            return Math.max(
                Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
                Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
                Math.max(D.body.clientHeight, D.documentElement.clientHeight)
            );
        }
        (document.getElementById('site').setAttribute('height', (getDocHeight() - 10) ))
    </script>
</body>
</html>
<?php
} else {
    echo $cvp->getRemoteContent( $cvp->getUrlVar('remote') );
}?>