<?php

namespace Us\SymremedyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Us\SymremedyBundle\Entity\Device\Device;
use Us\SymremedyBundle\Entity\Device\Category;
use Us\SymremedyBundle\Entity\Device\Status;
//use Us\SymremedyBundle\Form\Type\CategoryType;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use Symfony\Component\Form\Extension\Core\Type\IntegerType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DeviceController extends Controller
{

    /**
     * @Route(
     *     "/symremedy/device/list/{order}",
     *     defaults={"order" = "ASC"},
     *     requirements={"order" = "ASC|DESC"}
     * );
     */
    public function listAction($order)
    {
        // Retrieving devices list.
        if ($order !== 'ASC' and $order !== 'DESC')
        {
            throw $this->createNotFoundException('List order must be ASC or DESC');
        }
        $devices = $this->getDoctrine()->getRepository(Device::class)->findBy(
                        array(), array('name' => $order));
        // Showing devices.
        return $this->render('UsSymremedyBundle:Device:list.html.twig',
                      array('devices' => $devices));
    }

}
