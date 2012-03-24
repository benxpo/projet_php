<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // ComicReader_accueil
        if (rtrim($pathinfo, '/') === '/ComicReader') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'ComicReader_accueil');
            }
            return array (  '_controller' => 'ComicReader\\DesignBundle\\Controller\\DefaultController::indexAction',  '_route' => 'ComicReader_accueil',);
        }

        // comicreader_admin_default_index
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+?)$#xs', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ComicReader\\AdminBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'comicreader_admin_default_index'));
        }

        // comicreader_admin_default_reader
        if ($pathinfo === '/reader') {
            return array (  '_controller' => 'ComicReader\\AdminBundle\\Controller\\DefaultController::readerAction',  '_route' => 'comicreader_admin_default_reader',);
        }

        // comicreader_admin_default_nextpage
        if (0 === strpos($pathinfo, '/nextpage') && preg_match('#^/nextpage/(?P<bookid>[^/]+?)/(?P<lastpageid>[^/]+?)$#xs', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'ComicReader\\AdminBundle\\Controller\\DefaultController::nextPageAction',)), array('_route' => 'comicreader_admin_default_nextpage'));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
