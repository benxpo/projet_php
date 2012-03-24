<?php

/* ComicReaderAdminBundle:Default:reader.html.twig */
class __TwigTemplate_9379671cd4f4010f45a03ee96d8adf64 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
    <head>
\t<title>Comic Reader</title>
        <script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-latest.min.js\"></script>
        <script type=\"text/javascript\">
\$(document).ready(
    function()
    {
        var busy = false;
\tfunction last_msg_funtion()
\t{
            var ID=\$(\".comic_image_box:last\").attr(\"id\");
            \$('div#last_image_loader').html('<img src=\"images/bigLoader.gif\">');
            \$.post(\"NextPage/42/\"+ID,
                function(data)
                {
                    if (data != \"\")
                    {
                        \$(\".comic_image_box:last\").after(data);
                    }
                
                    \$('div#last_image_loader').empty();
                });
\t};
\t    
\t\$(window).scroll(
\t    function()
\t    {
\t\tif (busy == false && \$(window).scrollTop() == \$(document).height() - \$(window).height())
\t\t{
                    busy = true;
\t\t    last_msg_funtion();
                    busy = false;
\t\t}
\t    });
    });
        </script>
    </head>
    <body>
";
        // line 40
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "pages"));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 41
            echo "        <div id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "page"), "id"), "html", null, true);
            echo "\" class=\"comic_image_box\" >
            ";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "page"), "path"), "html", null, true);
            echo "
            <img src=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/comicreaderreader/images/GLO_c106_p01.png"), "html", null, true);
            echo "\" alt=\"\" />
        </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 46
        echo "
        <div id=\"last_image_loader\"></div>
    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "ComicReaderAdminBundle:Default:reader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
