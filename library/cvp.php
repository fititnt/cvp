<?php
/*
 * @package         cURLVisualProxy
 * @author          Emerson Rocha Luiz ( emerson@webdesign.eng.br - @fititnt -  http://fititnt.org )
 * @copyright       Copyright (C) 2005 - 2011 Webdesign Assessoria em Tecnologia da Informacao.
 * @license         MIT License. See license.txt
 * @version         0.1alpha
 */

class cvp {
    
    
    /*
     * 
     * var      int
     */
    private $url;
    
    /*
     * Initialize values
     */
   function __construct()
    {
       //
    }    
    
    /*
     * Delete (set to NULL) generic variable
     * 
     * @var        string          $name: name of var to return
     *
     * return       object          $this
     */
    public function del( $name )
    {
        $this->$name = NULL;
        return $this;
    }
    
    /*
     * Return generic variable
     * 
     * @var        string          $name: name of var to return
     *
     * return       mixed          $this->$name: value of var
     */
    public function get( $name )
    {
        return $this->$name;
    }
    
    /*
     * Set one generic variable the desired value
     * 
     * @var        string          $name: name of var to return
     *
     * return       object          $this
     */
    public function set( $name, $value )
    {
        $this->$name = $value;
        return $this;
    }
    
    /*
     * Get current URL
     * 
     * @return      string      $url
     */
    public function getUrl()
    {
        $url = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $url .= htmlentities( $_SERVER['SERVER_NAME'] .$_SERVER['REQUEST_URI'] );
        return $url;
    }
    
    /*
     * Get current URL
     * If $_GET variable exist, but is empty or equals to 0, will return this 
     * value
     * 
     * @var         string      $name Name of param to return
     * 
     * @return      string      $url
     */
    public function getUrlVar( $name )
    {
        $value = isset($_GET[$name]) ? $_GET[$name] : NULL;
        return $value;
    }
  
    /*
     * Delete one variable of one URL
     * 
     * @var         string      $name Name of param to return     * 
     * @var         string      $url URL to edit. If NULL, will use current URL     * 
     * @return      string      $url The changed URL
     */
    public function delUrlVar( $name , $url = NULL)
    {
        if( $url === NULL){
            $url = $this->getUrl();
        }
        //@todo: solve 'bug' when variable exist, but is not equals to something
        $url  = preg_replace('/([?&])'.$name.'=[^&]+(&|$)/','$1',$url);

        return $url;
    }
    
    /*
     * Return IPv4 of URL
     * @var         string      $url
     * @return      string
     */
    public function getUrlIp( $url )
    {         
        //@todo: rework this funcion later. It is not the best way to do it
        $ip = gethostbyname( $url );
        return $ip;
    }
    
    /*
     * Return contents of url, parsed
     * @var         string      $url
     * @return      string
     */
    public function getRemoteContent( $url )
    {         
        //if ( !isset($url) OR $url != ''){
        //    return 'Please add URL, like in ' . $this->getUrl() . '?url=http://www.fititnt.org';
        //}
        
        $remote = $this->_getUrlContents( $url );
        return $remote;
    }
    
    /*
     * Return contents of url
     * @var         string      $url
     * @var         string      $certificate path to certificate if is https URL
     * @return      string
     */
    protected function _getUrlContents($url, $certificate = FALSE)
    {         
        $ch = curl_init(); //Inicializar a sessao           
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Retorne os dados em vez de imprimir em tela
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate);//Check certificate if is SSL, default FALSE
        curl_setopt($ch, CURLOPT_URL, $url);//Setar URL
        $content = curl_exec($ch);//Execute
        curl_close($ch);//Feche 
        return $content;
    }
    
    /*
     * Set Relative URL to absolute URL
     * 
     * @return
     */
    protected function _setUrlRelativeToAbsolute()
    {         
        //@todo: do it       
    }
    
   
    /*
     * Function to debug $this object
     *
     * @var       string        $method: print_r or, var_dump
     * @var       boolean       $format: true for print <pre> tags. Default false
     * @return       void
     */
    public function debug( $method = 'print_r', $format = FALSE )
    {
        if ($format){
            echo '<pre>';
        }
        if ($method === 'print_r'){
            print_r( $this );
        } else {
            var_dump( $this );
        }
        if ( $format ){
            echo '</pre>';
        }
    }
        
}