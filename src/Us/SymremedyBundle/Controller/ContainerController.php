<?php

namespace Us\SymremedyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Us\SymremedyBundle\Entity\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ContainerController extends Controller
{
    /**
     * @Route("/symremedy/container/create", defaults={"id" = 0});
     * @Route("/symremedy/container/{id}/create", requirements={"id" = "\d+"});
     */
    public function createAction(int $id = 0, Request $request)
    {
        $response = null;
	$container = new Container();
        $parentName = '';
        // Check parent.
	$em = $this->getDoctrine()->getManager();
        if ($id != 0)
        {
	    $parent = $em->getRepository(Container::class)->find($id);
            if ($parent)
            {
                $parentName = $parent->getName();
            } else
            {
                throw $this->createNotFoundException('No container found for parent id'.$id);
            }
        }
        // Create form.
	$form = $this->createFormBuilder($container)
                     ->add('name', TextType::class, array('label' => 'Nombre: '))
                     ->add('description', TextType::class, array('label' => 'Descripción: '))
                     ->add('capacity', IntegerType::class, array('label' => 'Aforo: '))
                     ->add('save', SubmitType::class, array('label' => 'Crear espacio'))
                     ->getForm();
        // Process request.
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid())
        {
            if ($id != 0)
            {
                $container->setParent($parent);
            }
	    $em->persist($container);
	    $em->flush();
	    $response = $this->redirect($this->generateUrl('us_symremedy_container_show',
                             array('id' => $container->getId())));
        }
        if ($response == null)
        {
            $response = $this->render('UsSymremedyBundle:Container:new.html.twig',
                             array('form' => $form->createView(), 'parent' => $parentName));
        }
	return $response;
    }

    /**
     * @Route(
     *     "/symremedy/container/{id}/delete",
     *     requirements={"id" = "\d+"}
     * )
     */
    public function deleteAction($id)
    {
	$em = $this->getDoctrine()->getManager();
	$container = $em->getRepository(Container::class)->find($id);
        if (!$container)
        {
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
        if (!$container)
        {
            throw $this->createNotFoundException('No container found for id '.$id);
        }
        return $this->render('UsSymremedyBundle:Container:show.html.twig',
                      array('container' => $container));
    }

    /**
     * @Route(
     *     "/symremedy/container/list/{order}",
     *     defaults={"order" = "ASC"},
     *     requirements={"order" = "ASC|DESC"}
     * );
     */
    public function listAction($order)
    {
        if ($order !== 'ASC' and $order !== 'DESC')
        {
            throw $this->createNotFoundException('List order must be ASC or DESC');
        }
        $containers = $this->getDoctrine()->getRepository(Container::class)->findBy(
                      array('parent' => null), array('name' => $order));
        return $this->render('UsSymremedyBundle:Container:list.html.twig',
                      array('containers' => $containers));
    }

}
