<?php

namespace ComicReader\AdminBundle\Stuff;

use ComicReader\AdminBundle\Entity;

class FullJoinBook
{
    private $book;
    private $author;
    private $uploader;
    private $comments;
    private $stars;
    
    public function getBook()
    {
        return $this->book;
    }
    
    public function setBook($book)
    {
        $this->book = $book;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    
    public function getUploader()
    {
        return $this->uploader;
    }
    
    public function setUploader($uploader)
    {
        $this->uploader = $uploader;
    }
    
    public function getComments()
    {
        return $this->comments;
    }
    
    public function setComments($comments)
    {
        $this->comments = $comments;

        // calculate stars  
        $mark = 0;
        $n = 0;
        foreach ($comments as $c)
        {
            $mark += $c->getMark();
            $n++;
        }
        
        $this->stars = array();
        if ($n > 0)
        {
            $mark = round($mark / $n, 1);
            for (; $mark >= 1.0; $mark--)
                $this->stars[] = "full_star";
            
            if ($mark >= 0.5)
                $this->stars[] = "half_star";
        }
    }
    
    public function getStars()
    {
        return $this->stars;
    }
}
