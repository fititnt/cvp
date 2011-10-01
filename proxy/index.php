<?php
/* Simple cURL Proxy
 * Author       Emerson Rocha Luiz
 * URL          http://fititnt.org
 * 
 */

function getUrlContents($url, $certificate = FALSE){           
    $ch = curl_init(); //Inicializar a sessao           
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Retorne os dados em vez de imprimir em tela
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate);//Check certificate if is SSL, default FALSE
    curl_setopt($ch, CURLOPT_URL, $url);//Setar URL
    $content = curl_exec($ch);//Execute
    curl_close($ch);//Feche          

    return $content;
}

if ( isset($_GET['go']) )  {
    echo str_replace('http://', 'http://localhost/app/curlproxy/curlproxy.php?url=http://', getUrlContents($_GET['go']) );
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
</head>
</style>
<body>
    <iframe id="site" src="<?php echo 'curlproxy.php?go='. $_GET['url'];?>" width="100%" frameborder="0"> </iframe>    
    <script>
        function getDocHeight() { //http://james.padolsey.com/javascript/get-document-height-cross-browser/
            var D = document;
            return Math.max(
                Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
                Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
                Math.max(D.body.clientHeight, D.documentElement.clientHeight)
            );
        }
        (document.getElementById('site').setAttribute('height', getDocHeight()))
    </script>
</body>
</html>
<?php } ?>