<?php

/* ComicReaderDesignBundle:Index:index.html.twig */
class __TwigTemplate_eba60fc3680c47b53dd4eab78696ad94 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/comicreaderdesign/css/index.css"), "html", null, true);
        echo "\">
<title>Bienvenue sur ComicReader</title>
</head>
<body>
  <div id=\"main\">

\t<div id=\"ban\"><img alt=\"ComicReader\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/comicreaderdesign/images/ban.jpg"), "html", null, true);
        echo "\" /></div>

\t<div id=\"accueil\">Accueil</div>
\t<div id=\"liste\">Liste</div>
\t<div id=\"ajouter\">Ajouter</div>
\t<div id=\"recherche\">
\t  <input value=\"Rechercher\" size=\"22\" maxlength=\"255\" onFocus=\"this.value=''\"/>
          </input>
          <button type=\"button\" onclick=\"\">Rechercher</button> 
\t</div>
\t<div class=\"clear\"></div>


\t<div id=\"contenu\">
\t  <div class=\"hasard\">
\t    <div class=\"hasardTitre\">Au hasard</div>
\t    <div class=\"hasardNom\">NOM</div>
\t    <div class=\"hasardNote\">Note</div>
\t    <div class=\"hasardImage\">Image</div>
\t    <div class=\"hasardAuteur\">Auteur</div>
\t    <div class=\"hasardPseudo\">^_^ Pseudo</div>
\t  </div>
\t  <div class=\"onrecherche\">
\t    <div class=\"onrechercheTitre\">On recherche</div>
\t    <div class=\"onrechercheNumero\">1</div>
\t    <div class=\"onrechercheNumero\">2</div>
\t    <div class=\"onrechercheNumero\">3</div>
\t    <div class=\"onrechercheNumero\">4</div>
\t    <div class=\"onrechercheNumero\">5</div>
\t  </div>
\t  <div class=\"top5\">
\t    <div class=\"top5Titre\">TOP 5</div>
\t    <div class=\"top5Numero\">1</div>
\t    <div class=\"top5Numero\">2</div>
\t    <div class=\"top5Numero\">3</div>
\t    <div class=\"top5Numero\">4</div>
\t    <div class=\"top5Numero\">5</div>
\t  </div>
\t  <div class=\"sortie\">
\t    <div class=\"sortieTitre\">Les dernieres sorties</div>
\t    <div class=\"sortiePremier\">
\t      <div class=\"sortiePremierImage\">image</div>
\t      <div class=\"sortiePremierNom\">NOM</div>
\t      <div class=\"sortiePremierNote\">Note</div>
\t      <div class=\"sortiePremierAuteur\">Auteur</div>
\t      <div class=\"sortiePremierPseudo\">^_^ Pseudo</div>
\t    </div>
\t    <div class=\"sortiePremier\">
\t      <div class=\"sortiePremierImage\">image</div>
\t      <div class=\"sortiePremierNom\">NOM</div>
\t      <div class=\"sortiePremierNote\">Note</div>
\t      <div class=\"sortiePremierAuteur\">Auteur</div>
\t      <div class=\"sortiePremierPseudo\">^_^ Pseudo</div>
\t    </div>
\t    <div class=\"sortiePremier\">
\t      <div class=\"sortiePremierImage\">image</div>
\t      <div class=\"sortiePremierNom\">NOM</div>
\t      <div class=\"sortiePremierNote\">Note</div>
\t      <div class=\"sortiePremierAuteur\">Auteur</div>
\t      <div class=\"sortiePremierPseudo\">^_^ Pseudo</div>
\t    </div>
\t  </div>
\t  <div class=\"clear\"></div>
\t  <div id=\"news\">
\t    <div id=\"newsTitre\">Dernieres News</div>
\t    <div id=\"newsContenu\">21-02-2012 : orem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultrices nisl sit amet libero vestibulum augue placerat eu tempus elit dictum. Donec ullamcorper ornare ipsum vitae semper. Curabitur mollis molestie accumsan. Maecenas ut nisi i !</div>
\t  </div>
\t</div>
  </div>
</body>
</html>

";
    }

    public function getTemplateName()
    {
        return "ComicReaderDesignBundle:Index:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
