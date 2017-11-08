<?php

namespace Us\SymremedyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Us\SymremedyBundle\Entity\Container\Container;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ContainerController extends Controller
{
    /**
     * @Route("/symremedy/container/create")
     */
    public function createAction()
    {
	$em = $this->getDoctrine()->getManager();
	$container = new Container();
	$container->setName('TIC 1');
	$container->setDescription('Laboratorio TIC 1');
	$container->setCapacity(25);
	$em->persist($container);
	$em->flush();
	return new Response('Saved new container with id '.$container->getId());
    }

    /**
     * @Route(
     *     "/symremedy/container/{id}/delete",
     *     requirements={"id": "\d+"}
     * )
     */
    public function deleteAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$container = $em->getRepository(Container::class)->find($id);
        if (!$container) {
            throw $this->createNotFoundException('No container found for id '.$id);
        }
	$em->remove($container);
	$em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route(
     *     "/symremedy/container/{id}/show",
     *     requirements={"id": "\d+"}
     * )
     */
    public function showAction($id)
    {
	$container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        if (!$container) {
            throw $this->createNotFoundException('No container found for id '.$id);
        }
        return $this->render('UsSymremedyBundle:Container:show.html.twig',
                      array('container' => $container));
    }

    /**
     * @Route(
     *     "/symremedy/container/list/{order}",
     *     defaults={"order": "ASC"},
     *     requirements={"order": "ASC|DESC"}
     * )
     */
    public function listAction($order)
    {
        if ($order !== 'ASC' and $order !== 'DESC') {
            throw $this->createNotFoundException('List order must be ASC or DESC');
        }
        $containers = $this->getDoctrine()->getRepository(Container::class)->findBy(
                      array(), array('name' => $order));
        return $this->render('UsSymremedyBundle:Container:list.html.twig',
                      array('containers' => $containers));
    }

    /**
     * Route /symremedy/container/{id}/resource/{create}
     */

    /**
     * Route /symremedy/resource/{id}/delete
     */

}
