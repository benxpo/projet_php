<?php

/* ComicReaderAdminBundle:Default:one_page.html.twig */
class __TwigTemplate_67aa45f9c439fec17760a03c94f37893 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "pages"));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 3
            echo "        <div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "page"), "id"), "html", null, true);
            echo "\" class=\"comic_image_box\" >
\t    <!--<img src=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl(("bundles/books/" . $this->getAttribute($this->getContext($context, "page"), "path"))), "html", null, true);
            echo "\" alt=\"\" />-->
            ";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "page"), "path"), "html", null, true);
            echo "
        </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "ComicReaderAdminBundle:Default:one_page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
