<?php

namespace Us\SymremedyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Us\SymremedyBundle\Entity\Container\Container;
use Us\SymremedyBundle\Entity\Container\Category;
use Us\SymremedyBundle\Form\Type\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\YamlFileLoader;


class ContainerController extends Controller
{
    /**
     * @Route("/symremedy/container/create",
     *     defaults={"id_parent" = 0});
     * @Route("/symremedy/container/{id_parent}/create",
     *     defaults={"id_parent" = 0},
     *     requirements={"id_parent" = "\d+"});
     */
    public function createAction(int $id_parent = 0, Request $request)
    {
        $tr = $this->get('translator');
        $response = null;
        $container = new Container();
        $parentName = '';
        // Checking parent container.
        $em = $this->getDoctrine()->getManager();
        if ($id_parent != 0) {
            $parent = $em->getRepository(Container::class)->find($id_parent);
            if ($parent) {
                $parentName = $parent->getName();
            } else {
                throw $this->createNotFoundException($tr->trans('no.parent.found') . " $id_parent");
            }
        }
        // Creating form.
        $form = $this->createFormBuilder($container)
                     ->add('name', TextType::class, array('label' => 'Nombre: '))
                     ->add('description', TextType::class, array('label' => 'Descripción: '))
                     ->add('capacity', IntegerType::class, array('label' => 'Aforo: '))
                     ->add('category', EntityType::class,
                           array('class' => 'Us\SymremedyBundle\Entity\Container\Category',
                                 'choice_label' => 'name',
                                 'required' => false,
                                 'label' => 'Categoría: '))
                     ->add('save', SubmitType::class, array('label' => 'Crear espacio'))
                     ->getForm();
        // Processing request.
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            if ($id_parent != 0) {
                $container->setParent($parent);
            }
            $em->persist($container);
            $em->flush();
            $response = $this->redirect($this->generateUrl('us_symremedy_container_show',
                             array('id' => $container->getId())));
        }
        if ($response == null) {
            $response = $this->render('UsSymremedyBundle:Container:edit.html.twig',
                             array('form' => $form->createView(), 'parent' => $parentName));
        }
        return $response;
    }

    /**
     * @Route("/symremedy/container/{id}/edit", requirements={"id" = "\d+"});
     */
    public function editAction(Request $request, $id)
    {
        // Checking container.
        $tr = $this->get('translator');
        $response = null;
        $em = $this->getDoctrine()->getManager();
        $container = $em->getRepository(Container::class)->find($id);
        if (!$container) {
            throw $this->createNotFoundException($tr->trans('no.container.found') . " $id");
        }
        // Creating form.
        $form = $this->createFormBuilder($container)
                     ->add('name', TextType::class, array('label' => 'Nombre: '))
                     ->add('description', TextType::class, array('label' => 'Descripción: '))
                     ->add('capacity', IntegerType::class, array('label' => 'Aforo: '))
                     ->add('category', EntityType::class,
                           array('class' => 'Us\SymremedyBundle\Entity\Container\Category',
                                 'choice_label' => 'name',
                                 'required' => false,
                                 'label' => 'Categoría: '))
                     ->add('save', SubmitType::class, array('label' => 'Guardar datos'))
                     ->getForm();
        // Processing request.
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            // Save and show data.
            $em->persist($container);
            $em->flush();
            $response = $this->redirect($this->generateUrl('us_symremedy_container_show',
                             array('id' => $container->getId())));
        }
        if ($response == null) {
            // Showing edition form.
            $parent = $container->getParent() ? $container->getParent()->getName() : '';
            $response = $this->render('UsSymremedyBundle:Container:edit.html.twig',
                             array('form' => $form->createView(),
                                   'parent' => $parent, 'id' => $id));
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
        // Checking container.
        $tr = $this->get('translator');
        $em = $this->getDoctrine()->getManager();
        $container = $em->getRepository(Container::class)->find($id);
        if (!$container) {
            throw $this->createNotFoundException($tr->trans('no.container.found') . " $id");
        }
        // Removing container.
        $em->remove($container);
        $em->flush();
        return $this->redirectToRoute('us_symremedy_container_list');
    }

    /**
     * @Route(
     *     "/symremedy/container/{id}/show",
     *     requirements={"id": "\d+"}
     * )
     */
    public function showAction($id)
    {
        // Checking container.
        $tr = $this->get('translator');
        $container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        if (!$container) {
            throw $this->createNotFoundException($tr->trans('no.container.found') . " $id");
        }
        // Showing container data.
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
        // Retrieving containers list.
        $tr = $this->get('translator');
        if ($order !== 'ASC' and $order !== 'DESC') {
            throw $this->createNotFoundException($tr-trans('list.order'));
        }
        $containers = $this->getDoctrine()->getRepository(Container::class)->findBy(
                      array('parent' => null), array('name' => $order));
        // Showing containers tree.
        return $this->render('UsSymremedyBundle:Container:list.html.twig',
                      array('containers' => $containers));
    }

    /**
     * @Route("/symremedy/container/categories");
     */
    public function categoriesAction(Request $request)
    {
        $response = null;
        // Retrieving all categories.
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();
        // Building form.
        $form = $this->createFormBuilder($categories)
                     ->add('categories', CollectionType::class,
                           array('entry_type' => CategoryType::class,
                                 'allow_add' => true,
                                 'allow_delete' => true,
                                 'delete_empty' => true,
                                 'prototype' => true,
                                 'label' => false))
                     ->add('save', SubmitType::class,
                           array('label' => 'Guardar categorías'))
                     ->getForm();
        // Processing request.
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            //foreach ($categories as $category)
            foreach ($form->getData()['categories'] as $category) {
                $em->persist($category);
            }
            $em->flush();
            $response = $this->redirect($this->generateUrl('us_symremedy_container_list'));
        }
        // Show form.
        if ($response == null) {
            $response = $this->render('UsSymremedyBundle:Container:categories.html.twig',
                                 array('form' => $form->createView()));
        }
        return $response;
    }

}
