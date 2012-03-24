<?php
	use ComicReader\AdminBundle\Entity\T_User.php;
	use ComicReader\AdminBundle\Entity\Book.php;
	use ComicReader\AdminBundle\Entity\Mark.php;
	use ComicReader\AdminBundle\Entity\Category.php;
	use ComicReader\AdminBundle\Entity\Author.php;
	/*
	* Classe ayant pour but de fournir des fonctions d'ajout/modification/suppression
	*/
	class stuff
	{
		public static function AddUser($login, $password, $IA, $IM)
		{
			$user = new T_User;
			$user->setLogin($login);
			$user->setis_Admin($IA);
			$user->setis_Mod($IM);
			$user->setPassword($password);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);$em->flush();
		}

		public static function AddAuthor($name)
		{
			$author = new Author();
			$author->setName($name);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($author);$em->flush();
		}

		public static function AddCategory($name, $comment)
		{
			$cat = new Category();
			$cat->setName($name);
			$cat->setComment($comment);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($cat);$em->flush();
		}

		public static function AddMark($mark, $comment, $FKU, $FKB)
		{
			$mark = new Mark();
			$mark->setMark($mark);
			$mark->setComment($comment);
			$mark->setFK_Book($FKB);
			$mark->setFK_User($FKU);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($mark);$em->flush();
		}

		public static function AddBook($valid, $path, $title, $desc, $FKU, $FKA, $FKC)
		{
			$book = new Book();
			$book->setValidated($valid);
			$book->setServerPath($path);
			$book->setTitle($title);
			$book->setDescription($desc);
			$book->setFK_User($FKU);
			$book->setFK_Author($FKA);
			$book->setFK_Category($FKC);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($book);$em->flush();
		}

		public static function ModUser($id,$prop, $value)
		{
			$u = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:T_User')->find($id);
			$u->set$prop($value);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($u);$em->flush();
		}

		public static function ModAuthor()
		{
			$u = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:Author')->find($id);
			$u->set$prop($value);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($u);$em->flush();
		}

		public static function ModCategory()
		{
			$u = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:Category')->find($id);
			$u->set$prop($value);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($u);$em->flush();
		}

		public static function ModMark()
		{
			$u = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:Mark')->find($id);
			$u->set$prop($value);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($u);$em->flush();
		}

		public static function ModBook()
		{
			$u = $this->getDoctrine()->getRepository('ComicReaderAdminBundle:Book')->find($id);
			$u->set$prop($value);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($u);$em->flush();
		}

		public static function DelUser()
		{
		}

		public static function DelAuthor()
		{
		}

		public static function DelCategory()
		{
		}

		public static function DelMark()
		{
		}

		public static function DelBook()
		{
		}
	}
